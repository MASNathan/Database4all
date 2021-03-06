<?php

/**
 * @todo  write proper tests
 */

namespace MASNathan\Database4all;

use MASNathan\Database4all\Drivers\Mysql\Configuration as MysqlConfiguration;
use MASNathan\Database4all\Drivers\Mysql\Pdo\Database as PdoDatabase;
use MASNathan\Database4all\Drivers\Mysql\Mysqli\Database as MysqliDatabase;
use MASNathan\Database4all\Drivers\Sqlite\Configuration as SqliteConfiguration;
use MASNathan\Database4all\Drivers\Sqlite\Sqlite3\Database as Sqlite3Database;

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once '../vendor/autoload.php';

$config = new MysqlConfiguration('localhost', 'root', '', 'crawler');
$config = new SqliteConfiguration('/var/www/liteadmin/databases/test.sqlite');

//$db = new PdoDatabase($config);
//$db = new MysqliDatabase($config);
//$db = Factory::getDatabase($config);
$db = new Sqlite3Database($config);

//dump($db->escape("asd' -- asd' + \'\\"));

//$result = $db->execute("INSERT INTO test (data) VALUES ('baasdasdadas')");
//dump($result, $db->getLastInsertId());

//$result = $db->execute("UPDATE test SET data = 'poipoipoip' WHERE id = 15");
//dump($result, $db->getLastErrorCode(), $db->getLastErrorMessage());

//$result = $db->execute("DELETE FROM test WHERE id = 11");
//dump($result, $db->getLastErrorCode(), $db->getLastErrorMessage());

$result = $db->query("SELECT * FROM test");

//$data = $result->getOne(Result::FETCH_ASSOC);
//dump($data);
//$data = $result->getOne(Result::FETCH_OBJECT);
//dump($data);
//$data = $result->getOne(Result::FETCH_CLASS, 'MASNathan\Object');
//dump($data);

//$data = $result->getAll(Result::FETCH_ASSOC);
//dump($data);
//$data = $result->getAll(Result::FETCH_OBJECT);
//dump($data);
$data = $result->getAll(Result::FETCH_CLASS, 'MASNathan\Object');
dump($data);

dump($result);