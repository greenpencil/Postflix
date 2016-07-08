<?php
/**
 * Created by PhpStorm.
 * User: Katie
 * Date: 18/12/2015
 * Time: 16:55
 */

namespace Postflix\Database;


use Postflix\Genre;

class GenresTable extends TableAbstract {
    protected $name = 'genres';
    protected $pivot = 'dvds_genres';
    protected $primaryKey = 'id';

    function fetchAllGenres()
    {
        $results = $this->fetchAll();
        $genreArray = array();
        while ($row = $results->fetch()) {
            $genreArray[] = new Genre($row);
        }
        return $genreArray;
    }

    function fetchGenreById($id)
    {
        $row = $this->fetchByPrimaryKey($id);
        $newGenre = NULL;
        if($row) {
            $newGenre = new Genre($row);
        }
        return $newGenre;
    }

    function fetchGenresByDvdId($dvdId)
    {
        $sql = 'SELECT id, name, synopsis FROM '.$this->name.', '.$this->pivot.' WHERE id = genre_id AND dvd_id = :dvdId';
        $results = $this->dbHandler->prepare($sql);
        $results->execute(array(
                ':dvdId' => $dvdId
        ));
        $genreArray = array();
        while($row = $results->fetch())
        {
            $genreArray[] = new Genre($row);
        }

        return $genreArray;
    }
}