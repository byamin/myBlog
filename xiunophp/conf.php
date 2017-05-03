<?php
/**
 * Created by PhpStorm.
 * User: symphp
 * Date: 2017/4/19
 * Time: 14:16
 */

return array (
    'db' => array (
        'type' => 'pdo_mysql',
        'pdo_mysql' => array (
            'master' => array (
                'host' => 'localhost',
                'user' => 'root',
                'password' => 'root',
                'name' => 'test',
                'tablepre' => '',
                'charset' => 'utf8',
                'engine' => 'innodb',
            ),
            'slaves' => array (),
        ),
    ),
);