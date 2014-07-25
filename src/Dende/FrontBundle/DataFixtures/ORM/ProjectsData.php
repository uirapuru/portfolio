<?php

namespace Dende\FrontBundle\DataFixtures\ORM;

use Dende\FrontBundle\DataFixtures\BaseFixture;
use Dende\FrontBundle\Entity\Project;

class ProjectsData extends BaseFixture
{
    public function getOrder()
    {
        return 1;
    }

    public function insert($params)
    {
        $project = new Project();
                
        $project->setName($params["name"]);
        $project->setFeatures($params["features"]);
        $project->setTags($params["tags"]);
        $project->setPictures($params["pictures"]);
        $project->setCompany($params["company"]);
        $project->setDescription($params["description"]);
        
        $this->manager->persist($project);
        $this->manager->flush();

        return $project;
    }
}
