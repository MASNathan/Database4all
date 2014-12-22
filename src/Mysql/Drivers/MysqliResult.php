<?php

/*
 * This file is part of the database4all package.
 *
 * (c) André Filipe <https://github.com/reidukuduro/database4all>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MASNathan\Database4all\Mysql\Drivers;
use MASNathan\Database4all\Result;

class MysqliResult extends Result
{
    public function __construct(\mysqli_result $dataResult)
    {
        parent::__construct($dataResult);

        $this->rows = $this->dataResult->num_rows;
    }

    /**
     * Fetches one row as an array
     * @return array
     */
    protected function fetchOneAssoc()
    {
        return $this->dataResult->fetch_assoc();
    }
    
    /**
     * Fetches one row as an object
     * @return \StdClass
     */
    protected function fetchOneObject()
    {
        return $this->dataResult->fetch_object();
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
        return $this->dataResult->fetch_all(MYSQLI_ASSOC);
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
