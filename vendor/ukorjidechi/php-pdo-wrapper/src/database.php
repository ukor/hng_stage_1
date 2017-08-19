<?php
/**
 * Created with PhpStorm by:
 * @author Ukor Jidechi Ekundayo << https://ukorjidechi.com || ukorjidechi@gmail.com>>.
 * Date: 2016/10/18
 * Time: 11:29 AM
 *
 *
 * MIT License
 *
 * Copyright (c) 2017 Ukor Jidechi Ekundayo
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace ukorJidechi\php_pdo_wrapper;


class database{
    protected $database_connection;

    /**
     * db_connect constructor.: opens connection to database
     */
    function __construct(){

        /**@host
         * set the host, this is usually "localhost",
         * ask you hosting company for this...
         * @port
         * Leave as it is, Change if you know what you doing
         * @username
         * change this to your database username,
         * Recommend you create another user with less privilege
         * it is usually root, if you not sure ask your hosting company for this
         * @password
         * change this to whatever password you set for database in user
         * @database_name
         * create a database with phpMyAdmin or from terminal,
         * you can name it with any name that interest you
         * but make sure to change the name here
         * @charset
         * set charset, leave this just as it is
         * @table_prefix
         * set database table prefix, change to what ever you like
         */

        $config = [
            "host"=> "localhost",       /** usually localhost */

            "port"=> 80,                /** leave as it is if not sure */

            "username"=> "hng",        /** Mysql username, usually "root". Recommend to create a new user with less privilege */

            "password"=> "hng",    /** password to MySQL username, leave blank if no password is set */

            "database_name"=> "hng_stage_1",

            "charset" => "utfmb4",      /** leave as it is */

            "table_prefix" => ""        /** optional */
        ];

        try{
            $this->open_db_connection((array) $config);
        }catch(\PDOException $e){

            //TODO: Some logging function and email to developer or admin

            echo "something went wrong ";
        }
        //$this->open_db_connection();
    }

    /**
     *db_connect destructor.: close connection to database
     */
    function __destruct(){

        try {
            $this->close_db_connection();
        }catch (\PDOexception $e){

            //TODO: Some logging functions and maybe mail to developer or admin of the website
            echo "database was not close";
        }
        //$this->close_db_connection();
    }


    /**
     * connect to the database
     * @param array $config
     * @return \PDO
     */
    final protected function open_db_connection(array $config){

        $dns = 'mysql:host=' . $config['host'] . ';dbname=' . $config['database_name'];

        $this->database_connection = new \PDO($dns, $config['username'], $config['password']
        );

        $this->database_connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        $this->database_connection->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);

        return $this->database_connection;
    }


    /**
     * close database connection
     * @return null
     */
    final protected function close_db_connection(){
        $this->database_connection = null;
    }
}
