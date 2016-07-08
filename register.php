<?php
require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/header.php');
$view->pageTitle = 'Postflix - Register';

// Was the form sent?
if(isset($_POST['submit'])) {
    // All validation is done via Javascript so we don't need to worry
    // create an array for the form data
    $data = array(
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
        'mobile' => $_POST['mobile'],
        'address' => $_POST['address']
    );
    $userTable = new \Postflix\Database\UsersTable();
    $newUser = $userTable->addNewUser($data);
    $_SESSION['user'] = $newUser;
    $view->user = $userTable->fetchUserByID($newUser);
    require_once(__DIR__ . '/views/congrats.phtml');
} else {
    require_once(__DIR__ . '/views/register.phtml');
}