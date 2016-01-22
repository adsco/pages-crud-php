<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Pages CRUD</title>
        <link href="/public/css/bootstrap.min.css" rel="stylesheet" />
        <link href="/public/css/font-awesome.min.css" rel="stylesheet" />
        <link href="/public/css/summernote.css" rel="stylesheet" />
        <link href="/public/css/main.css" rel="stylesheet" />
    </head>
    <body>
        <div class="container-fluid">
            <div class="container">
                <nav class="navbar navbar-inverse">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="#">
                                Prestige Biz Hub
                            </a>
                        </div>
                        <ul class="nav navbar-nav">
                            <li><a href="/">Dashboard</a></li>
                            <li><a href="#">Users</a></li>
                            <li><a href="#">Rooms</a></li>
                            <li><a href="#">News</a></li>
                            <li><a href="<?php echo site_url('/pages') ?>">Pages</a></li>
                        </ul>
                        <a href="#" class="navbar-text navbar-link pull-right">Logout</a>
                    </div>
                </nav>
            </div>
        </div>
        <div class="container">
            <?php if(isset($crumbs)): ?>
                <ol class="breadcrumb">
                    <li><a href="<?php echo site_url() ?>">Dashboard</a></li>
                    <?php for($i = 0, $len = count($crumbs) - 1; $i < $len; $i++): ?>
                    <li>
                        <a href="<?php echo site_url($crumbs[$i]['url']) ?>"><?php echo $crumbs[$i]['title'] ?></a>
                    </li>
                    <?php endfor; ?>
                    <li class="active"><?php echo $crumbs[$len]['title'] ?></li>
                </ol>
            <?php endif; ?>
            <h1><?php echo $title ?></h1>