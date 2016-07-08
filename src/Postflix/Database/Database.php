<?php
/**
 * Created by PhpStorm.
 * User: Katie
 * Date: 16/12/2015
 * Time: 14:00
 */

namespace Postflix\Database;

/**
 * Class Database
 * @package Postflix\Database
 * Singleton - provides a connection to the database
 */
class Database {
    protected static $instance = null;
    protected $dbHandler;

    public static function getInstance() {
        $username = 'root';
        $password = 'katie';
        $host = 'localhost';
        $dbname = 'dvdrental';

        if (self::$instance === null) {
            self::$instance = new self($username, $password, $host, $dbname);
        }

        return self::$instance;
    }

    private function __construct($username, $password, $host, $database) {
        try {
            $this->dbHandler = new \PDO("mysql:host=$host;dbname=$database", $username, $password);
        } catch (\PDOException $e) {
            echo($e->getMessage());
        }
    }

    public function getDbHandler() {
        return $this->dbHandler;
    }

    public function __destruct() {
        $this->dbHandler = null;
    }
}