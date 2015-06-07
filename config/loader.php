<?php
use Phalcon\Loader;

/* loadder settings */

$loader = new Loader();

$loader->registerDirs(array(
  $config->app->modelsDir
))->register();
