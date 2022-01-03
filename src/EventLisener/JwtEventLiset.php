<?php
declare(strict_types=1);
namespace App\EventLisener;

use Doctrine\DBAL\Driver\Mysqli\Initializer\Secure;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\User\UserInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JwtEventLiset{
    /**
 * @var RequestStack
 */
private $requestStack;

/**
 * @param RequestStack $requestStack
 * @param Security $secrity
 */
public function __construct(RequestStack $requestStack,Security $secrity )
{
    $this->requestStack = $requestStack;
    $this->secrity = $secrity;

}
    
    public function onJWTCreated(JWTCreatedEvent $event)
    {
    
        $request = $this->requestStack->getCurrentRequest();

        $payload       = $event->getData();
        $payload['ip'] = $request->getClientIp();
        $payload['passw'] = $this->secrity->getUser()->getUserIdentifier();
        $payload['Localite'] = $this->secrity->getUser()->getVille();
        $payload['isvalide'] = $this->secrity->getUser()->isVerified();
        $event->setData($payload);
        
        $header        = $event->getHeader();
        $header['cty'] = 'JWT';
    
        $event->setHeader($header);
    }

}