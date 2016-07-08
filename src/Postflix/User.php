<?php
/**
 * Created by PhpStorm.
 * User: Katie
 * Date: 16/12/2015
 * Time: 14:56
 */

namespace Postflix;


use Postflix\Database\DvdTable;
use Postflix\Database\UsersTable;

class User {
    private $id;
    private $name;
    private $email;
    private $password;
    private $address;
    private $mobile_number;

    private $dvds;
    private $wishList;

    function __construct($dbRow)
    {
        $this->id = $dbRow['id'];
        $this->name = $dbRow['name'];
        $this->email = $dbRow['email'];
        $this->password = $dbRow['password'];
        $this->address = $dbRow['address'];
        $this->mobile_number = $dbRow['mobile_number'];
    }

    function getDvds()
    {
        if($this->dvds == NULL)
        {
            $dvdTableLink = new DvdTable();
            $this->dvds = $dvdTableLink->fetchDvdsByUserId($this->id);
        }
        return $this->dvds;
    }

    function getWishList()
    {
        if($this->wishList == NULL)
        {
            $userTableLink = new UsersTable();
            $this->wishList = $userTableLink->fetchWishList($this->id);
        }
        return $this->wishList;
    }

    function addToWishList($dvdId)
    {
        $userTableLink = new UsersTable();
        $userTableLink->addToWishList($dvdId, $this->id);

        $this->wishList = NULL;
    }

    function removeFromWishList($dvdId)
    {
        $userTableLink = new UsersTable();
        $userTableLink->removeFromWishList($dvdId, $this->id);

        $this->wishList = NULL;
    }

    function clearWishList()
    {
        $userTableLink = new UsersTable();
        $userTableLink->clearWishList($this->id);

        $this->wishList = NULL;
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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return mixed
     */
    public function getMobileNumber()
    {
        return $this->mobile_number;
    }
}