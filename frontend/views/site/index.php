<?php

/** @var yii\web\View $this */

$this->title = 'BookStore';
?>
<div class="site-index">
    <div class="p-5 mb-4 bg-transparent rounded-3">
        <div class="container-fluid py-5 text-center">
            <h1 class="display-4">Welcome to BookStore!</h1>
            <p class="fs-5 fw-light">Your one-stop shop for buying and selling books online.</p>
        </div>
    </div>

    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12">
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search for books, authors, or categories" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>

        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">BookStore</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Trending</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Wishlist</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Sell a Book</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="row">
            <div class="col-lg-12">
                <h2>Trending Books</h2>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="card">
                            <img src="path/to/book1.jpg" class="card-img-top" alt="Book 1">
                            <div class="card-body">
                                <h5 class="card-title">Book Title 1</h5>
                                <p class="card-text">Author 1</p>
                                <a href="#" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <img src="path/to/book2.jpg" class="card-img-top" alt="Book 2">
                            <div class="card-body">
                                <h5 class="card-title">Book Title 2</h5>
                                <p class="card-text">Author 2</p>
                                <a href="#" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <img src="path/to/book3.jpg" class="card-img-top" alt="Book 3">
                            <div class="card-body">
                                <h5 class="card-title">Book Title 3</h5>
                                <p class="card-text">Author 3</p>
                                <a href="#" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <img src="path/to/book4.jpg" class="card-img-top" alt="Book 4">
                            <div class="card-body">
                                <h5 class="card-title">Book Title 4</h5>
                                <p class="card-text">Author 4</p>
                                <a href="#" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
