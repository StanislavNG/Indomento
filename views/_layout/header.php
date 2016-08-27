<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="<?=APP_ROOT?>/content/styles.css" />
    <link rel="icon" href="<?=APP_ROOT?>/content/images/favicon.ico" />
    <script src="<?=APP_ROOT?>/content/scripts/jquery-3.0.0.min.js"></script>
    <script src="<?=APP_ROOT?>/content/scripts/blog-scripts.js"></script>
    <title><?php if (isset($this->title)) echo htmlspecialchars($this->title) ?></title>
</head>

<body>
<header>
<!--<a href="<?=APP_ROOT?>"><img src="<?=APP_ROOT?>/content/images/site-logo.png"></a> -->
    <h2>Indomento</h2>
    <h3>Welcome, <?=htmlspecialchars($_SESSION['username'])?></h3>
    <ul>
        <li><a href="<?=APP_ROOT?>/">Home</a></li>
    <?php if ($this->isLoggedIn) : ?>
        <li><a href="<?=APP_ROOT?>/posts">Posts</a></li>
        <li><a href="<?=APP_ROOT?>/posts/create">Create Post</a></li>
        <li><a href="<?=APP_ROOT?>/users">Users</a></li>        
    <?php else: ?>
        <li><a href="<?=APP_ROOT?>/users/login">Login</a></li>
        <li><a href="<?=APP_ROOT?>/users/register">Register</a></li>
    <?php endif; ?>
    <?php if ($this->isLoggedIn) : ?>
        <li>
            <a href="<?=APP_ROOT?>/users/logout">Logout</a>    
        </li>
    <?php endif; ?>
    </ul>
    <hr />
    <ul>
    <?php foreach ($this->postsSidebar as $post) : ?>
        <li>
            <a href="<?=APP_ROOT?>/home/view/<?=$post['id']?>"><?=htmlentities($post['title']) ?></a>
        </li>
    <?php endforeach ?>
    </ul>
</header>

<?php require_once('show-notify-messages.php'); ?>
