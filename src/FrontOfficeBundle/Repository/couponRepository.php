<?php

namespace FrontOfficeBundle\Repository;

/**
 * couponRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class couponRepository extends \Doctrine\ORM\EntityRepository
{
    public function  findcouponbynum($id){
        $query=$this->getEntityManager()->createQuery("SELECT c FROM FrontOfficeBundle:coupon c where c.numero ='$id' ");
        return $query->getOneOrNullResult();
    }
}