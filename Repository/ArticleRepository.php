<?php

namespace Opifer\ManualBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * HelpRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArticleRepository extends EntityRepository
{
    /**
     * @param $slug
     *
     * @return \Doctrine\ORM\Query returns the result from the query.
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    function getSingleArticleBySlug($slug)
    {
        $qb = $this->createQueryBuilder('a')
            ->select('a, c')
            ->leftJoin('a.category', 'c')
            ->where('a.slug = :slug')
            ->setParameter('slug', $slug);

        return $qb->getQuery()->getSingleResult();
    }

    function getAllArticles()
    {
        $qb = $this->createQueryBuilder('a')
            ->select('a, c')
            ->leftJoin('a.category', 'c');

        return $qb->getQuery()->getResult();
    }

    function getArticlesForCategory($category_id)
    {
        $qb = $this->createQueryBuilder('a')
            ->select('a')
            ->where('a.category = :category_id')
            ->setParameter('category_id', $category_id);

        return $qb->getQuery()->getResult();
    }

}
