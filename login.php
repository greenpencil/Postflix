<?php
require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/header.php');

$view->pageTitle = 'Postflix - Home';


if(isset($_POST['email']) && isset($_POST['password'])&& isset($_POST['submit'])) {
    $email = (new \Postflix\Database\UsersTable())->fetchUserByEmail($_POST['email']);
    if($email != null)
    {
        if(password_verify($_POST['password'],$email->getPassword()))
        {
            // password is correct
            $_SESSION['user'] = $email->getId();
            $view->user = (new Postflix\Database\UsersTable())->fetchUserByID($_SESSION['user']);
            $view->error = 'You are now logged in';
        } else {
            $view->error = 'Your password is incorrect';
        }
    } else {
        $view->error = 'That email doesn\'t exist';
    }

} else {
    $view->error = 'A field was left blank';
}

require_once(__DIR__ . '/views/login.phtml');
?>