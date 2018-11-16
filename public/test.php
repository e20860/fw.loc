<?php

/* 
 * Лицензионный заголовок.
 * Авторские права на этот проект не распространяются
 * Открытый фреймворк.
 */
require 'rb-mysql.php';
$db = require '../config/config_db.php';
R::setup($db['dsn'], $db['user'], $db['pass']);
R::fancyDebug(TRUE);
//var_dump(R::testConnection());


// create
//$cat = R::dispense('category');
//$cat->title = 'Категория 1';
//$id = R::store($cat);
//R::freeze(TRUE);


//read
//$var = R::load('category', 1);
//echo var_dump($var['title']);

// update

//$cat = R::load('category', 2);
//$cat->title = 'Категория 2';
//R::store($cat);

// delete
//$cat = R::load('category', 4);
//R::trash($cat);
// чтобы очистить таблицу
// R::wipe($cat);

// Поиск
//$cats = R::findAll('category'); // все запси
//$cats = R::findAll('category', 'id > 2');
//print_r($cats);
$cats = R::findAll('category', 'title LIKE ?', ['%1%']);
print_r($cats);


