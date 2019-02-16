<?php

use Jubby\Controller\{HomeController, ExclusivesController};
use Symfony\Component\Security\Csrf\TokenGenerator\UriSafeTokenGenerator;
use Symfony\Component\Security\Csrf\TokenStorage\NativeSessionTokenStorage;
use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Symfony\Component\Form\Extension\Csrf\CsrfExtension;
use Symfony\Component\Form\Forms;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\RuntimeLoader\FactoryRuntimeLoader;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Bridge\Twig\Extension\FormExtension;

$container = $app->getContainer();

$container['view'] = function ($container) {
    $csrfManager = $container->get('CSRFManager');
    $defaultFormTheme = 'form_div_layout.html.twig';
    $vendorDirectory = realpath(__DIR__.'/../../vendor');
    $appVariableReflection = new \ReflectionClass('\Symfony\Bridge\Twig\AppVariable');
    $vendorTwigBridgeDirectory = dirname($appVariableReflection->getFileName());
    $viewsDirectory = realpath(__DIR__.'/../Views');

    $twig = new Environment(new FilesystemLoader([
        $viewsDirectory,
        $vendorTwigBridgeDirectory.'/Resources/views/Form',
    ]));

    $formEngine = new TwigRendererEngine([$defaultFormTheme], $twig);

    $twig->addRuntimeLoader(new FactoryRuntimeLoader([
        \Symfony\Component\Form\FormRenderer::class => function () use ($formEngine, $csrfManager) {
            return new \Symfony\Component\Form\FormRenderer($formEngine, $csrfManager);
        },
    ]));

    $filter = new Twig_Filter('trans', function ($string) {
        return $string;
    });

    $twig->addFilter($filter);

    $twig->addExtension(new FormExtension());

    $twig->addGlobal('session', $_SESSION);

    return $twig;
};

$container['FormFactory'] = function($container) {
    $validator = Validation::createValidator();

    $formFactory = Forms::createFormFactoryBuilder()
        ->addExtension(new CsrfExtension($container->get('CSRFManager')))
        ->addExtension(new ValidatorExtension($validator))
        ->getFormFactory();

    return $formFactory;
};

$container['CSRFManager'] = function($container) {
    $csrfGenerator = new UriSafeTokenGenerator();
    $csrfStorage = new NativeSessionTokenStorage();
    $csrfManager = new CsrfTokenManager($csrfGenerator, $csrfStorage);

    return $csrfManager;
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

$container['BasketController'] = function($container) {
    $view = $container->get('view');
    return new \Jubby\Controller\BasketController($view);
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
    $formFactory = $container->get('FormFactory');
    return new \Jubby\Controller\SignupController($view, $formFactory);
};

$container['AccountController'] = function($container) {
    $view = $container->get('view');
    return new \Jubby\Controller\AccountController($view);
};

$container['LogoutController'] = function($container) {
    $view = $container->get('view');
    return new \Jubby\Controller\LogoutController($view);
};

$container['PaymentController'] = function($container) {
    $view = $container->get('view');
    return new \Jubby\Controller\PaymentController($view);
};

$container['ChargeController'] = function($container) {
    $view = $container->get('view');
    return new \Jubby\Controller\ChargeController($view);
};


$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);

$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function($container) {
    return $capsule;
};