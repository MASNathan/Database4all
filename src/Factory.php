<?php

namespace MASNathan\Database4all;
// MySQL Drivers
use MASNathan\Database4all\Mysql\Configuration as MysqlConfiguration;
use MASNathan\Database4all\Mysql\Drivers\PdoDatabase as MysqlPdoDatabase;
use MASNathan\Database4all\Mysql\Drivers\MysqliDatabase;
// SQLite Drivers
use MASNathan\Database4all\Sqlite\Configuration as SqliteConfiguration;
use MASNathan\Database4all\Sqlite\Drivers\PdoDatabase as SqlitePdoDatabase;

class Factory
{

    /**
     * Returns a Mysql Database Configuration
     * @param string $host Hostname
     * @param string $user Username
     * @param string $pass Password
     * @param string $name Database Name
     * @return MysqlConfiguration
     */
    static public function getMysqlConfiguration($host, $user, $pass, $name)
    {
        return new MysqlConfiguration($host, $user, $pass, $name);
    }

    /**
     * Creates a SQLite Database Configuration
     * @param string $filepath Path to the database file
     * @return SqliteConfiguration
     */
    static public function getSqliteConfiguration($filepath)
    {
        return new SqliteConfiguration($filepath);
    }

    /**
     * Returns the most suitable Database Connection
     * @param  Configuration $config Database Configuration
     * @return DatabaseInterface
     */
    static public function getDatabase(Configuration $config)
    {
        switch (get_class($config)) {
            case 'MASNathan\Database4all\Mysql\Configuration':
                if (class_exists('PDO')) {
                    return new MysqlPdoDatabase($config);
                }

                if (class_exists('mysqli')) {
                    return new MysqliDatabase($config);
                }

                throw new \Exception("None of the supported drivers for MySQL is installed.");

            case 'MASNathan\Database4all\Sqlite\Configuration':
                if (class_exists('PDO')) {
                    return new SqlitePdoDatabase($config);
                }

                throw new \Exception("None of the supported drivers for SQLite is installed.");
            
            default:
                throw new \Exception("Driver not supported");
        }
    }
}