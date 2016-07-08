<?php
require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/header.php');

unset($_SESSION['user']);
header("Location: index.php");
die();
