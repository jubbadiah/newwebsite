<?php

require '../vendor/autoload.php';

$settings = require '../src/Core/settings.php'; //used to call settings

$app = new \Slim\App($settings); //used to call settings

require '../src/Core/dep.php'; //used to confirm dependancies needed

require '../src/Core/routes.php'; // used to confirm routes

$app->run();