<?php
/**
 * Created by PhpStorm.
 * User: Katie
 * Date: 21/12/2015
 * Time: 15:57
 */

namespace Postflix;


use Postflix\Database\DvdTable;

class Image {
    private $id;
    private $name;
    private $url;
    private $type;
    private $dvd_id;

    private $dvd;

    function __construct($dbRow)
    {
        $this->id = $dbRow['id'];
        $this->name = $dbRow['name'];
        $this->url = $dbRow['url'];
        $this->type = $dbRow['type'];
        $this->dvd_id = $dbRow['id'];
    }

    function getDvd()
    {
        if($this->dvd == NULL) {
            $dvdTableLink = new DvdTable();
            $this->dvd = $dvdTableLink->fetchDvdByID($this->dvd_id);
        }
        return $this->dvd;
    }

    /**
     * @return mixed
     */
    public function getDvdId()
    {
        return $this->dvd_id;
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
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

}