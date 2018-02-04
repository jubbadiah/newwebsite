<?php
namespace Jubby\Controller;

class LogoutController
{
    private $view;

    public function __construct(\Slim\Views\Twig $view)
    {
        $this->view = $view;
    }

    public function get($request, $response, $args)
    {
        session_unset();
        return $response->withRedirect('/');
    }
}