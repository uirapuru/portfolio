<?php

namespace Dende\FrontBundle\DataFixtures\ORM;

use Dende\FrontBundle\DataFixtures\BaseFixture;
use Dende\FrontBundle\Entity\Job;

class JobsData extends BaseFixture
{
    public function getOrder()
    {
        return 1;
    }

    public function insert($params)
    {
        extract($params);

        $job = new Job();
        $job->setName($name);
        $job->setAddress($address);
        $job->setCity($city);
        $job->setCountry($country);
        $job->setLink($link);
        $job->setFrom(new \DateTime($from));
        $job->setTo(new \DateTime($to));
        $job->setPosition($position);
        $job->setDescriptionEn($description_en);
        $job->setDescriptionPl($description_pl);

        return $job;
    }
}
