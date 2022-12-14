<?php

namespace App\Config;

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class Routes
{
    public function exposerRoutes(): RouteCollection
    {
        $routes = new RouteCollection();

        $routes->add('homepage', new Route('/', [
            'controller' => 'ProductController', 'method' => 'index'
        ], [], [], null, [], ['GET', 'POST']));
        $routes->add('addProduct', new Route('/add-product', [
            'controller' => 'ProductController', 'method' => 'addProduct'
        ], [], [], null, [], ['GET', 'POST']));

        return $routes;
    }
}
