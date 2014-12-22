<?php

namespace MASNathan\Database4all;

interface DatabaseInterface
{

    /**
     * Executes a query
     * @param  string $sql SQL query
     * @return boolean     True if successful, False if not
     */
    public function execute($sql);
    
    /**
     * Executes a bunch of querys
     * @param  string $sql SQL query
     * @return boolean     True if successful, False if not
     */
    public function executeMultiple($sql);
    
    /**
     * Executes the querys on a file
     * @param  string $filepath File location
     * @return boolean          True if successful, False if not
     */
    public function executeFile($filepath);

    /**
     * Executes a query returning it's values
     * @param  string $sql SQL [SELECT] query
     * @return Result
     */
    public function query($sql);

    /**
     * Returns the last error code
     * @return string Error code
     */
    public function getLastErrorCode();

    /**
     * Returns the last error message
     * @return string Error message
     */
    public function getLastErrorMessage();

    /**
     * Returns the last inserted ID
     * @return integer Last Inserted ID
     */
    public function getLastInsertId(); 
}
