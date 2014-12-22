<?php

namespace MASNathan\Database4all\Sqlite;
use MASNathan\Database4all\Configuration as ConfigParent;

class Configuration extends ConfigParent
{

    /**
     * Path to the database file
     * @var string
     */
    public $filepath;

    /**
     * Creates a SQLite Database Configuration
     * @param string $filepath Path to the database file
     */
    public function __construct($filepath)
    {
        $this->filepath = $filepath;
    }
}
