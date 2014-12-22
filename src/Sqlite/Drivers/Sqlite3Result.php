<?php

/*
 * This file is part of the database4all package.
 *
 * (c) André Filipe <https://github.com/reidukuduro/database4all>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MASNathan\Database4all\Sqlite\Drivers;
use MASNathan\Database4all\Result;

class Sqlite3Result extends Result
{
    public function __construct(\SQLite3Result $dataResult)
    {
        parent::__construct($dataResult);

        /**
         * @todo There is no way of getting the number of rows unless you loop through all data
         */
        //$this->rows = $this->dataResult->rowCount();
    }

    /**
     * Fetches one row as an array
     * @return array
     */
    protected function fetchOneAssoc()
    {
        return $this->dataResult->fetchArray(SQLITE3_ASSOC);
    }
    
    /**
     * Fetches one row as an object
     * @return \StdClass
     */
    protected function fetchOneObject()
    {
        if ($row = $this->fetchOneAssoc()) {
            $object = new \StdClass();
            foreach ($row as $key => $value) {
                $object->$key = $value;
            }
            return $object;
        }
        return false;
    }

    /**
     * Fetches one row using a specific class type
     * @param  string $classType Class Type
     * @return mixed
     */
    protected function fetchOneClass($classType)
    {
        if ($row = $this->fetchOneAssoc()) {
            return new $classType($row);
        }

        return false;
    }
    
    /**
     * Returns an list of associative arrays with the query results
     * @return array
     */
    protected function fetchAllAssoc()
    {
        $data = array();
        while ($row = $this->fetchOneAssoc()) {
            $data[] = $row;
        }
        return $data;
    }
    
    /**
     * Returns an list of objects with the query results
     * @return array
     */
    protected function fetchAllObject()
    {
        $data = array();
        while ($row = $this->fetchOneObject()) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * Returns an list of objects with the query results
     * @param  string $classType Class Type
     * @return array
     */
    protected function fetchAllClass($classType)
    {
        $data = array();
        while ($row = $this->fetchOneClass($classType)) {
            $data[] = $row;
        }
        return $data;
    }
}
