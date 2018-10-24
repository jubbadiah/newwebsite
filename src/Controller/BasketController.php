<?php
namespace Jubby\Controller;

class BasketController
{
    private $view;

    public function __construct(\Slim\Views\Twig $view)
    {
        $this->view = $view;
    }

    public function get($request, $response, $args)
    {
        return $this->view->render($response, 'basket.html.twig');
    }

    public function add($request, $response, $args) {
        $product = \Jubby\Model\Product::find($args['id']);

        if (!$product) {
            //shows user some error
            return $this->view->render($response, 'basket.html.twig', [
                'error' => true
            ]);
        }

        
        $_SESSION['basket'][] = ['id' => $product->id,'name' => $product->trackname,'format' => $product->format,'price' => $product->price];
        //add the latest product to the basket stored in the session
        //pass the basket to the basket template
        
        // var_dump($_SESSION);
        // die();

        // unset($_SESSION['basket']);
        
        if (isset($_SESSION['loggedin'])) {
            return $this->view->render($response, 'basket.html.twig', [
                'basket' => true]);
                } else {
                    // unset($_SESSION['basket']);
                    return $response->withRedirect('/login');
                }
        }
    }

// return $this->view->render($response, 'basket.html.twig', [
//     'basket' => true
// ]);
