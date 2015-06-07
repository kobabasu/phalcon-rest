<?php
use Phalcon\Config;

return new Config(array(
  'db' => array(
    'adapter'  => 'Mysql',
    'host'     => '0.0.0.0',
    'dbname'   => 'phalcon',
    'username' => 'phalcon',
    'password' => 'phalcon012'
  ),
));
