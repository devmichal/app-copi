<?php

namespace App\Core\Application\RetryPassword\ConfirmToken;


use App\Core\Application\RetryPassword\ConfirmToken\DTO\ConfirmTokenPasswordDTO;
use App\Core\Infrastructure\Repository\Users\MatchUser;
use App\Core\Infrastructure\Security\ResetPassword\CreateCsrfToken\CreateCsrfTokenInterface;
use App\Core\Infrastructure\Security\ResetPassword\ValidateTokenResetPasswordInterface;
use App\Shared\Domain\Exception\InvalidUser;


final class ConfirmCorrectResetCorrectResetTokenPasswordPassword implements ConfirmCorrectResetTokenPasswordInterface
{
    private ValidateTokenResetPasswordInterface $validateTokenResetPassword;

    private MatchUser $matchUser;

    private CreateCsrfTokenInterface $createCsrfToken;


    public function __construct(
        ValidateTokenResetPasswordInterface $validateTokenResetPassword,
        MatchUser $matchUser,
        CreateCsrfTokenInterface $createCsrfToken
    )
    {
        $this->validateTokenResetPassword = $validateTokenResetPassword;
        $this->matchUser = $matchUser;
        $this->createCsrfToken = $createCsrfToken;
    }

    /**
     * @param ConfirmTokenPasswordDTO $confirmTokenPasswordDTO
     * @return string
     * @throws InvalidUser
     */
    public function checkToken(ConfirmTokenPasswordDTO $confirmTokenPasswordDTO): string
    {
        $users = $this->matchUser->getUser($confirmTokenPasswordDTO->getUser());

        if (!$users) {
            throw new InvalidUser('User not exist. Can`t send email token to reset password.');
        }

        $this->validateTokenResetPassword->tokenIsValid($users, $confirmTokenPasswordDTO->getUserToken());

        return $this->createCsrfToken->createCsrfToken($users->getId());
    }
}