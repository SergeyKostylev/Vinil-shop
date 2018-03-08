<?php

namespace VinilShopBundle\Repository;




/**
 * ProductRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProductRepository extends \Doctrine\ORM\EntityRepository
{

    public function productOfManufacturer($id)
    {

        return $this
            ->createQueryBuilder('prod')
            ->where('prod.manufacturer = :manufacturer')
            ->setParameter('manufacturer', $id)
            ->getQuery()
            ->getResult();

    }

    public function productRandLimin($limit = 9)
    {

        return $this
            ->createQueryBuilder('prod')
            ->addSelect('RAND() as HIDDEN rand')
            ->orderBy('rand')
            ->andWhere('prod.isActive = true')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();

    }

    public function findByCategory($id)
    {
        $last_category = $this
            ->createQueryBuilder('prod')
            ->join('prod.category', 'cat')
            ->select('cat.lastCategory')
            ->where('cat.id = :id')
            ->setParameter('id',$id)
            ->getQuery()
            ->getResult();

        if($last_category){
            $products = $this
                ->createQueryBuilder('prod')
                ->join('prod.category', 'cat')
                ->where('cat.id = :id')
                ->setParameter('id' , $id)
                ->getQuery()
                ->getResult();
        }else{
            $products = $this
                ->createQueryBuilder('prod')
                ->join('prod.category', 'cat')
                ->where('cat.parent = :id')
                ->setParameter('id' , $id)
                ->getQuery()
                ->getResult();
        }
        return $products;
    }

}
