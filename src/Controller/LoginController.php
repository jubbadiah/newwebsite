<?php
namespace Jubby\Controller;

use Jubby\View\View;
use Jubby\Form\Type\UserLoginType;
use Jubby\Form\Model\User as UserFormModel;
use Jubby\Model\User;
use Symfony\Component\Form\FormError;

class LoginController
{
    private $view;
    private $formFactory;

    public function __construct(View $view, $formFactory)
    {
        $this->view = $view;
        $this->formFactory = $formFactory;
    }

    public function login($request, $response, $args)
    {
        if (isset($_SESSION["loggedin"])){
            return $response->withRedirect('/');
        }

        $user = new UserFormModel();
        $form = $this->formFactory->create(UserLoginType::class, $user);

        $form->handleRequest();

        if ($form->isSubmitted() && $form->isValid()) {
            $loginUser = User::where('email', $user->getEmail())->first();

            if (!is_null($loginUser) && password_verify($user->getPassword(), $loginUser->password)) {
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $user->getEmail();
                return $response->withRedirect('/');
            }

            $form->addError(new FormError('Incorrect username or password'));
        }

        return $this->view->render($response, 'login.html.twig', [
            'form' => $form->createView()
        ]);
    }
}