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

class PdoResult extends Result
{
    public function __construct(\PDOStatement $dataResult)
    {
        parent::__construct($dataResult);

        $this->rows = $this->dataResult->rowCount();
    }

    /**
     * Fetches one row as an array
     * @return array
     */
    protected function fetchOneAssoc()
    {
        return $this->dataResult->fetch(\PDO::FETCH_ASSOC);
    }
    
    /**
     * Fetches one row as an object
     * @return \StdClass
     */
    protected function fetchOneObject()
    {
        return $this->dataResult->fetch(\PDO::FETCH_OBJ);
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
        return $this->dataResult->fetchALL(\PDO::FETCH_ASSOC);
    }
    
    /**
     * Returns an list of objects with the query results
     * @return array
     */
    protected function fetchAllObject()
    {
        return $this->dataResult->fetchALL(\PDO::FETCH_OBJ);
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
