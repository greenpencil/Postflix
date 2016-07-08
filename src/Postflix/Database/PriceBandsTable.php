<?php
/**
 * Created by PhpStorm.
 * User: Katie
 * Date: 21/12/2015
 * Time: 15:52
 */

namespace Postflix\Database;


use Postflix\PriceBand;

class PriceBandsTable extends TableAbstract{
    protected $name = 'pricebands';
    protected $primaryKey = 'id';

    function fetchPriceBands()
    {
        $results = $this->fetchAll();
        $priceBandArray = array();
        while ($row = $results->fetch()) {
            $priceBandArray[] = new PriceBand($row);
        }
        return $priceBandArray;
    }

    function fetchPriceBandById($id)
    {
        $row = $this->fetchByPrimaryKey($id);
        $newPriceBand = NULL;
        if($row) {
            $newPriceBand = new PriceBand($row);
        }
        return $newPriceBand;
    }

}