<?php

namespace App\Controller\front;

use App\Entity\Brand;
use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Type;
use App\Service\LoadData;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class MainController extends AbstractController
{
    private $sort = ['rate', 'price', 'name'];
    /**
     * @Route("/", name="app_main")
     */
    public function index(): Response
    {


        return $this->render('front/main/index.html.twig', [

        ]);
    }

    /**
     * @Route("/catalogue/categorie/{id}", name="app_main_category")
     */
    public function category( Category $category, ProductRepository $productRepository, Request $request ): Response
    {


        if(!$request->query->get('tri') || !in_array($request->query->get('tri'), $this->sort))
        {
            $products = $productRepository->findByCategory($category);
        }

        else 
        {
            $tri = $request->query->get('tri');

            $products = $productRepository->findByCategorieSorted($tri, $category);
        }

        
        return $this->render('front/main/category.html.twig', [
            'category' => $category,
            'products' => $products,
        ]);
    }

    /**
     * @Route("/catalogue/marque/{id}", name="app_main_brand")
     */
    public function brand(  Brand $brand, ProductRepository $productRepository, Request $request ): Response
    {



        if(!$request->query->get('tri') || !in_array($request->query->get('tri'), $this->sort))
        {
            $products = $productRepository->findByBrand($brand);
        }

        else 
        {
            $tri = $request->query->get('tri');

            $products = $productRepository->findByBrandSorted($tri, $brand);
        }

        
        return $this->render('front/main/brand.html.twig', [

            'brand' => $brand,
            'products' => $products,
        ]);
    }

    /**
     * @Route("/catalogue/type/{id}", name="app_main_type")
     */
    public function type(  Type $type, ProductRepository $productRepository, Request $request  ): Response
    {


        if(!$request->query->get('tri') || !in_array($request->query->get('tri'), $this->sort))
        {
            $products = $productRepository->findByType($type);
        }

        else 
        {
            $tri = $request->query->get('tri');

            $products = $productRepository->findByTypeSorted($tri, $type);
        }

        
        return $this->render('front/main/type.html.twig', [

            'type' => $type,
            'products' => $products,
        ]);
    }

    /**
     * @Route("/catalogue/product/{slug}", name="app_main_product")
     */
    public function product(Product $product ): Response
    {
        return $this->render('front/main/product.html.twig', [

            'product' => $product,
        ]);
    }


}
