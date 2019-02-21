<?php
namespace Jubby\Controller;

use Jubby\View\View;

class LogoutController
{
    private $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function get($request, $response, $args)
    {
        session_unset();
        return $response->withRedirect('/');
    }
}