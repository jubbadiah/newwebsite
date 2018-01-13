<?php
namespace Jubby\Controller;

class ExclusivesController
{
    private $view;

    public function __construct(\Slim\Views\Twig $view)
    {
        $this->view = $view;
    }

    public function get($request, $response, $args)
    {
        return $this->view->render($response, 'exclusives.html.twig');
    }
}