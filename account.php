<?php
require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/header.php');
$view->pageTitle = 'Postflix - Your Account';

$view->dvds = (new \Postflix\Database\DvdTable())->fetchDvdsByUserId($view->user->getId());

require_once(__DIR__ . '/views/account.phtml');