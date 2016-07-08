<?php
/**
 * Created by PhpStorm.
 * User: Katie
 * Date: 18/12/2015
 * Time: 16:52
 */

namespace Postflix;


use Postflix\Database\DvdTable;

class Genre {
    private $id;
    private $name;
    private $synopsis;

    private $dvds;

    function __construct($row)
    {
        $this->id = $row['id'];
        $this->name = $row['name'];
        $this->synopsis = $row['synopsis'];
    }

    public function getDvds()
    {
        if($this->dvds == NULL) {
            $dvdTableLink = new DvdTable();
            $this->dvds = $dvdTableLink->fetchDvdsByGenreId($this->id);
        }
        return $this->dvds;
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


}