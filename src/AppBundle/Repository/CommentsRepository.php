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

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Comments;

//crud system for posts
class CommentsRepository extends EntityRepository
{
    public function insertComment($post_id, $visitor_email, $content)
    {
        $comment = new Comments();
        $comment->setcPostId($post_id);
        $comment->setCVisitorEmail($visitor_email);
        $comment->setCContent($content);    
        $comment->setCDate(new \DateTime('now'));  

        $manager = $this->getEntityManager();
        $manager->persist($comment);
        $manager->flush();
    }

    public function getComments($post_id)
    {
        $manager = $this->getEntityManager();
        $manager = $this->getEntityManager();
        $query = $manager->createQuery(
            "SELECT c
            FROM AppBundle:Comments c
            WHERE c.cPostId = :id
            ORDER BY c.cId"
        )->setParameter('id', $post_id);
        
        return $query->getArrayResult();
    }
}
?>