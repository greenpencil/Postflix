<?php
/**
 * Created by PhpStorm.
 * User: Katie
 * Date: 22/12/2015
 * Time: 17:10
 */

namespace Postflix\Database;


use Postflix\Director;

class DirectorsTable extends TableAbstract {
    protected $name = 'directors';
    protected $primaryKey = 'id';

    function fetchAllDirectors()
    {
        $results = $this->fetchAll();
        $directorsArray = array();
        while ($row = $results->fetch()) {
            $directorsArray[] = new Director($row);
        }
        return $directorsArray;
    }

    function fetchDirectorById($id)
    {
        $row = $this->fetchByPrimaryKey($id);
        $newDirector = NULL;
        if($row) {
            $newDirector = new Director($row);
        }
        return $newDirector;
    }
}