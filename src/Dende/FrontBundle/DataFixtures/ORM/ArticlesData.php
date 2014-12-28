<?php

namespace Dende\FrontBundle\DataFixtures\ORM;

use Dende\FrontBundle\DataFixtures\BaseFixture;
use Dende\FrontBundle\Entity\Article;

class ArticlesData extends BaseFixture
{
    public function getOrder()
    {
        return 1;
    }

    /**
     * @param $params
     * @return Article
     */
    public function insert($params)
    {
        extract($params);

        $article = new Article();
        $article->setTitleEn($title_en);
        $article->setTitlePl($title_pl);
        $article->setTemplateEn($template_en);
        $article->setTemplatePl($template_pl);

        return $article;
    }
}
