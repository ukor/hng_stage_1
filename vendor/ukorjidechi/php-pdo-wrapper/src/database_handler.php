<?php
/**
 * Created with PhpStorm by:
 * @author Ukor Jidechi Ekundayo << https://ukorjidechi.com || ukorjidechi@gmail.com>>.
 * Date: 2016/10/21
 * Time: 12:14 AM
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

/** TODO: Implement error handling */

namespace ukorJidechi\php_pdo_wrapper;


class database_handler extends database {
    private $stmt;

    /**
     * @param $sql_query
     * @return mixed
     */
    final function query($sql_query){
        return $this->stmt = $this->database_connection->query($sql_query);
    }

    /**
     * @param $sql_query
     * @return mixed
     */
    final function exec($sql_query){
        return $this->stmt = $this->database_connection->exec($sql_query);
    }

    /**
     * @param $sql_query
     * @return mixed
     */
    final function prepare($sql_query){
        return $this->stmt = $this->database_connection->prepare($sql_query);
    }

    /**
     * @return mixed
     */
    final function single_fetch(){
        $this->execute();
        return $this->stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * @return mixed
     */
    final function multiple_fetch(){
        $this->execute();
        return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @return mixed
     */
    final function rowCount(){
        return $this->stmt->rowCount();
    }

    /**
     * @return mixed
     */
    final function lastInsertedId(){
        return $this->database_connection->lastInsertId();
    }

    /**
     * @return mixed
     */
    final function execute(){
        return $this->stmt->execute();
    }

    /**
     * @param $parameter_array
     * @return bool
     */
    final function execute_with_array($parameter_array){
        if(!is_array($parameter_array)){
            //argument is not an array
            return false;
        }else{
            //argument is a parameter

            return $this->stmt->execute($parameter_array);
        }
    }

    /**
     * @param $placeholder
     * @param $value
     * @param null $type
     */
    final function bind($placeholder, $value, $type = null){
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = \PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = \PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = \PDO::PARAM_NULL;
                    break;
                default:
                    $type = \PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($placeholder, $value, $type);
    }

    /**
     * @param $placeholder
     * @param $value
     * @param null $type
     */
    final function bind_param($placeholder, $value, $type = null){
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = \PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = \PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = \PDO::PARAM_NULL;
                    break;
                default:
                    $type = \PDO::PARAM_STR;
            }
        }
        $this->stmt->bindParam($placeholder, $value, $type);
    }

    /**
     *
     */
    final function num_rows(){
        $this->stmt->fetchColumn();
    }

    /**
     * perform multiple changes to a database in one batch
     * @return mixed
     */
    final function beginTransaction(){
        return $this->database_connection->beginTransaction();
    }

    /**
     * @return mixed
     */
    final function endTransaction(){
        return $this->database_connection->commit();
    }

    /**
     * @return mixed
     */
    final function cancelTransaction(){
        return $this->database_connection->rollBack();
    }
}