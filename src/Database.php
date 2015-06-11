<?php

/*
 * This file is part of the database4all package.
 *
 * (c) André Filipe <https://github.com/reidukuduro/database4all>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MASNathan\Database4all;

abstract class Database implements DatabaseInterface
{

    /**
     * Database holder
     * @var mixed
     */
    protected $database;

    /**
     * Magic function that is called when the object is destroyed and closes the database connection
     */
    public function __destruct()
    {
        $this->close();
    }

    /**
     * Sets a database connection
     * @param mixed $connection Database connection
     */
    protected function setConnection($connection)
    {
        $this->database = $connection;
    }

    /**
     * Returns the database connection
     * @return mixed Database connection if any
     */
    public function getConnection()
    {
        return $this->database;
    }
}
