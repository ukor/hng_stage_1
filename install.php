<?php
/**
 * Created with PhpStorm by proctor.
 * @author Ukor Jidechi Ekundayo << http://ukorjidechi.com || ukorjidechi@gmail.com>>.
 * Date: 8/19/17
 * Time: 8:48 PM
 */

require __DIR__."/src/config/config.php";

$install = new \ukorJidechi\src\install\install();

echo "<pre>";
echo $install->create_table()."<br>";
echo $install->put_dummy_data();