<?php

namespace App\Tests\Core\Infrastructure\Form\RetryPassword;

use App\Core\Infrastructure\Form\RetryPassword\NewUserPasswordType;
use App\Tests\Core\Application\RetryPassword\NewPassword\DTO\NewUserPasswordDTOTest;
use Symfony\Component\Form\Test\TypeTestCase;


class NewUserPasswordTypeTest extends TypeTestCase
{

    public function testShouldReturnFormNewPassword()
    {
        $formData = NewUserPasswordDTOTest::createUserData();

        $view = $this->factory
            ->create(NewUserPasswordType::class, $formData)
            ->createView();

        $dataForm = $view->vars['value'];

        $this->assertArrayHasKey('tokenCsrf', $view);
        $this->assertArrayHasKey('userToken', $view);
        $this->assertArrayHasKey('user', $view);
        $this->assertArrayHasKey('newPassword', $view);
        $this->assertArrayHasKey('retryNewPassword', $view);
    }
}