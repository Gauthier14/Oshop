<?php

namespace App\Controller;

use App\Entity\Product;
use App\Service\LoadData;
use App\Service\PanierManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class PanierController extends AbstractController
{

    /**
     * @Route("/panier", name="app_panier_list")
     */
    public function list(): Response
    {


        return $this->render('front/main/panier/list.html.twig', [

        ]);
    }

        /**
     * Ajout d'un favori
     * 
     * id<\d+> équivaut à requirements={"id"="\d+"}
     * 
     * @Route("/panier/add/{id<\d+>}", name="app_panier_add", methods={"POST"})
     */
    public function add(Product $product = null, Paniermanager $paniermanager, Request $request)
    {
        // si $product est null, on renvoie une 404
        if ($product === null) {
            throw $this->createNotFoundException('Produit non trouvé.');
        }

        // ajout au panier
        $paniermanager->add($product);


        // message "flash" stocké en session, à afficher sur la page de redirection
        // @see https://symfony.com/doc/5.4/session.html#flash-messages
        // attention le addFlash renvoi un tableau de message (ici ya qu'un message) qui nous oblige à boucler dessus dans le template
            $this->addFlash(
                'success',
                "<b>{$product->getName()}</b> a été ajouté à votre pannier."
            );

        // on redirige vers la list
        
        return $this->redirect($request->server->get('HTTP_REFERER'));
    }

    /**
     * suppression favoris
     * 
     * id<\d+> équivaut à requirements={"id"="\d+"}
     * 
     * @Route("/panier/remove/{id<\d+>}", name="app_panier_remove", methods={"POST"})
     */
    public function remove(Product $product, Paniermanager $paniermanager) 
    {
        // si $product est null, on renvoie une 404

        if ($product === null) {
            throw $this->createNotFoundException('Produit non trouvé');
        }
        // si le favorite manager renvoie false alors il a pas trouvé le favoris : 
        if (!$paniermanager->remove($product)) {
            throw $this->createNotFoundException('Produit non trouvé');
        }
        $paniermanager->remove($product);
        
        // on redirige vers la liste
        return $this->redirectToRoute('app_panier_list');   
    }

    /**
     * suppression de tous les favoris
     * 
     * 
     * @Route("/panier/empty", name="app_panier_empty")
     */
    public function empty(Paniermanager $paniermanager)
    {
        $paniermanager->empty();
        return $this->redirectToRoute('app_panier_list');
    }
}
