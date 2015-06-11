<?php

/*
 * This file is part of the database4all package.
 *
 * (c) André Filipe <https://github.com/reidukuduro/database4all>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MASNathan\Database4all\Drivers;

use MASNathan\Database4all\DatabaseInterface;

abstract class PdoDatabase implements DatabaseInterface
{
    /**
     * Database holder
     * @var mixed
     */
    protected $database;

    /**
     * Sets a database connection
     * @param mixed $connection Database connection
     */
    protected function setConnection($connectionString, $user = null, $pass = null, $connectioOptions = null)
    {
        $pdoConnection  = new \PDO($connectionString, $user, $pass, $connectioOptions);
        /**
         * @todo  Check if connection is ok
         */
        $this->database = $pdoConnection;
    }

    /**
     * Returns the database connection
     * @return mixed Database connection if any
     */
    public function getConnection()
    {
        return $this->database;
    }

    /**
     * Magic function that is called when the object is destroyed and closes the database connection
     */
    public function __destruct()
    {
        $this->close();
    }

    /**
     * Closes the database connection
     * @return null
     */
    public function close()
    {
        $this->database = null;
    }

    /**
     * Escapes a string
     * @param  string $string String to escape
     * @return string         Escaped string
     */
    public function escape($string)
    {
        return $this->database->quote($string);
    }

    /**
     * Executes a query
     * @param  string $sql SQL query
     * @return boolean     True if successful, False if not
     */
    public function execute($sql)
    {
        return (bool) $this->database->exec($sql);
    }
    
    /**
     * Executes a bunch of querys
     * @param  string $sql SQL query
     * @return boolean     True if successful, False if not
     */
    public function executeMultiple($sql)
    {

    }
    
    /**
     * Executes the querys on a file
     * @param  string $filepath File location
     * @return boolean          True if successful, False if not
     */
    public function executeFile($filepath)
    {
        return $this->executeMultiple(\file_get_contents($filepath));
    }

    /**
     * Executes a query returning it's values
     * @param  string $sql SQL [SELECT] query
     * @return Result
     */
    public function query($sql)
    {
        $result = $this->database->query($sql);
        if ($result) {
            return new PdoResult($result);
        }
        return false;
    }

    /**
     * Returns the last error code
     * @return string Error code
     */
    public function getLastErrorCode()
    {
        $errorInfo = $this->database->errorInfo();
        return $errorInfo[1];
    }

    /**
     * Returns the last error message
     * @return string Error message
     */
    public function getLastErrorMessage()
    {
        $errorInfo = $this->database->errorInfo();
        return $errorInfo[2];
    }

    /**
     * Returns the last inserted ID
     * @return integer Last Inserted ID
     */
    public function getLastInsertId()
    {
        return (int) $this->database->lastInsertId();
    }
}
