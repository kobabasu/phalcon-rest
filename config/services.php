<?php
use Phalcon\DI\FactoryDefault,
    Phalcon\Mvc\Url,
    Phalcon\Db\Adapter\Pdo\Mysql;

$di = new FactoryDefault();

/* url settings */

$di->set('url', function() use ($config) {
  $url = new Url();
  $url->setBaseUri($config->baseurl);
  return $url;
});

/* database settings */

$di->set('db', function() use ($config) {
  return new Mysql(array(
    'host'     => $config->db->host,
    'dbname'   => $config->db->dbname,
    'username' => $config->db->username,
    'password' => $config->db->password
  ));
});
