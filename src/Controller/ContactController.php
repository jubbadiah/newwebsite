<?php
namespace Jubby\Controller;

class ContactController
{
    private $view;

    public function __construct(\Slim\Views\Twig $view)
    {
        $this->view = $view;
    }

    public function get($request, $response, $args)
    {
        return $this->view->render($response, 'contact.html.twig');
    }
}