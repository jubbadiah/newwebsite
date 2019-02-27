<?php

$app->get('/', 'HomeController:get');

$app->get('/exclusives', 'ExclusivesController:get'); //confirms location of controller / gets the controller required.

$app->get('/buy', 'BuyController:get'); 

$app->get('/basket', 'BasketController:get'); 
$app->get('/basket/add/{id:[0-9]+}', 'BasketController:add'); 
$app->get('/basket/remove/{id:[0-9]+}', 'BasketController:remove'); 


$app->get('/contact', 'ContactController:get'); 

$app->get('/payment', 'PaymentController:get'); 
$app->post('/charge', 'ChargeController:post'); 


$app->get('/about', 'AboutController:get'); 

$app->map(['GET', 'POST'], '/login', 'LoginController:login');

$app->map(['GET', 'POST'], '/signup', 'SignupController:register');

$app->get('/account', 'AccountController:get'); 

$app->get('/logout', 'LogoutController:get');

