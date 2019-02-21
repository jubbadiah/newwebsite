<?php
namespace Jubby\Controller;

use Jubby\View\View;

class HomeController
{
    private $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function get($request, $response, $args)
    {
        return $this->view->render($response, 'home.html.twig');
    }
}