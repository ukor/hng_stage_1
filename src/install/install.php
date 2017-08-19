<?php
/**
 * Created with PhpStorm by proctor.
 * @author Ukor Jidechi Ekundayo << http://ukorjidechi.com || ukorjidechi@gmail.com>>.
 * Date: 8/19/17
 * Time: 8:09 PM
 */

namespace ukorJidechi\src\install;


use ukorJidechi\php_pdo_wrapper\database_handler;

class install extends database_handler
{

    private $dummy_table = null;

    private $sql = null;

    private $sql_count = null;

    private $count = null;

    private $token = null;

    private $hash = null;

    function create_table ()
    {
        $this->dummy_table = "CREATE TABLE IF NOT EXISTS `dummy_table`(
                                `id` BIGINT (9) AUTO_INCREMENT NOT NULL PRIMARY KEY,
                                `token` VARCHAR (35) NOT NULL ,
                                `hash` VARCHAR (150) NOT NULL
                              )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE = utf8_unicode_ci;";

        try{
            //start transaction for multiple query;
            $this->beginTransaction();

            $this->exec($this->dummy_table);

            #end the transaction
            $this->endTransaction();

            return true;
        } catch (\PDOException $sql){
            //TODO: Some logging function or email to developer or admin

            //roll back the transaction since there was an error...
            $this->cancelTransaction();
            return $sql . "<br>". $sql->getMessage();
        }
    }

    function put_dummy_data()
    {
        $this->sql_count = "SELECT COUNT(id) AS count FROM dummy_table WHERE id > 0";
        $this->prepare($this->sql_count);
        $this->execute();
        if($this->single_fetch()['count'] < 10)
        {
            $i = 1;
            while ($i <= 10)
            {
                /**
                 * Generate token and hash
                 */
                $this->token = uniqid("ukor_");
                $this->hash = sha1($this->token);
                /**
                 * Insert data
                 */
                $this->sql = "INSERT INTO dummy_table (token, hash) VALUES (:t, :h)";
                $this->prepare($this->sql);
                /**
                 * Replace placeholders with var $token and $hash  respectively
                 */
                $this->bind(":t", $this->token);
                $this->bind(":h", $this->hash);
                $this->execute();
                /**
                 * Increment property count by 1 if insertion was successful else add 0
                 */
                $this->rowCount() === 1 ? $this->count += 1 : $this->count += 0;
                /**
                 * Increment @var $i @type int by 1
                 */
                $i++;
            }
            if ($this->count > 0)
            {
                return printf("%d data where inserted", $this->count);
            }
            else{
                return false;
            }
        }
    }

}