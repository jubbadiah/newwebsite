<?php

namespace Jubby\View;

use Psr\Http\Message\ResponseInterface;

class Twig implements View
{
    private $view;

    public function __construct($view)
    {
        $this->view = $view;
    }

    public function render(ResponseInterface $response, $template, $data = [])
    {
        $response->getBody()->write($this->view->render($template, $data));

        return $response;
    }
}
