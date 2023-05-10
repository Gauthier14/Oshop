<?php 
namespace App\Repository;

use App\Entity\Brand;
use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Type;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function findByCategorieSorted(?string $tri, Category $category)
    {
        // on crée un QueryBuilder
        $qb = $this->createQueryBuilder('p')
            ->where('p.category = :category')
            ->setParameter('category', $category)
                ->orderBy('p.'.$tri, 'ASC');
            

        // on retourne l'exécution de la requête
        return $qb->getQuery()->getResult();
    }

    public function findBybrandSorted(?string $tri, Brand $brand)
    {
        // on crée un QueryBuilder
        $qb = $this->createQueryBuilder('p')
            ->where('p.brand = :brand')
            ->setParameter('brand', $brand)
            ->orderBy('p.'.$tri, 'ASC');
        

        // on retourne l'exécution de la requête
        return $qb->getQuery()->getResult();
    }

    public function findByTypeSorted(?string $tri, Type $type)
    {
        // on crée un QueryBuilder
        $qb = $this->createQueryBuilder('p')
            ->where('p.type = :type')
            ->setParameter('type', $type)
            ->orderBy('p.'.$tri, 'ASC');
        

        // on retourne l'exécution de la requête
        return $qb->getQuery()->getResult();
    }


}