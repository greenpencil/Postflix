<?php
require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/header.php');

$view->pageTitle = 'Postflix - Your Wishlist';

if(isset($_SESSION['user'])) {
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case('add'):
                $dvdToAdd = (new \Postflix\Database\DvdTable())->fetchDvdByID($_GET['product']);
                if (array_search($dvdToAdd, $view->user->getWishList()) === false) {
                    $view->user->addToWishList($dvdToAdd->getId());
                } else {
                    $view->error = $dvdToAdd->getName() . ' is already in your Wishlist';
                }
                break;

            case('remove'):
                $dvdToRemove = $_GET['product'];
                $view->user->removeFromWishList($dvdToRemove);
                break;

            case('clear'):
                $view->user->clearWishList();
                break;
        }
    }

    $view->wishlist = $view->user->getWishList();
}

require_once(__DIR__ . '/views/wishlist.phtml');