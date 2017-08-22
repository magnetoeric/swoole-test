<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 17-6-1
 * Time: 下午9:45
 */
require 'vendor/autoload.php';
$config_file = 'config.ini';
define('_DIR_SEPARATOR_',DIRECTORY_SEPARATOR);
define('_DS_',          _DIR_SEPARATOR_);
define('_PS_',          PATH_SEPARATOR);
define('_ROOT_',        dirname(__FILE__) . _DIR_SEPARATOR_);
define('_CONFIG_',      _ROOT_ . 'config' . _DIR_SEPARATOR_);
define('_CONFIG_FILE_',_CONFIG_.$config_file);


