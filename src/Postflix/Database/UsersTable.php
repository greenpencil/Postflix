<?php
/**
 * Created by PhpStorm.
 * User: Katie
 * Date: 16/12/2015
 * Time: 15:44
 */

namespace Postflix\Database;


use Postflix\Dvd;
use Postflix\User;

class UsersTable extends TableAbstract {
    protected $name = 'users';
    protected $primaryKey = 'id';

    function fetchAllUsers()
    {
        $results = $this->fetchAll();
        $userArray = array();
        while ($row = $results->fetch()) {
            $userArray[] = new User($row);
        }
        return $userArray;
    }

    function fetchUserByID($id)
    {
        $row = $this->fetchByPrimaryKey($id);
        $newUser = NULL;
        if($row) {
            $newUser = new User($row);
        }
        return $newUser;
    }

    function addNewUser($data)
    {
        $sql = 'INSERT INTO '. $this->name .' (name, email, password, address, mobile_number) VALUES (:name, :email, :password, :address, :mobile)';
        $result = $this->dbHandler->prepare($sql);
        $result->execute(array(
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':password' => $data['password'],
            ':address' => $data['address'],
            ':mobile' => $data['mobile']
        ));
        return $this->dbHandler->lastInsertId();
    }

    function fetchUserByEmail($email)
    {
        $sql = 'SELECT * FROM '. $this->name .' WHERE email = :email';
        $results = $this->dbHandler->prepare($sql);
        $results->execute(array(
            ':email' => $email
        ));
        $row = $results->fetch();
        if($row) {
            $user = new User($row);
        } else {
            $user = NULL;
        }
        return $user;
    }

    function fetchWishList($userId)
    {
        $sql = 'SELECT dvds.id, dvds.name, dvds.synopsis, dvds.director_id,
                  dvds.release_year, dvds.priceband_id, dvds.user_id FROM dvds, wishlist WHERE dvds.id = dvd_id AND wishlist.user_id = :userId';
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

    function addToWishList($dvdId, $userId)
    {
        $sql = 'INSERT INTO wishlist(user_id, dvd_id) VALUES (' .$userId. ', ' . $dvdId . ')';
        $results = $this->dbHandler->prepare($sql);
        $results->execute();

    }

    function removeFromWishList($dvdId, $userId)
    {
        $sql = 'DELETE FROM wishlist WHERE dvd_id = '.$dvdId . ' AND user_id = ' . $userId;
        $results = $this->dbHandler->prepare($sql);
        $results->execute();
    }

    function clearWishList($userId)
    {
        $sql = 'DELETE FROM wishlist WHERE user_id = ' . $userId;
        $results = $this->dbHandler->prepare($sql);
        $results->execute();
    }
}