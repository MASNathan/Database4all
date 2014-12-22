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

abstract class Result
{
    const FETCH_ASSOC  = 0;
    const FETCH_OBJECT = 1;
    const FETCH_CLASS  = 2;

    /**
     * Number of rows in the result
     * @var integer
     */
    public $rows;

    /**
     * Result holder
     * @var mixed
     */
    protected $dataResult;

    /**
     * Result class initialization
     * @param mixed $dataResult Data Result
     */
    public function __construct($dataResult)
    {
        $this->dataResult = $dataResult;
    }

    /**
     * Returns the first row of the result
     * @param  integer $fetchType Fetch Type
     * @param  string  $classType Class Type if you want to use FETCH_CLASS
     * @return mixed Depends on the $fetchType you use
     */
    public function getOne($fetchType = self::FETCH_ASSOC, $classType = null)
    {
        switch ($fetchType) {
            case self::FETCH_ASSOC:
                return $this->fetchOneAssoc();
            case self::FETCH_OBJECT:
                return $this->fetchOneObject();
            case self::FETCH_CLASS:
                return $this->fetchOneClass($classType);
            
            default:
                throw new \Exception("Invalid Fetch Type");
        }
    }

    /**
     * Returns a list with all the results
     * @param  integer $fetchType Fetch Type
     * @param  string  $classType Class Type if you want to use FETCH_CLASS
     * @return array
     */
    public function getAll($fetchType = self::FETCH_ASSOC, $classType = null)
    {
        switch ($fetchType) {
            case self::FETCH_ASSOC:
                return $this->fetchAllAssoc();
            case self::FETCH_OBJECT:
                return $this->fetchAllObject();
            case self::FETCH_CLASS:
                return $this->fetchAllClass($classType);
            
            default:
                throw new \Exception("Invalid Fetch Type");
        }
    }

    /**
     * Fetches one row as an array
     * @return array
     */
    abstract protected function fetchOneAssoc();
    
    /**
     * Fetches one row as an object
     * @return \StdClass
     */
    abstract protected function fetchOneObject();

    /**
     * Fetches one row using a specific class type
     * @param  string $classType Class Type
     * @return mixed
     */
    abstract protected function fetchOneClass($classType);
    
    /**
     * Returns an list of associative arrays with the query results
     * @return array
     */
    abstract protected function fetchAllAssoc();
    
    /**
     * Returns an list of objects with the query results
     * @return array
     */
    abstract protected function fetchAllObject();

    /**
     * Returns an list of objects with the query results
     * @param  string $classType Class Type
     * @return array
     */
    abstract protected function fetchAllClass($classType);
}
