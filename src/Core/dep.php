<?php

use Jubby\Controller\{HomeController, ExclusivesController};

$container = $app->getContainer();

$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig('../src/Views/', [
        // 'cache' => 'path/to/cache'
    ]);
    
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));
    $view->getEnvironment()->addGlobal('session', $_SESSION);

    return $view;
};

$container['HomeController'] = function($container) {
    $view = $container->get('view');
    return new \Jubby\Controller\HomeController($view);
};

$container['ExclusivesController'] = function($container) {
    $view = $container->get('view');
    return new \Jubby\Controller\ExclusivesController($view);
};

$container['BuyController'] = function($container) {
    $view = $container->get('view');
    return new \Jubby\Controller\BuyController($view);
};

$container['ContactController'] = function($container) {
    $view = $container->get('view');
    return new \Jubby\Controller\ContactController($view);
};

$container['AboutController'] = function($container) {
    $view = $container->get('view');
    return new \Jubby\Controller\AboutController($view);
};

$container['LoginController'] = function($container) {
    $view = $container->get('view');
    return new \Jubby\Controller\LoginController($view);
};

$container['SignupController'] = function($container) {
    $view = $container->get('view');
    return new \Jubby\Controller\SignupController($view);
};

$container['AccountController'] = function($container) {
    $view = $container->get('view');
    return new \Jubby\Controller\AccountController($view);
};

$container['LogoutController'] = function($container) {
    $view = $container->get('view');
    return new \Jubby\Controller\LogoutController($view);
};


$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);

$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function($container) {
    

    return $capsule;
};