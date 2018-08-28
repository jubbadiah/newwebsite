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
        //add the latest product to the basket stored in the session
        if($product){

        }

        //pass the basket to the basket template
        #
        $_SESSION['basket'][] = ['id' => $product->id,'name' => $product->name,'type' => $product->type,'price' => $product->price];

        return $this->view->render($response, 'basket.html.twig', [
            'basket' => true
        ]);
    }
}
