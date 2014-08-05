<?php 

namespace Dende\FrontBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;

class MenuBuilder extends ContainerAware
{
    private $factory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }
    
    public function createSocialMenu()
    {
        $menu = $this->factory->createItem('root');
        
        $menu->setChildrenAttributes(array(
            'class' => 'nav nav-pills pull-right',
            'id' => 'socialMenu'
        ));
        
        $menu->addChild('mail', array('uri' => 'mailto:uirapuru@tlen.pl'))
            ->setLinkAttribute("class", "fa fa-envelope")
            ->setLabel('');
        $menu->addChild('fb', array('uri' => 'https://www.facebook.com/grzegorz.kaszuba'))
            ->setLinkAttribute("class", "fa fa-facebook")
            ->setLabel('');
        $menu->addChild('li', array('uri' => 'http://pl.linkedin.com/in/grzegorzkaszuba'))
            ->setLinkAttribute("class", "fa fa-linkedin")
            ->setLabel('');
        $menu->addChild('gl', array('uri' => 'http://goldenline.pl'))
            ->setLinkAttribute("class", "fa fa-compress")
            ->setLabel('');
        $menu->addChild('github', array('uri' => 'http://github.com/uirapuru'))
            ->setLinkAttribute("class", "fa fa-github")
            ->setLabel('');
        $menu->addChild('yt', array('uri' => 'http://youtube.com/uirapuruadg'))
            ->setLinkAttribute("class", "fa fa-youtube")
            ->setLabel('');

        return $menu;
    }
    
    public function createLangMenu(Request $request)
    {
        $menu = $this->factory->createItem('root');
        
        $menu->setChildrenAttributes(array(
            'class' => 'nav nav-pills pull-right',
            'id' => 'langMenu'
        ));
        
        $menu->addChild('pl', array('route' => 'switch_language', 'routeParameters' => array('locale' => 'pl')))
            ->setLinkAttribute("class", "flag-icon flag-icon-pl")
            ->setLabel('');
        
        $menu->addChild('en', array('route' => 'switch_language', 'routeParameters' => array('locale' => 'en')))
            ->setLinkAttribute("class", "flag-icon flag-icon-gb")
            ->setLabel('');
        
        $locale = $request->getLocale();

        if(in_array($locale, array("pl","en"))) {
            $menu->getChild($locale)->setCurrent(true);
        }

        return $menu;
    }
    
    public function createMainMenu()
    {
        $menu = $this->factory->createItem('root');
        
        $menu->setChildrenAttributes(array(
            'class' => 'nav nav-pills pull-left',
            'id' => 'mainMenu'
        ));

        $menu->addChild('menu.main.cv', array('route' => 'cv'));
        $menu->addChild('menu.main.projects', array('route' => 'projects'));
        $menu->addChild('menu.main.contact', array('route' => 'contact'));

        return $menu;
    }
}
