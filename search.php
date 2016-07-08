<?php
require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/header.php');

$view->pageTitle = 'Postflix - Search';

if(isset($_GET['search'])) {
    $searchString = strtolower($_GET['search']);
    $view->dvds = (new \Postflix\Database\DvdTable())->search($searchString);

}

// InfoBox, the bar above the results that shows information on what is being searched
$view->infoBox = '<h2>How to Search</h2>
                    <p>You can crete specific searches by narrowing down the options with keywords in the following format, without a tag everything is searched.</br>
                        <i>Title</i>:Frozen, <i>Genre</i>:Kids, disney
                    <ul>
                        <li><i>Title</i> - Dvd Title</li>
                        <li><i>Synopsis</i> - Dvd Synopsis</li>
                        <li><i>Cast</i> - Cast Name</li>
                        <li><i>Genre</i> - Genre Name</li>
                        <li><i>Year</i> - Year of Release</li>
                    </ul>
                    <form method="get" action="search.php">
                      <div class="input-control text full-size">
                      <span class="mif-search prepend-icon"></span>
                      <input name="search" type="text" placeholder="Search all DVDs">
                      </div>
                      </form>
                    </p>';

require_once(__DIR__ . '/views/display.phtml');