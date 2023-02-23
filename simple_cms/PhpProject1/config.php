<?php

session_start();

define('MYSQL_SERVER', 'localhost:3307');
define('MYSQL_DATABASE', 'simple_cms');
define('MYSQL_USERNAME', 'faradars');
define('MYSQL_PASSWORD', '1234');

define('SITE_URL', 'http://localhost/phpproject1/');
define('SITE_PATH', __DIR__ . DIRECTORY_SEPARATOR);
define('APP_TITLE', 'الگوهای طراحی');

foreach (glob('lib/*.php') as $lib_file) {
    include_once($lib_file);
}
//create_db_tables();
//initialize_users();