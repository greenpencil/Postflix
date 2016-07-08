<?php
/**
 * Created by PhpStorm.
 * User: Katie
 * Date: 22/12/2015
 * Time: 17:09
 */

namespace Postflix\Database;


use Postflix\Image;

class ImagesTable extends TableAbstract {
    protected $name = 'images';
    protected $primaryKey = 'id';

    function fetchAllImages()
    {
        $results = $this->fetchAll();
        $imageArray = array();
        while ($row = $results->fetch()) {
            $imageArray[] = new Image($row);
        }
        return $imageArray;
    }

    function fetchImageById($id)
    {
        $row = $this->fetchByPrimaryKey($id);
        $newImage = NULL;
        if($row) {
            $newImage = new Image($row);
        }
        return $newImage;
    }

    function fetchImagesByDvdId($dvdId)
    {
        $sql = 'SELECT id, name, url, type, dvd_id FROM '.$this->name.' WHERE dvd_id = :dvdId';
        $results = $this->dbHandler->prepare($sql);
        $results->execute(array(
            ':dvdId' => $dvdId
        ));
        $imageArray = array();
        while($row = $results->fetch())
        {
            $imageArray[] = new Image($row);
        }

        return $imageArray;
    }
}