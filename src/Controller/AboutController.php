<?php
namespace Jubby\Controller;

use Jubby\View\View;

class AboutController
{
    private $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function get($request, $response, $args)
    {
        return $this->view->render($response, 'about.html.twig');
    }
}

