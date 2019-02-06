<?php
namespace Jubby\Controller;

class HomeController
{
    private $view;

    public function __construct($view)
    {
        $this->view = $view;
    }

    public function get($request, $response, $args)
    {
        return $this->view->render('home.html.twig');
    }
}