<?php
namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;

class AuthenticationSuccessListener
{
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
    {
        $user = $event->getUser();
        $event->setData([
            'code' => $event->getResponse()->getStatusCode(),
            'username' => $user->getUserName(),
            'email' => $user->getEmail(),
            'payload' => $event->getData(),
        ]);
    }
}