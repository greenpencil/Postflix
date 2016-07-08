<?php
require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/header.php');

$view->pageTitle = 'Postflix - Checkout';

$basket = array();
$dvdTable = new \Postflix\Database\DvdTable();
foreach ($_SESSION['basket_items'] as $id) {
    $basket[] = $dvdTable->fetchDvdByID($id);
}

$view->unavailable = array();
$view->rented = array();
foreach ($basket as $item) {
    if($item->getUser() == NULL) {
        $item->setUser($_SESSION['user']);
        $view->rented[] = $item;
    } else {
        $view->unavailable[] = $item;
    }
}

unset($_SESSION['basket_items']);
require_once(__DIR__ . '/views/checkout.phtml');
?>