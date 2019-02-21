<?php

namespace Jubby\View;

use Psr\Http\Message\ResponseInterface;

interface View
{
    public function render(ResponseInterface $response, $template, $data = []);
}
