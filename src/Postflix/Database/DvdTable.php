<?php
/**
 * Created by PhpStorm.
 * User: Katie
 * Date: 18/12/2015
 * Time: 18:08
 */

namespace Postflix\Database;


use Postflix\Dvd;

class DvdTable extends TableAbstract {
    protected $name = 'dvds';
    protected $primaryKey = 'id';

    public function fetchAllDvds()
    {
        $results = $this->fetchAll();
        $dvdArray = array();
        while ($row = $results->fetch()) {
            $dvdArray[] = new Dvd($row);
        }
        return $dvdArray;
    }

    public function fetchAllAvailableDvds()
    {
        $sql = 'SELECT * FROM '.$this->name.' WHERE user_id IS NULL';
        $results = $this->dbHandler->prepare($sql);
        $results->execute();
        $dvdArray = array();
        while ($row = $results->fetch()) {
            $dvdArray[] = new Dvd($row);
        }
        return $dvdArray;
    }

    function fetchDvdByID($id)
    {
        $row = $this->fetchByPrimaryKey($id);
        $newDvd = NULL;
        if($row) {
            $newDvd = new Dvd($row);
        }
        return $newDvd;
    }

    public function fetchDvdsByUserId($userId)
    {
        $sql = 'SELECT dvds.id, dvds.name, dvds.synopsis, dvds.director_id,
                  dvds.release_year, dvds.priceband_id, dvds.user_id FROM users, '. $this->name .' WHERE dvds.user_id = users.id AND users.id = :userId';
        $results = $this->dbHandler->prepare($sql);
        $results->execute(array(
            ':userId' => $userId
        ));
        $dvdArray = array();
        while($row = $results->fetch())
        {
            $dvdArray[] = new Dvd($row);
        }
        return $dvdArray;
    }

    public function fetchDvdsByGenreId($genreId)
    {
        $sql = 'SELECT dvds.id, dvds.name, dvds.synopsis, dvds.director_id,
                dvds.release_year, dvds.priceband_id, dvds.user_id FROM dvds_genres, '. $this->name .' WHERE id = dvd_id AND genre_id = :genreId';
        $results = $this->dbHandler->prepare($sql);
        $results->execute(array(
            ':genreId' => $genreId
        ));
        $dvdArray = array();
        while($row = $results->fetch())
        {
            $dvdArray[] = new Dvd($row);
        }
        return $dvdArray;

    }

    public function fetchDvdsBCastId($castId)
    {
        $sql = 'SELECT dvds.id, dvds.name, dvds.synopsis, dvds.director_id,
                  dvds.release_year, dvds.priceband_id, dvds.user_id FROM dvds_cast, '. $this->name .' WHERE id = dvd_id AND cast_id = :castId';
        $results = $this->dbHandler->prepare($sql);
        $results->execute(array(
            ':castId' => $castId
        ));
        $dvdArray = array();
        while($row = $results->fetch())
        {
            $dvdArray[] = new Dvd($row);
        }
        return $dvdArray;

    }

    public function fetchDvdsByDirectorId($directorId)
    {
        $sql = 'SELECT * FROM '. $this->name .' WHERE director_id = :directorId';
        $results = $this->dbHandler->prepare($sql);
        $results->execute(array(
            ':directorId' => $directorId
        ));
        $dvdArray = array();
        while($row = $results->fetch())
        {
            $dvdArray[] = new Dvd($row);
        }
        return $dvdArray;

    }

    public function fetchDvdsByPriceBandId($priceBandId)
    {
        $sql = 'SELECT * FROM '. $this->name .' WHERE priceband_id = :priceBandId';
        $results = $this->dbHandler->prepare($sql);
        $results->execute(array(
            ':priceBandId' => $priceBandId
        ));
        $dvdArray = array();
        while($row = $results->fetch())
        {
            $dvdArray[] = new Dvd($row);
        }
        return $dvdArray;

    }

    public function fetchRecentReleases()
    {
        $sql = 'SELECT * FROM '. $this->name .' ORDER BY release_year DESC';
        $results = $this->dbHandler->prepare($sql);
        $results->execute();
        $dvdArray = array();
        while($row = $results->fetch())
        {
            $dvdArray[] = new Dvd($row);
        }
        return $dvdArray;
    }

    public function search($searchString)
    {
        $elements = explode(', ', $searchString);
        $dvdArray = array();
        foreach($elements as $element)
        {
            $search = explode(':', $element);
            $query = 'SELECT DISTINCT dvds.id, dvds.name, dvds.synopsis, dvds.director_id, dvds.release_year, dvds.priceband_id, dvds.user_id
                      FROM dvds, dvds_genres, genres, cast, dvds_cast, directors
                      WHERE dvds_genres.genre_id = genres.id AND dvds_genres.dvd_id = dvds.id AND dvds_cast.dvd_id = dvds.id AND dvds_cast.cast_id = cast.id AND directors.id = director_id';
            $search[0] = trim($search[0]);
            if(sizeof($search) == 1)
            {
                $query = $query . ' AND (
                                        LOWER(genres.name) LIKE "%'.$search[0].'%"
                                        OR LOWER(cast.name) LIKE "%'.$search[0].'%"
                                        OR LOWER(directors.name) LIKE "%'.$search[0].'%"
                                        OR LOWER(dvds.name) LIKE "%'.$search[0].'%"
                                        OR LOWER(dvds.synopsis) LIKE "%'.$search[0].'%"
                                        OR LOWER(dvds.release_year) LIKE "%'.$search[0].'%"
                                    )';
                // Search everything for the string
            }
            else
            {
                $search[1] = trim($search[1]);
                // Search each table for the string
                if($search[0] == 'cast'){
                    $query = $query . ' AND LOWER(cast.name) LIKE "%'.$search[1].'%"';

                } elseif($search[0] == 'genre'){
                    $query = $query . ' AND LOWER(genres.name) LIKE "%'.$search[1].'%"';

                } elseif($search[0] == 'director'){
                    $query = $query . ' AND LOWER(directors.name) LIKE "%'.$search[1].'%"';

                } elseif($search[0] == 'synopsis') {
                    $query = $query . ' AND LOWER(dvds.synopsis) LIKE "%'.$search[1].'%"';

                } elseif($search[0] == 'year') {
                    $query = $query . ' AND LOWER(dvds.release_year) LIKE "%'.$search[1].'%"';

                } elseif($search[0] == 'title') {
                    $query = $query . ' AND LOWER(dvds.name) LIKE "%'.$search[1].'%"';

                }
            }
        }

        $results = $this->dbHandler->prepare($query);
        $results->execute();
        while($row = $results->fetch())
        {
            $dvdArray[] = new Dvd($row);
        }
        return $dvdArray;
    }

    public function setUser($dvdId, $userId)
    {
        $sql = 'UPDATE '. $this->name . ' SET user_id = '.$userId.' WHERE id = ' . $dvdId;
        $results = $this->dbHandler->prepare($sql);
        $results->execute();
    }
}