<?php
use Phalcon\Debug,
    Phalcon\Mvc\Micro,
    Phalcon\Exception;

/* debug settings */

error_reporting(E_ALL);

$debug = new Debug();
$debug->listen();

/* include config files */

$config = require __DIR__ . '/config/config.php';
$config->merge(require __DIR__ . '/config/database.php');
require __DIR__ . '/config/loader.php';
require __DIR__ . '/config/services.php';

/* app */

try {
  $app = new Micro($di);

  require __DIR__ . '/users.php';

  $app->handle();
} catch(Exception $e) {
  echo "Phalcon: " . $e->getMessage();
} catch(PDOException $e) {
  echo "PDO: " . $e->getMessage();
}
