<?php
namespace Jubby\Controller;

class ChargeController
{
    private $view;

    public function __construct(\Slim\Views\Twig $view)
    {
        $this->view = $view;
    }

    public function post($request, $response, $args)
    {
        return $this->view->render($response, 'charge.html.twig');
    }
}