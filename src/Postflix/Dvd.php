<?php
/**
 * Created by PhpStorm.
 * User: Katie
 * Date: 16/12/2015
 * Time: 14:14
 */

namespace Postflix;

use Postflix\Database\CastTable;
use Postflix\Database\DirectorsTable;
use Postflix\Database\DvdTable;
use Postflix\Database\GenresTable;
use Postflix\Database\ImagesTable;
use Postflix\Database\PriceBandsTable;
use Postflix\Database\UsersTable;

class Dvd {
    private $id;
    private $name;
    private $synopsis;
    private $director_id;
    private $release_year;
    private $priceBand_id;
    private $user_id;

    private $user;
    private $genres;
    private $images;
    private $cast;
    private $director;
    private $priceBand;

    function __construct($dbRow)
    {
        $this->id = $dbRow['id'];
        $this->name = $dbRow['name'];
        $this->synopsis = $dbRow['synopsis'];
        $this->director_id = $dbRow['director_id'];
        $this->release_year = $dbRow['release_year'];
        $this->priceBand_id = $dbRow['priceband_id'];
        $this->user_id = $dbRow['user_id'];
    }

    /**
     * Because Genres and DVDs have a Many-to-May relationship we cannot have the loading in the constructor
     * because it can cause an infinite loop
     */
    public function getGenres()
    {
        if($this->genres == NULL) {
            $genreTableLink = new GenresTable();
            $this->genres = $genreTableLink->fetchGenresByDvdId($this->id);
        }
        return $this->genres;
    }

    public function getCast()
    {
        if($this->cast == NULL) {
            $castTableLink = new CastTable();
            $this->cast = $castTableLink->fetchCastByDvdId($this->id);
        }
        return $this->cast;
    }

    public function setUser($userId)
    {
        $dvdTableLink = new DvdTable();
        $dvdTableLink->setUser($this->id, $userId);
        $this->user = NULL;
        $this->user_id = $userId;
    }

    public function getUser()
    {
        if($this->user == NULL)
        {
            $userTableLink = new UsersTable();
            $this->user = $userTableLink->fetchUserByID($this->user_id);
        }
        return $this->user;
    }

    public function getDirector()
    {
        if($this->director == NULL)
        {
            $directorTableLink = new DirectorsTable();
            $this->director = $directorTableLink->fetchDirectorById($this->director_id);
        }
        return $this->director;
    }

    public function getImages()
    {
        if($this->images == NULL) {
            $imageTableLink = new ImagesTable();
            $this->images = $imageTableLink->fetchImagesByDvdId($this->id);
        }
        return $this->images;
    }

    public function getPriceBand()
    {
        if ($this->priceBand == NULL) {
            $priceBandTableLink = new PriceBandsTable();
            $this->priceBand = $priceBandTableLink->fetchPriceBandById($this->priceBand_id);
        }
        return $this->priceBand;
    }

    public function getDvdCover()
    {
        foreach($this->getImages() as $image)
        {
            if($image->getType() == 1)
            {
                return $image;
            }
        }
    }

    public function getDvdSplash()
    {
        foreach($this->getImages() as $image)
        {
            if($image->getType() == 2)
            {
                return $image;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getSynopsis()
    {
        return $this->synopsis;
    }

    /**
     * @return mixed
     */
    public function getDirectorId()
    {
        return $this->director_id;
    }

    /**
     * @return mixed
     */
    public function getReleaseYear()
    {
        return $this->release_year;
    }

    /**
     * @return mixed
     */
    public function getPriceBandId()
    {
        return $this->$priceBand_id;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

}