<?php

namespace App\Controller\Product;

use App\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ProductController extends AbstractController
{
    public function index(): Response
    {
        $entityManager = ($this->emService)->initEntityManager();
        if ($this->request->getMethod() === 'POST' && $this->request->request->get('_method') === 'PATCH') {

            $arrayOfId = $this->request->request->get('itemToDel');
            foreach ($arrayOfId as &$id) {
                $id = intval($id);
            }

            try {
                $query = $entityManager->createQuery('DELETE App\Entity\Product\AbstractProduct p WHERE p.id IN (:arrayOfId)')
                    ->setParameter('arrayOfId', $arrayOfId);
                $query->execute();
                $entityManager->flush();
            } catch (\Exception $e) {
                // logging errors to implement
                $errorToLog = $e->getMessage();
            }

            return new RedirectResponse($this->request->headers->get('referer'));
        } elseif ($this->request->getMethod() === 'GET') {

            try {
                $query = $entityManager->createQuery('SELECT p FROM App\Entity\Product\AbstractProduct p');
                $products = $query->getResult();
                $response = new Response($this->twig->render('base.html.twig', ['products' => $products]));
            } catch (\Exception $e) {
                $errorToLog = $e->getMessage();
                $response = new Response('<html>
                <body><h1>404</h1>
                </div>
                <h2>Page not found</h2>
                <p>The page you are looking for is temporarily unavailable.</p>
                </div>
                </div></body></html>', 404);
            }

            return $response;
        }
    }

    public function addProduct()
    {
        $entityManager = ($this->emService)->initEntityManager();

        if ($this->request->getMethod() === 'GET') {

            return new Response($this->twig->render('add_product.html.twig'));
        } elseif ($this->request->getMethod() === 'POST') {
            $product = null;
            $productType = ucfirst($this->request->request->get('product_type'));

            try {
                $class =  '\App\Entity\Product\\' . $productType;
                $product = (new $class);
            } catch (\Throwable $ex) {
                $errorToLog = $ex->getMessage();
                $allert = 'Something went wrong';
                $response = new Response($this->twig->render('add_product.html.twig', ['allert' => $allert]));
            }

            if ($product) {

                $sku = $this->request->request->get('sku') ?? null;
                $name = $this->request->request->get('name') ?? null;
                $price = $this->request->request->get('price') ?? null;
                if ($sku && $name && $price) {
                    $product->setSku($sku);
                    $product->setName($name);
                    $product->setPrice($price);
                } else {
                    return new RedirectResponse($this->request->headers->get('referer'));
                }

                $requestData = $this->request->request->all();
                $product->setData($requestData);

                try {
                    $entityManager->persist($product);
                    $entityManager->flush();
                    $response = new RedirectResponse('/');
                } catch (\Exception $e) {
                    $allert = 'The "' . $sku . '" is already used.';
                    $response = new Response($this->twig->render('add_product.html.twig', ['allert' => $allert]));
                }
            } else {
                return new RedirectResponse($this->request->headers->get('referer'));
            }

            return $response;
        }
    }
}
