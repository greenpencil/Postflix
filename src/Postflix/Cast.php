<?php
/**
 * Created by PhpStorm.
 * User: Katie
 * Date: 19/12/2015
 * Time: 22:10
 */

namespace Postflix;


use Postflix\Database\DvdTable;

class Cast {
    private $id;
    private $name;
    private $biography;

    private $dvds;

    function __construct($dbRow)
    {
        $this->id = $dbRow['id'];
        $this->name = $dbRow['name'];
        $this->biography = $dbRow['biography'];
    }

    public function getDvds()
    {
        if($this->dvds == NULL) {
            $dvdTableLink = new DvdTable();
            $this->dvds = $dvdTableLink->fetchDvdsBCastId($this->id);
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
    public function getBiography()
    {
        return $this->biography;
    }

}