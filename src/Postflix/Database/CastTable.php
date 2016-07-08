<?php
/**
 * Created by PhpStorm.
 * User: Katie
 * Date: 21/12/2015
 * Time: 14:28
 */

namespace Postflix\Database;


use Postflix\Cast;

class CastTable extends TableAbstract {
    protected $name = 'cast';
    protected $pivot = 'dvds_cast';
    protected $primaryKey = 'id';

    function fetchAllCast()
    {
        $results = $this->fetchAll();
        $castArray = array();
        while ($row = $results->fetch()) {
            $castArray[] = new Cast($row);
        }
        return $castArray;
    }

    function fetchCastById($id)
    {
        $row = $this->fetchByPrimaryKey($id);
        $newCast = NULL;
        if($row) {
            $newCast = new Cast($row);
        }
        return $newCast;
    }

    function fetchCastByDvdId($dvdId)
    {
        $sql = 'SELECT id, name, biography FROM '.$this->name.', '.$this->pivot.' WHERE id = cast_id AND dvd_id = :dvdId';
        $results = $this->dbHandler->prepare($sql);
        $results->execute(array(
            ':dvdId' => $dvdId
        ));
        $castArray = array();
        while($row = $results->fetch())
        {
            $castArray[] = new Cast($row);
        }

        return $castArray;
    }
}