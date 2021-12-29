<?php
namespace App\EVENT;


use App\Entity\Artical;
use PhpParser\Builder\Method;

use Doctrine\DBAL\Schema\View;
use Psr\Link\EvolvableLinkInterface;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use ApiPlatform\Core\EventListener\EventPriorities;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use function Symfony\Component\DependencyInjection\Loader\Configurator\ref;

class CurrentUserForArticleSubscribers implements EventSubscriberInterface{
   private Security $security;
    public function __construct(Security $security)
    {
        $this->security=$security;
        
    }
    public static function getSubscribedEvents()
     {
         return[BeforeEntityPersistedEvent::class=>['CurrentUserForArticle']];
     }
public function CurrentUserForArticle(BeforeEntityPersistedEvent $event){
    
    $article=$event->getEntityInstance();
    // $methods=$event->getRequest()->getMethod();
    if($article instanceof Artical){
        $article->setAuthor($this->security->getUser());

    }
}
 }