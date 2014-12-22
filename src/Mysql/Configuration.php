<?php

namespace MASNathan\Database4all\Mysql;
use MASNathan\Database4all\Configuration as ConfigParent;

class Configuration extends ConfigParent
{
    /**
     * Hostname
     * @var string
     */
    public $host;

    /**
     * Username
     * @var string
     */
    public $user;

    /**
     * Password
     * @var string
     */
    public $pass;

    /**
     * Database Name
     * @var string
     */
    public $name;

    /**
     * Creates a Mysql Database Configuration
     * @param string $host Hostname
     * @param string $user Username
     * @param string $pass Password
     * @param string $name Database Name
     */
    public function __construct($host, $user, $pass, $name)
    {
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->name = $name;
    }
}
