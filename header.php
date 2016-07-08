<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$view = new stdClass();
$view->genres = (new \Postflix\Database\GenresTable())->fetchAllGenres();
$view->directors = (new \Postflix\Database\DirectorsTable())->fetchAllDirectors();
$view->cast = (new \Postflix\Database\CastTable())->fetchAllCast();
if(isset($_SESSION['user'])) {
    $view->user = (new Postflix\Database\UsersTable())->fetchUserByID($_SESSION['user']);
}