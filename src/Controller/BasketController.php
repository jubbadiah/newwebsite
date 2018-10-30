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
        //add the latest product to the basket stored in the session
        //pass the basket to the basket template

        var_dump($_SESSION);
        die();

        // unset($_SESSION['basket']);
        
        if (isset($_SESSION['loggedin'])) {
            return $response->withRedirect('/basket');
        } else {
            return $response->withRedirect('/login');
        }
    }

    public function remove($request, $response, $args) {
        $product = \Jubby\Model\Product::find($args['id']);


            if (isset($_SESSION)) {
                unset($_SESSION['basket'][1]);
                return $response->withRedirect('/basket');

                var_dump($_SESSION);
                die();
            }
            
    }
}

// first item array(1) { ["basket"]=> array(1) { [1]=> array(3) { ["name"]=> string(12) "We run tings" ["format"]=> string(3) "MP3" ["price"]=> string(1) "2" } } } 

// removed 3rd item array(3) { ["basket"]=> array(4) { [2]=> array(3) { ["name"]=> string(6) "Danger" ["format"]=> string(3) "MP3" ["price"]=> string(1) "2" } [3]=> array(3) { ["name"]=> string(16) "Human no machine" ["format"]=> string(3) "MP3" ["price"]=> string(1) "2" } [4]=> array(3) { ["name"]=> string(12) "We run tings" ["format"]=> string(3) "WAV" ["price"]=> string(1) "2" } [5]=> array(3) { ["name"]=> string(6) "Danger" ["format"]=> string(3) "WAV" ["price"]=> string(1) "2" } } ["loggedin"]=> bool(true) ["username"]=> string(4) "test" } 

// 5 items array(1) { ["basket"]=> array(5) { [1]=> array(3) { ["name"]=> string(12) "We run tings" ["format"]=> string(3) "MP3" ["price"]=> string(1) "2" } [2]=> array(3) { ["name"]=> string(6) "Danger" ["format"]=> string(3) "MP3" ["price"]=> string(1) "2" } [3]=> array(3) { ["name"]=> string(16) "Human no machine" ["format"]=> string(3) "MP3" ["price"]=> string(1) "2" } [4]=> array(3) { ["name"]=> string(12) "We run tings" ["format"]=> string(3) "WAV" ["price"]=> string(1) "2" } [5]=> array(3) { ["name"]=> string(6) "Danger" ["format"]=> string(3) "WAV" ["price"]=> string(1) "2" } } } 