<?php

namespace App\Core\Infrastructure\Security\ResetPassword;

use App\Core\Application\RetryPassword\UserExist\CheckUserExist\CreateResetTokenPasswordInterface;
use App\Core\Application\RetryPassword\UserExist\SendTokenPasswordDTO;
use App\Core\Domain\Model\Users\User;
use App\Core\Infrastructure\Security\ResetPassword\AntiBrutForceToken\AntiBrutForceTokenInterface;
use App\Core\Infrastructure\Security\ResetPassword\TimeToLiveToken\TimeToLiveTokenInterface;
use App\Core\Infrastructure\Security\ResetPassword\VerifyTokenPassword\VerifyTokenPasswordInterface;
use App\Shared\Domain\Exception\InvalidResetToken;

class ValidateTokenResetPassword implements ValidateTokenResetPasswordInterface
{
    private AntiBrutForceTokenInterface $antiBrutForceToken;

    private TimeToLiveTokenInterface $timeToLiveToken;

    private VerifyTokenPasswordInterface $verifyTokenPassword;

    private CreateResetTokenPasswordInterface $resetTokenPassword;

    public function __construct(
        AntiBrutForceTokenInterface $antiBrutForceToken,
        TimeToLiveTokenInterface $timeToLiveToken,
        VerifyTokenPasswordInterface $verifyTokenPassword,
        CreateResetTokenPasswordInterface $resetTokenPassword
    ) {
        $this->antiBrutForceToken = $antiBrutForceToken;
        $this->timeToLiveToken = $timeToLiveToken;
        $this->verifyTokenPassword = $verifyTokenPassword;
        $this->resetTokenPassword = $resetTokenPassword;
    }

    /**
     * @throws InvalidResetToken
     */
    final public function tokenIsValid(User $user, string $userToken): void
    {
        $sendTokenPassword = new SendTokenPasswordDTO($user->getEmail());

        if ($this->timeToLiveToken->isExpirationToken($user->getDateAuthAt())) {
            $this->resetTokenPassword->sendEmail($sendTokenPassword);
            throw new InvalidResetToken('Token expired');
        }

        if ($this->antiBrutForceToken->isToMoneyWrongToken($user->getId())) {
            $this->resetTokenPassword->sendEmail($sendTokenPassword);
            throw new InvalidResetToken('To many Incorrect tokens');
        }

        $this->verifyTokenPassword->isIncorrectToken($user, $userToken);
    }
}
