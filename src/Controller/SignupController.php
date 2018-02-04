<?php
namespace Jubby\Controller;

use Jubby\Model\User;

class SignupController
{
    private $view;

    public function __construct(\Slim\Views\Twig $view)
    {
        $this->view = $view;
    }

    public function get($request, $response, $args)
    {

        return $this->view->render($response, 'signup.html.twig');
    }

    public function post($request, $response, $args)
    {
        $post = $request->getParsedBody();

        $user = new User;
        $user->username = $post['username'];
        $user->password = password_hash($post['password'], PASSWORD_DEFAULT);
        $user->email = $post['email'];
        $user->save();
        
        return $this->view->render($response, 'signup.html.twig', [
            'completed' => true,
        ]);
    }
}