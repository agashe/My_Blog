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
use AppBundle\Entity\Categories;

class CategoriesRepository extends EntityRepository
{
    public function insertCategory($category_name)
    {
        $category = new Categories();
        $category->setCatName($category_name);   

        $manager = $this->getEntityManager();
        $manager->persist($category);
        $manager->flush();
    }

    public function getCategories()
    {
        $manager = $this->getEntityManager();
        $manager = $this->getEntityManager();
        $query = $manager->createQuery(
            "SELECT cat
             FROM AppBundle:Categories cat
             ORDER BY cat.catId"
        );
        
        return $query->getArrayResult();
    }
}
?>