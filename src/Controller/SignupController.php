<?php

namespace Jubby\Controller;

use Jubby\Model\User;
use Slim\Views\Twig;
use Jubby\Form\Model\User as UserFormModel;
use Jubby\Form\Type\UserSignupType;
use Jubby\View\View;
use Symfony\Component\Form\FormError;

class SignupController
{
    private $view;
    private $formFactory;

    public function __construct(View $view, $formFactory)
    {
        $this->view = $view;
        $this->formFactory = $formFactory;
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

    public function register($request, $response, $args)
    {
        $user = new UserFormModel();
        $form = $this->formFactory->create(UserSignupType::class, $user);

        $form->handleRequest();

        if ($form->isSubmitted() && $form->isValid()) {
            $userModel = new User;

            $userModel->email = $user->getEmail();
            $userModel->password = password_hash($user->getPlainPassword(), PASSWORD_DEFAULT);

            if ($userModel->save()) {
                return $this->view->render($response, 'signup.html.twig', [
                    'completed' => true,
                ]);
            }

            $form->addError(new FormError('Unable to create. Please try again later'));
        }

        return $this->view->render($response, 'signup.html.twig', [
            'form' => $form->createView()
        ]);
    }
}