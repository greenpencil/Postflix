<?php
/**
 * Created by PhpStorm.
 * User: Katie
 * Date: 21/12/2015
 * Time: 15:55
 */

namespace Postflix;


use Postflix\Database\DvdTable;

class PriceBand {
    private $id;
    private $character;
    private $price;

    private $dvds;

    function __construct($row)
    {
        $this->id = $row['id'];
        $this->character = $row['character'];
        $this->price = $row['price'];
    }

    public function getDvds()
    {
        if($this->dvds == NULL) {
            $dvdTableLink = new DvdTable();
            $this->dvds = $dvdTableLink->fetchDvdsByPriceBandId($this->id);
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
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return mixed
     */
    public function getCharacter()
    {
        return $this->character;
    }

}