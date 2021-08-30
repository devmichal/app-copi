<?php

namespace App\Core\Infrastructure\Security\AntiBrutForce;

use App\Core\Application\Command\User\BlockUserAccount\BlockUserCommand;
use App\Core\Infrastructure\RedisRepository\AntiBrutForce\BrutForceManagerCache;
use App\Shared\Domain\Exception\BrutForceLoginException;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationFailureEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Events;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


final class HandlerFailLoginUser implements EventSubscriberInterface
{
    public const MAX_INCORRECT_LOGIN = 2;
    public const ADD_INCORRECT_LOGIN = 1;

    private BrutForceManagerCache $brutForceManagerCache;

    private EventDispatcherInterface $eventDispatcher;


    public function __construct(
        BrutForceManagerCache $brutForceManagerCache,
        EventDispatcherInterface $eventDispatcher
    )
    {
        $this->brutForceManagerCache = $brutForceManagerCache;
        $this->eventDispatcher = $eventDispatcher;
    }

    public static function getSubscribedEvents(): array
    {
        return[
            Events::AUTHENTICATION_FAILURE => 'addIncorrectLogin'
        ];
    }

    /**
     * @param AuthenticationFailureEvent $forceLogin
     * @throws BrutForceLoginException
     */
    public function addIncorrectLogin(AuthenticationFailureEvent $forceLogin): void
    {
        $incorrectLogin = $forceLogin->getException()->getToken()->getUser();

        $this->brutForceManagerCache->addKey($incorrectLogin);
        $sumIncorrectLogin = $this->brutForceManagerCache->getStatusLogin();

        if ($sumIncorrectLogin > self::MAX_INCORRECT_LOGIN) {

            $this->eventDispatcher->dispatch(new BlockUserCommand($incorrectLogin), BlockUserCommand::NAME);
            $this->brutForceManagerCache->clear();
            throw new BrutForceLoginException('Too many incorrect logins. Your account is disabled.');
        }

        $sumIncorrectLogin += self::ADD_INCORRECT_LOGIN;
        $this->brutForceManagerCache->setWrongLogin($sumIncorrectLogin);
    }
}