<?php

namespace App\Core\Ports\Rest\Password;

use App\Core\Application\RetryPassword\ConfirmToken\ConfirmCorrectResetTokenPasswordInterface;
use App\Core\Application\RetryPassword\NewPassword\AddNewUserPasswordInterface;
use App\Core\Application\RetryPassword\UserExist\CheckUserExist\CreateResetTokenPasswordInterface;
use App\Core\Infrastructure\Form\RetryPassword\ConfirmTokenPasswordType;
use App\Core\Infrastructure\Form\RetryPassword\NewUserPasswordType;
use App\Core\Infrastructure\Form\RetryPassword\SendTokenPasswordType;
use App\Core\Ports\Rest\CreateRestApi;
use App\Shared\Infrastructure\Http\HttpCode;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ChangePassword extends CreateRestApi
{
    /**
     * @Route("/retry/password/email", methods={"POST"})
     */
    final public function indexAction(
        Request $request,
        CreateResetTokenPasswordInterface $checkUserExist
    ): JsonResponse {
        $userExistForm = $this->buildObject($request, SendTokenPasswordType::class);

        $checkUserExist->sendEmail($userExistForm);

        return $this->json(null, HttpCode::NO_CONTENT);
    }

    /**
     * @Route("/retry/password/token", methods={"POST"})
     */
    final public function checkAction(
        Request $request,
        ConfirmCorrectResetTokenPasswordInterface $resetTokenPassword
    ): JsonResponse {
        $userExistForm = $this->buildObject($request, ConfirmTokenPasswordType::class);

        $tokenCsrf = $resetTokenPassword->checkToken($userExistForm);

        return $this->json($tokenCsrf, HttpCode::OK);
    }

    /**
     * @Route("/retry/password", methods={"POST"})
     */
    final public function changeAction(
        Request $request,
        AddNewUserPasswordInterface $addNewUserPassword
    ): JsonResponse {
        $userPassword = $this->buildObject($request, NewUserPasswordType::class);

        $addNewUserPassword->addNewPassword($userPassword);

        return $this->json(null, HttpCode::NO_CONTENT);
    }
}
