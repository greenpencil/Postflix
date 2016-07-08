<?php
require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/header.php');
$view->pageTitle = 'Postflix - Search';

$dvdTable = new \Postflix\Database\DvdTable();

if(isset($_GET['type']) && isset($_GET['value'])) {
    if($_GET['type'] == 'directors') {
        $view->dvds = $dvdTable->fetchDvdsByDirectorId($_GET['value']);
        $director = (new \Postflix\Database\DirectorsTable())->fetchDirectorById($_GET['value']);
        $view->infoBox = '<h2>'. $director->getName() .'</h2>
                          <p>'. $director->getBiography() .'</p>';
    } elseif($_GET['type'] == 'genres') {
        $view->dvds = $dvdTable->fetchDvdsByGenreId($_GET['value']);
        $genre = (new \Postflix\Database\GenresTable())->fetchGenreById($_GET['value']);
        $view->infoBox = '<h2>'. $genre->getName() .'</h2>
                          <p>'. $genre->getSynopsis() .'</p>';
    } elseif($_GET['type'] == 'cast') {
        $view->dvds = $dvdTable->fetchDvdsBCastId($_GET['value']);
        $cast = (new \Postflix\Database\CastTable())->fetchCastById($_GET['value']);
        $view->infoBox = '<h2>'. $cast->getName() .'</h2>
                          <p>'. $cast->getBiography() .'</p>';
    }
}
else {
    $view->dvds = $dvdTable->fetchAllDvds();
    $view->infoBox = '<h2>All Dvds</h2>
                      <p>All Available DVDs from Postflix
                      <form action="search.php" method="get">
                      <div class="input-control text full-size">
                      <span class="mif-search prepend-icon"></span>
                      <input type="text" name="search" placeholder="Search all DVDs">
                      </div>
                      </form></p>';
}

require_once(__DIR__ . '/views/display.phtml');