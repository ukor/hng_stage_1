<?php
/**
 * Created with PhpStorm by proctor.
 * @author Ukor Jidechi Ekundayo << http://ukorjidechi.com || ukorjidechi@gmail.com>>.
 * Date: 8/19/17
 * Time: 8:03 PM
 */

require __DIR__."/src/config/config.php";

echo "All this page does is to read and display the raw data from the database. <br><pre>";

/**
 * Print the raw data
 */
print_r((new \ukorJidechi\src\crud\crud())->read());