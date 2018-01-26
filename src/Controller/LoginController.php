<?php
namespace Jubby\Controller;

class LoginController
{
    private $view;

    public function __construct(\Slim\Views\Twig $view)
    {
        $this->view = $view;
    }

    public function get($request, $response, $args)
    {
        return $this->view->render($response, 'login.html.twig');
    }

    public function post($request, $response, $args)
    {
        $post = $request->getParsedBody();

        //check username exsists

        $user = Jubby\Model\User::where('username', $post['username'])->first();

        if (!$user) {
            //user not found
        }

        if ($user->password !== $post['password']) {
            //p/w doesnt match = error
        }

        $_SESSION["loggedin"] = true;
        //check p/w matching + session
        //p/w match > login

        return $this->view->render($response, 'login.html.twig', [
            'completed' => true,
        ]);
    }
}