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
use App\Entity\Produits;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

use function Symfony\Component\DependencyInjection\Loader\Configurator\ref;

class ProduitsSubsec implements EventSubscriberInterface{
   private Security $security;
    public function __construct(Security $security)
    {
        $this->security=$security;
        
    }
    public static function getSubscribedEvents()
     {
         return[ KernelEvents::VIEW => ["CurrentUserPublisher", EventPriorities::PRE_VALIDATE]];
     }
public function CurrentUserPublisher(ViewEvent $event){
    
    $article=$event->getControllerResult();
    $methods=$event->getRequest()->getMethod();
    // $token = $this->tokenStorage->getToken();
    // $user = $token->getUser();
    if($article instanceof Produits && HttpFoundationRequest::METHOD_POST===$methods){
        $article->setPublisher($this->security->getUser());

    }
}
 }