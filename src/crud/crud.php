<?php
/**
 * Created with PhpStorm by proctor.
 * @author Ukor Jidechi Ekundayo << http://ukorjidechi.com || ukorjidechi@gmail.com>>.
 * Date: 8/19/17
 * Time: 9:23 PM
 */

namespace ukorJidechi\src\crud;


use ukorJidechi\php_pdo_wrapper\database_handler;

class crud extends database_handler
{
    private $sql = null;

    function read ()
    {
        $this->sql = "SELECT * FROM dummy_table WHERE id > :zero";
        $this->prepare($this->sql);
        $this->bind(":zero", 0);
        $this->execute();
        return count($this->multiple_fetch()) > 0 ? $this->multiple_fetch() : false;
    }
}