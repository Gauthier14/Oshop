<?php 

namespace App\Service;

use App\Entity\Product;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Gestion du panier
 */
class PanierManager {

    // @see https://symfony.com/doc/current/session.html
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }



    /**
     * add panier
     * @param Product $product 
     */
    public function add (Product $product) {
        // on récupère la session qui se trouve dans la requête
        $session = $this->requestStack->getSession() ;


        // on récupère les panier déjà présents,
        // ou un tableau vide si aucun panier présents
        $panier = $session->get('panier', []);

        // on y ajoute (on push à la fin du tableau) l'id du produit à mettre en panier
        $panier[$product->getId()] = $product;

        // on écrase les panier en session par cette nouvelle liste de panier
        $session->set('panier', $panier); // $_SESSION['panier'] = $panier;
    }

    /**
     * suppression
     * @param Product $product
     */
    public function remove(Product $product)
    {
        $session = $this->requestStack->getSession();

        $panier = $session->get('panier', []);

        // si le produit est non trouvé, on renvoie une 404
        if (!array_key_exists($product->getId(), $panier)) {
                return false;
            }

        // on supprime l'élément à la clé du tableau
        // @see https://www.php.net/manual/fr/function.unset.php
        unset($panier[$product->getId()]);

        // on écrase les panier en session par cette nouvelle liste de panier
        $session->set('panier', $panier); // $_SESSION['panier'] = $panier;

        return true;
    }

    /**
     * vide les panier
     */ 
    public function empty()
    {
        $session = $this->requestStack->getSession() ;
        $session->clear();
    }

    /**
     * Liste des panier
     */
    public function list () {
        // rien a écrire car géré dans la vue
    }


}