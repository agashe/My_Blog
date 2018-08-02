<?php
/**
 *PHP version 5.6
 *
 *My_Blog v1.00
 *
 *@author Mohamed Yousef <engineer.mohamed.yossef@gmail.com>
 *@copyright (C) My_Blog 2018
 */

namespace AppBundle\Repository;

use AppBundle\Entity\Posts;
use Doctrine\ORM\EntityRepository;

class PostsRepository extends EntityRepository
{
    public function insertPost($title, $content, $category)
    {
        $post = new Posts();
        $post->setPTitle($title);
        $post->setPContent($content);    
        $post->setPCat($category); 
        $post->setPDate(new \DateTime('now'));

        $manager = $this->getEntityManager();
        $manager->persist($post);
        $manager->flush();
    }

    public function getPostbById($id)
    {
        $manager = $this->getEntityManager();
        $post = $manager->getRepository("AppBundle:Posts")->find($id);
 
        $result["p_title"] = $post->getPTitle();
        $result["p_content"] = $post->getPContent();
        $result["p_cat"] = $post->getPCat();
        $result["p_date"] = $post->getPDate();

        return $result;
    }

    public function getPostsbByCat($cat_name)
    {
        $manager = $this->getEntityManager();
        $query = $manager->createQuery(
            "SELECT p
             FROM AppBundle:Posts p
             WHERE p.pCat = :cat_name
             ORDER BY p.pId DESC"
         )->setParameter('cat_name', $cat_name);
        
        return $query->getArrayResult();
    }

    public function getPosts()
    {
        $manager = $this->getEntityManager();
        $query = $manager->createQuery(
            "SELECT p
             FROM AppBundle:Posts p
             ORDER BY p.pId DESC"
        );
        
        return $query->getArrayResult();
    }
}
?>