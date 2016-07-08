<?php
require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/header.php');

$view->dvd = (new \Postflix\Database\DvdTable())->fetchDvdByID($_GET['id']);
$view->pageTitle = 'Postflix - ' . $view->dvd->getName();

// Creating the array for the 'also directed by/with/in'
$options = array();
$options = $view->dvd->getGenres();
$options = array_merge($options, $view->dvd->getCast());
$options[] = $view->dvd->getDirector();

// randomly choose one of the options
$view->also = $options[array_rand($options)];


require_once(__DIR__.'/views/viewdvd.phtml');