<?php

/*
 * This file is part of the database4all package.
 *
 * (c) André Filipe <https://github.com/reidukuduro/database4all>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MASNathan\Database4all\Drivers\Sqlite\Sqlite3;

use MASNathan\Database4all\Database as BaseDatabase;
use MASNathan\Database4all\Drivers\Sqlite\Configuration;

class Database extends BaseDatabase
{
    /**
     * PDO Database Connection initialization method
     * @param Configuration $config
     */
    public function __construct(Configuration $config)
    {
        $sqliteConnection = new \SQLite3($config->filepath);
        /**
         * @todo  Check if connection is ok
         * @todo  Check how the charset can be changed
         */
        $this->setConnection($sqliteConnection);
    }

    /**
     * Closes the database connection
     * @return null
     */
    public function close()
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
        return $this->database->escapeString($string);
    }

    /**
     * Executes a query
     * @param  string $sql SQL query
     * @return boolean     True if successful, False if not
     */
    public function execute($sql)
    {
        return (bool) @$this->database->exec($sql);
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
            return new Result($result);
        }
        return false;
    }

    /**
     * Returns the last error code
     * @return string Error code
     */
    public function getLastErrorCode()
    {
        return $this->database->lastErrorCode();
    }

    /**
     * Returns the last error message
     * @return string Error message
     */
    public function getLastErrorMessage()
    {
        return $this->database->lastErrorMsg();
    }

    /**
     * Returns the last inserted ID
     * @return integer Last Inserted ID
     */
    public function getLastInsertId()
    {
        return (int) $this->database->lastInsertRowID();
    }
}
