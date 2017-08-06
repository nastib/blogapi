<?php

namespace AppBundle\Repository;

class ArticleRepository extends AbstractRepository
{
    public function search($term, $order = 'ASC', $limit = 20, $offset = 0)
    {

        $qb = $this
            ->createQueryBuilder( 'a' )
            ->orderBy( 'a.id', $order )
            ->setMaxResults( $limit )
            ->setFirstResult( $offset )
        ;
        if ($term) {
            $qb
                ->where('a.title LIKE ?1')
                ->setParameter( 1, '%'.$term.'%' )
            ;
        }
        
        return  $this->paginate($qb, $limit, $offset); 
    }
    
    
    public function myFind($limit = 5, $offset=0)
    {
       $qb = $this
            ->createQueryBuilder( 'a' )
            ->orderBy( 'a.id', 'ASC' )
            ->setMaxResults( $limit )
            ->setFirstResult( $offset )
        ;
        return  $qb->getQuery()->getResult(); 
    }

}