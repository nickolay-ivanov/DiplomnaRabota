<?php

namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\MyAccountForm;
use frontend\models\CreateListingForm;
use common\models\Category;
use frontend\models\SearchForm;
use common\models\BookCopy;
use common\models\User;
use yii\web\Response;
use frontend\models\Message;
use common\models\Activity; // Add this line

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchForm();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $latestListings = BookCopy::find()->orderBy(['created_at' => SORT_DESC])->limit(10)->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'latestListings' => $latestListings,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }

    /**
     * Displays MyAccount page.
     *
     * @return mixed
     */
    public function actionMyAccount()
    {
        $model = new MyAccountForm();
        $user = User::findOne(Yii::$app->user->id);
        $model->loadUserData($user);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Account details updated successfully.');
            return $this->refresh();
        }

        return $this->render('myAccount', [
            'model' => $model,
        ]);
    }

    /**
     * Displays Chat page.
     *
     * @return mixed
     */
    public function actionChat($receiver_id = null)
    {
        $users = User::find()->where(['<>', 'id', Yii::$app->user->id])->all();
        $receiver = User::findOne($receiver_id);
        $messages = [];

        if ($receiver) {
            $messages = Message::find()
                ->where(['sender_id' => Yii::$app->user->id, 'receiver_id' => $receiver_id])
                ->orWhere(['sender_id' => $receiver_id, 'receiver_id' => Yii::$app->user->id])
                ->orderBy('created_at ASC')
                ->all();
        }

        return $this->render('chat', [
            'users' => $users,
            'receiver' => $receiver,
            'messages' => $messages,
            'receiver_id' => $receiver_id,
        ]);
    }

    /**
     * Displays Favourites page.
     *
     * @return mixed
     */
    public function actionFavourites()
    {
        return $this->render('favourites');
    }

    /**
     * Displays Activities page.
     *
     * @return mixed
     */
    public function actionActivities()
    {
        $activities = Activity::find()->where(['user_id' => Yii::$app->user->id])->orderBy(['created_at' => SORT_DESC])->all();
        return $this->render('activities', [
            'activities' => $activities,
        ]);
    }

    private function addActivity($userId, $activityType)
    {
        $activity = new Activity();
        $activity->user_id = $userId;
        $activity->activity_type = $activityType;
        $activity->save();
    }

    public function actionSendMessage($receiver_id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $message = new Message();
        $message->sender_id = Yii::$app->user->id;
        $message->receiver_id = $receiver_id;
        $message->message = Yii::$app->request->post('message');
        if ($message->save()) {
            $this->addActivity($receiver_id, 'message_received');
            return ['success' => true];
        }
        return ['success' => false];
    }

    public function actionRemoveListing($id)
    {
        $listing = BookCopy::findOne($id);
        if (!$listing) {
            throw new \yii\web\NotFoundHttpException('The requested listing does not exist.');
        }

        if ($listing->delete()) {
            $this->addActivity(Yii::$app->user->id, 'listing_removed');
            return $this->redirect(['index']);
        }
    }

    public function actionAddBook()
    {
        $book = new \common\models\Book();
        if ($book->load(Yii::$app->request->post()) && $book->save()) {
            $this->addActivity(Yii::$app->user->id, 'book_added');
            return $this->redirect(['view', 'id' => $book->id]);
        }

        return $this->render('addBook', [
            'model' => $book,
        ]);
    }

    public function actionUpdateBook($id)
    {
        $book = \common\models\Book::findOne($id);
        if (!$book) {
            throw new \yii\web\NotFoundHttpException('The requested book does not exist.');
        }

        if ($book->load(Yii::$app->request->post()) && $book->save()) {
            $this->addActivity(Yii::$app->user->id, 'book_updated');
            return $this->redirect(['view', 'id' => $book->id]);
        }

        return $this->render('updateBook', [
            'model' => $book,
        ]);
    }

    public function actionUpdateProfile()
    {
        $user = User::findOne(Yii::$app->user->id);
        if (!$user) {
            throw new \yii\web\NotFoundHttpException('The requested user does not exist.');
        }

        if ($user->load(Yii::$app->request->post()) && $user->save()) {
            $this->addActivity(Yii::$app->user->id, 'profile_updated');
            return $this->redirect(['profile']);
        }

        return $this->render('updateProfile', [
            'model' => $user,
        ]);
    }

    public function actionVerifyProfile()
    {
        $user = User::findOne(Yii::$app->user->id);
        if (!$user) {
            throw new \yii\web\NotFoundHttpException('The requested user does not exist.');
        }

        if ($user->verify()) {
            $this->addActivity(Yii::$app->user->id, 'profile_verified');
            return $this->redirect(['profile']);
        }

        return $this->render('verifyProfile', [
            'model' => $user,
        ]);
    }

    /**
     * Displays Create Listing page.
     *
     * @return mixed
     */
    public function actionCreateListing()
    {
        $model = new CreateListingForm();
        
        // Fetch and sort categories
        $categories = Category::find()
            ->select(['id', 'name'])
            ->orderBy(['name' => SORT_ASC])
            ->asArray()
            ->all();

        // Move "Other" category to the end
        $categories = array_column($categories, 'name', 'id');
        if (($otherKey = array_search('Other', $categories)) !== false) {
            $otherCategory = $categories[$otherKey];
            unset($categories[$otherKey]);
            $categories[$otherKey] = $otherCategory;
        }

        if ($model->load(Yii::$app->request->post())) {
            $filePath = $model->save();
            if ($filePath !== false) {
                Yii::$app->session->setFlash('success', 'Listing created successfully.');
                $this->addActivity(Yii::$app->user->id, 'book_added'); // Add activity here
                return $this->refresh();
            }
        }

        return $this->render('createListing', [
            'model' => $model,
            'categories' => $categories,
        ]);
    }

    /**
     * Displays a single listing.
     *
     * @param int|null $id
     * @return mixed
     * @throws \yii\web\NotFoundHttpException if the model cannot be found
     */
    public function actionListing($id = null)
    {
        if ($id === null || $id == 0) {
            $model = new BookCopy();
            $model->book = new \common\models\Book();
            $model->book->title = 'Sample Title';
            $model->book->author = 'Sample Author';
            $model->price = 0.00;
            $model->image = 'uploads/default.jpg';
        } else {
            $model = BookCopy::findOne($id);
            if (!$model) {
                throw new \yii\web\NotFoundHttpException('The requested page does not exist.');
            }
        }

        return $this->render('view_listing', [
            'model' => $model,
        ]);
    }

    /**
     * Displays User Listings page.
     *
     * @param string $username
     * @return mixed
     */
    public function actionUserListings($username)
    {
        $user = User::findOne(['username' => $username]);
        if (!$user) {
            throw new \yii\web\NotFoundHttpException('The requested user does not exist.');
        }

        $listings = BookCopy::find()->where(['seller_id' => $user->id])->orderBy(['created_at' => SORT_DESC])->all();

        return $this->render('user_listings', [
            'username' => $username,
            'listings' => $listings,
        ]);
    }

    /**
     * Displays Edit Listing page.
     *
     * @param int $id
     * @return mixed
     * @throws \yii\web\NotFoundHttpException if the model cannot be found
     * @throws \yii\web\ForbiddenHttpException if the user is not the seller
     */
    public function actionEditListing($id)
    {
        $model = BookCopy::findOne($id);
        if (!$model) {
            throw new \yii\web\NotFoundHttpException('The requested listing does not exist.');
        }

        if ($model->seller_id !== Yii::$app->user->id) {
            throw new \yii\web\ForbiddenHttpException('You are not allowed to edit this listing.');
        }

        $formModel = new CreateListingForm();
        $formModel->attributes = $model->attributes;
        $formModel->category_id = $model->book->category_id; // Ensure category ID is set

        if ($formModel->load(Yii::$app->request->post())) {
            if ($formModel->validate()) {
                $model->attributes = $formModel->attributes;
                $model->book->title = $formModel->title;
                $model->book->category_id = $formModel->category_id;
                $model->book_condition = $formModel->condition;
                $model->price = $formModel->price;

                if ($formModel->image) {
                    $uploadsDir = Yii::getAlias('@frontend/web/uploads');
                    $filePath = $uploadsDir . '/' . uniqid() . '.' . $formModel->image->extension;
                    if ($formModel->image->saveAs($filePath)) {
                        $model->image = 'uploads/' . basename($filePath);
                    } else {
                        Yii::$app->session->setFlash('error', 'Failed to upload image.');
                    }
                }

                if ($model->save() && $model->book->save()) {
                    Yii::$app->session->setFlash('success', 'Listing updated successfully.');
                    return $this->redirect(['view_listing', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Failed to update listing.');
                }
            }
        }

        // Fetch and sort categories
        $categories = Category::find()
            ->select(['id', 'name'])
            ->orderBy(['name' => SORT_ASC])
            ->asArray()
            ->all();

        // Move "Other" category to the end
        $categories = array_column($categories, 'name', 'id');
        if (($otherKey = array_search('Other', $categories)) !== false) {
            $otherCategory = $categories[$otherKey];
            unset($categories[$otherKey]);
            $categories[$otherKey] = $otherCategory;
        }

        return $this->render('editListing', [
            'model' => $formModel,
            'categories' => $categories,
            'listing' => $model,
        ]);
    }

    public function actionLoadMessages($receiver_id)
    {
        Yii::$app->response->format = Response::FORMAT_HTML;
        $messages = Message::find()
            ->where(['sender_id' => Yii::$app->user->id, 'receiver_id' => $receiver_id])
            ->orWhere(['sender_id' => $receiver_id, 'receiver_id' => Yii::$app->user->id])
            ->orderBy('created_at ASC')
            ->all();
        return $this->renderPartial('_messages', ['messages' => $messages]);
    }

    public function actionStartChat($username)
    {
        $receiver = User::findOne(['username' => $username]);
        if (!$receiver) {
            throw new \yii\web\NotFoundHttpException('User not found.');
        }

        if (Yii::$app->request->isPost) {
            $message = new Message();
            $message->sender_id = Yii::$app->user->id;
            $message->receiver_id = $receiver->id;
            $message->message = Yii::$app->request->post('message');
            if ($message->save()) {
                return $this->redirect(['chat', 'receiver_id' => $receiver->id]);
            }
        }

        return $this->render('start-chat', [
            'receiver' => $receiver,
        ]);
    }
}
