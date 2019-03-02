<?php
namespace Jubby\Controller;

use Jubby\View\View;

class ChargeController
{
    private $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function post($request, $response, $args)
    {
        return $this->view->render($response, 'charge.html.twig');
    }
}