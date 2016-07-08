<?php
/**
 * Created by PhpStorm.
 * User: Katie
 * Date: 16/12/2015
 * Time: 13:57
 */

namespace Postflix\Database;
require_once(__DIR__."/Database.php");

/**
 * Class TableAbstract
 * @package Postflix\Database
 * Provides an abstract table class for connecting to the database
 */
abstract class TableAbstract {
    protected $name;
    protected $primaryKey = 'id', $dbHandler, $db;

    /**
     * Constructor
     */
    public function __construct() {
        $this->db = Database::getInstance();
        $this->dbHandler = $this->db->getDbHandler();
    }

    public function fetchAll() {
        $sql = 'SELECT * FROM ' . $this->name;
        $results = $this->dbHandler->prepare($sql);
        $results->execute();
        return $results;
    }

    public function fetchByPrimaryKey($key) {
        $sql = 'SELECT * FROM ' . $this->name . ' WHERE ' . $this->primaryKey . ' = :id LIMIT 1';
        $params = array(
            ':id' => $key
        );
        $results = $this->dbHandler->prepare($sql);
        $results->execute($params);
        return $results->fetch();
    }

}