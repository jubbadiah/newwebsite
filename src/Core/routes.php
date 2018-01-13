<?php

$app->get('/', 'HomeController:get');

$app->get('/exclusives', 'ExclusivesController:get'); //confirms location of controller / gets the controller required.

$app->get('/buy', 'BuyController:get'); 

$app->get('/contact', 'ContactController:get'); 

$app->get('/about', 'AboutController:get'); 

$app->get('/login', 'LoginController:get'); 