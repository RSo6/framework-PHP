<?php
use wfm\View;
/** @var $this View */
?>
<!doctype html>
<html lang="en">
<head>
    <base href="<?php echo baseUrl() ?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo PATH ?>/assets/bootstrap/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo PATH ?>/assets/css/magnific-popup.css">
    <link rel="stylesheet" href="<?php echo PATH ?>/assets/css/main.css">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo PATH ?>/public/assets/img/ddd.png">
    <?php echo $this->getMeta() ?>
</head>
<body>

<header class="fixed-top">
    <div class="header-top py-3">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col">
                    <a href="tel:+38(071)8317500">
                        <span class="icon-phone"><img src="/public/uploads/smartphone.png"></span> +38(071)8317500
                    </a>
                </div>
                <div class="col text-end icons">
                    <form action="search">
                        <div class="input-group" id="search">
                            <input type="text" class="form-control" placeholder="<?php __('Search_index_search'); ?>" name="s">
                            <button class="btn close-search" type="button"><i class="fas fa-times"></i></i></button>
                            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <a href="#" class="open-search"><i class="fas fa-search"></i></a>

                        <a href="#" class="relative" id="get-cart" data-bs-toggle="modal" data-bs-target="#cart-modal">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="badge bg-danger rounded-pill count-items"><?php echo $_SESSION['cart.qty'] ?? 0 ?></span>
                    </a>

                    <a href="wishlist"><i class="far fa-heart"></i></a>

                    <div class="dropdown d-inline-block">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="far fa-user"></i>
                        </a>
                        <ul class="dropdown-menu">
                           <?php if (empty($_SESSION['user'])):?>
                            <li><a class="dropdown-item" href="user/login"><?php __('tpl_login_header'); ?></a></li>
                            <li><a class="dropdown-item" href="user/signup"><?php __('tpl_signup_header'); ?></a></li>
                           <?php else: ?>
                               <li><a class="dropdown-item" href="user/cabinet"><?php __('tpl_cabinet'); ?></a></li>
                               <li><a class="dropdown-item" href="user/logout"><?php __('tpl_log_out'); ?></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <?php new \app\widgets\language\Language() ?>

                </div>
            </div>
        </div>
    </div><!-- header-top -->

    <div class="header-bottom py-2">
        <div class="container">

<nav class="navbar navbar-expand-lg navbar-light">
<div class="container-fluid p-0">
<a class="navbar-brand" href="<?php echo baseUrl() ?>"><?php echo \wfm\App::$app->getProperty('site_name') ?></a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <?php new \app\widgets\menu\Menu([
            'class' => 'navbar-nav ms-auto mb-2 mb-lg-0',
            'cache' => 30,
    ]) ?>

                    </div>

                </div>
            </nav>

        </div>
    </div><!-- header-bottom -->
</header>