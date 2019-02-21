<?php
namespace Jubby\Controller;

use Jubby\View\View;

class LoginController
{
    private $view;

    public function __construct(View $view)
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
        $user = $this->getUserByUserName($post["username"]);

        if (!$user) {
            return $this->returnError($response);
        }

        if (!$this->passwordMatch($user,$post["password"])) {
            return $this->returnError($response);
        }

        $_SESSION["loggedin"] = true;
        $_SESSION['username'] = $user->username;
    
        if ($_SESSION["loggedin"] && $_SESSION['basket']){
            return $response->withRedirect('/basket');
        }

        if ($_SESSION["loggedin"]){
            return $response->withRedirect('/');
        }
    }

    private function getUserByUserName($userName)
    {
        return \Jubby\Model\User::where('username', $userName)->first();
    }

    private function passwordMatch($user,$password)
    {
        return \password_verify($password, $user->password);
    }

    private function returnError($response)
    {
        return $this->view->render($response, 'login.html.twig', [
            'error' => true,
        ]);
    }
}