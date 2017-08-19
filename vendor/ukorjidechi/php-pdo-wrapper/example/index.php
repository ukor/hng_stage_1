<?php
/**
 * Created with PhpStorm by:
 * @author Ukor Jidechi Ekundayo << https://ukorjidechi.com || ukorjidechi@gmail.com>>.
 * Date: 5/9/17
 * Time: 10:33 AM
 *
 * REMEMBER TO CHANGE YOUR USER NAME, PASSWORD AND DATABASE NAME IN __DIR__."/src/database.php
 */

require_once (__DIR__."/../vendor/autoload.php");
$bar = new \ukorJidechi\php_pdo_wrapper\database_handler();
echo "<br /><pre>";
print_r($bar);