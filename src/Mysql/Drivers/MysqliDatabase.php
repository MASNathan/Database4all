<?php

namespace MASNathan\Database4all\Mysql\Drivers;
use MASNathan\Database4all\DatabaseInterface;
use MASNathan\Database4all\Mysql\Configuration;

class MysqliDatabase
    implements DatabaseInterface
{

    /**
     * Database holder
     * @var \mysqli
     */
    protected $database;

    /**
     * Mysqli Database Connection initialization method
     * @param Configuration $config
     */
    public function __construct(Configuration $config)
    {
        $this->database = new \mysqli($config->host, $config->user, $config->pass, $config->name);
        /**
         * @todo  Check if connection is ok
         */
        $this->database->set_charset($config->charset);
    }

    public function __destruct()
    {
        $this->database->close();
    }

    /**
     * Escapes a string
     * @param  string $string String to escape
     * @return string         Escaped string
     */
    public function escape($string)
    {
        return $this->database->real_escape_string($string);
    }

    /**
     * Executes a query
     * @param  string $sql SQL query
     * @return boolean     True if successful, False if not
     */
    public function execute($sql)
    {
        if ($this->database->query($sql) === true) {
            return true;
        }

        return false;
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
            return new MysqliResult($result);
        }
        return false;
    }

    /**
     * Returns the last error code
     * @return string Error code
     */
    public function getLastErrorCode()
    {
        return $this->database->errno;
    }

    /**
     * Returns the last error message
     * @return string Error message
     */
    public function getLastErrorMessage()
    {
        return $this->database->error;
    }

    /**
     * Returns the last inserted ID
     * @return integer Last Inserted ID
     */
    public function getLastInsertId()
    {
        return $this->database->insert_id;
    }
}
