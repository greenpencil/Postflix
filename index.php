<?php
require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/header.php');

$view->pageTitle = 'Postflix - Home';
// Categories to show on the homepage
$view->categories = array();
$view->categories[] = array(
    'name' => 'Recent Releases',
    'data' => array_slice((new \Postflix\Database\DvdTable())->fetchRecentReleases(), 0, 4)
);

$genres = (new \Postflix\Database\GenresTable())->fetchAllGenres();
for($i = 0; $i < 3; $i++) {
    $genre = $genres[array_rand($view->genres)];
    $view->categories[] = array(
        'name' => 'Best Of ' . $genre->getName(),
        'data' => array_slice($genre->getDvds(), 0, 4)
    );
}

require_once(__DIR__.'/views/default.phtml');