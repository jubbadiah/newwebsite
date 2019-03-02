<?php
namespace Jubby\Controller;

use Jubby\View\View;

class BuyController
{
    private $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function get($request, $response, $args)
    {
        $products = \Jubby\Model\Product::all();

        return $this->view->render($response, 'buy.html.twig', [
            'products' => $products
        ]);
    }
        
}
// below is the public function above in short done by elequent. 
// class Product {
//     public $tracname;
//     public $duration;
//     public $type;

//     public function __construct($trackname, $duration, $type)
//     {
//         $this->trackname = $trackname;
//         $this->duration = $duration;
//         $this->type = $type;
//     }
// }

// $products = [];

// foreach ($db as $row) {
//     $products[] = new Product($row['trackname'], $row['duration'], $row['type']);
// }

// $procuts = new product();
// $procuts->trackname;