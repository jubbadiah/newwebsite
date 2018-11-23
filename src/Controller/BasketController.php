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

        $_SESSION['basket'][$product->id] = ['name' => $product->trackname,'format' => $product->format,'price' => $product->price];

        $this->updateBasketTotal();

        //add the latest product to the basket stored in the session
        if (isset($_SESSION['loggedin'])) {
            return $response->withRedirect('/basket');
        } else {
            return $response->withRedirect('/login');
        }
    }

    public function remove($request, $response, $args) {

            if (isset($_SESSION)) {
                unset($_SESSION['basket'][$args['id']]);
                $this->updateBasketTotal();
                return $response->withRedirect('/basket');
            }
    }

    private function updateBasketTotal()
    {
        $total = 0;

        foreach ($_SESSION['basket'] as $item) {
            $total += $item['price'];
        }

        $_SESSION['basketTotal'] = $total;
    }
}
        // var_dump($_SESSION);
        // die();