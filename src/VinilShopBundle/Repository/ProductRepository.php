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
    public function articleMaxValue()
    {
        $em = $this->getEntityManager();
        $dql   = "SELECT MAX(p.article) val  FROM VinilShopBundle:Product p";
        $query = $em->createQuery($dql);
        $max_article = $query->getResult();

        return
            $max_article[0]['val'];

    }
}