<?php
require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/header.php');

$view->pageTitle = 'Postflix - Your Basket';
if(isset($_SESSION['user'])) {
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case('add'):
                $dvdToAdd = (new \Postflix\Database\DvdTable())->fetchDvdByID($_GET['product']);
                if (!isset($_SESSION['basket_items'])) {
                    $_SESSION['basket_items'] = array();
                }
                // check that the item does not already exist
                if ($dvdToAdd->getUser() == null) {
                    if (array_search($dvdToAdd->getId(), $_SESSION['basket_items']) === false) {
                        $_SESSION['basket_items'][] = $dvdToAdd->getId();
                    } else {
                        $view->error = 'You have already got '. $dvdToAdd->getName() .' in your basket';
                    }
                } else {
                    $view->error = $dvdToAdd->getName() .' is not available, <a href="wishlist.php?action=add&product='. $dvdToAdd->getId() .'">add it to your wishlist instead?</a>';
                }
                break;

            case('remove'):
                $dvdToRemove = $_GET['position'];
                unset($_SESSION['basket_items'][$dvdToRemove]);
                $_SESSION['basket_items'] = array_values($_SESSION['basket_items']);
                break;

            case('clear'):
                if (isset($_SESSION['basket_items'])) {
                    unset($_SESSION['basket_items']);
                }
                break;
        }
    }
    if (isset($_SESSION['basket_items'])) {
        $view->basket = array();
        $dvdTable = new \Postflix\Database\DvdTable();
        foreach ($_SESSION['basket_items'] as $id) {
            $view->basket[] = $dvdTable->fetchDvdByID($id);
        }
        $view->total = 0;
        foreach ($view->basket as $dvd) {
            $view->total = $view->total + $dvd->getPriceBand()->getPrice();
        }
    }
}

require_once(__DIR__.'/views/basket.phtml');