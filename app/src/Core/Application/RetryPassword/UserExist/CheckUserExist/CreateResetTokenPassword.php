<?php

namespace App\Core\Application\RetryPassword\UserExist\CheckUserExist;


use App\Core\Application\Command\User\CreateResetTokenPassword\CreateResetTokenPasswordCommand;
use App\Core\Application\RetryPassword\UserExist\SendTokenPasswordDTO;
use App\Core\Infrastructure\Event\EventMessage\NewToken\NewTokenMessage;
use App\Core\Infrastructure\Repository\Users\MatchUser;
use App\Core\Infrastructure\Security\ResetPassword\CreateResetToken\CreateResetTokenInterface;
use App\Shared\Domain\Exception\InvalidUser;
use App\Shared\Infrastructure\Notification\FactoryEmil\FactoryEmail;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Messenger\MessageBusInterface;


final class CreateResetTokenPassword implements CreateResetTokenPasswordInterface
{
    private MatchUser $matchUser;

    private CreateResetTokenInterface $createResetToken;

    private MessageBusInterface $messageBus;

    private EventDispatcherInterface $eventDispatcher;


    public function __construct(
        MatchUser $matchUser,
        CreateResetTokenInterface $createResetToken,
        MessageBusInterface $messageBus,
        EventDispatcherInterface $eventDispatcher
    )
    {
        $this->matchUser = $matchUser;
        $this->createResetToken = $createResetToken;
        $this->messageBus = $messageBus;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param SendTokenPasswordDTO $DTO
     * @throws InvalidUser
     */
    public function sendEmail(SendTokenPasswordDTO $DTO): void
    {
        $user = $this->matchUser->getUser($DTO->getUser());

        if (!$user) {
            throw new InvalidUser('User not exist. Can`t send email token to reset password.');
        }

        $token = $this->createResetToken->createToken();

        $this->messageBus->dispatch(new NewTokenMessage(
            FactoryEmail::resetPassword($user->getEmail(), $token->getUserToken())
        ));

        $this->eventDispatcher->dispatch(new CreateResetTokenPasswordCommand(
           $user,
           $token->getHashToken()
        ), CreateResetTokenPasswordCommand::NAME);
    }
}