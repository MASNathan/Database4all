<?php

/*
 * This file is part of the database4all package.
 *
 * (c) André Filipe <https://github.com/reidukuduro/database4all>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MASNathan\Database4all\Drivers\Mysql\Pdo;

use MASNathan\Database4all\Drivers\PdoDatabase;
use MASNathan\Database4all\Drivers\Mysql\Configuration;

class Database extends PdoDatabase
{
    /**
     * PDO Database Connection initialization method
     * @param Configuration $config
     */
    public function __construct(Configuration $config)
    {
        $connectionString = sprintf("mysql:host=%s;dbname=%s", $config->host, $config->name);
        $connectioOptions = array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . $config->charset);
        
        $this->setConnection($connectionString, $config->user, $config->pass, $connectioOptions);
    }
}
