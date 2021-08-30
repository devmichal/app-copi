<?php


namespace App\Tests\Core\Infrastructure\Form\Client;


use App\Core\Infrastructure\Form\Client\ClientType;
use App\Tests\Core\Application\Command\Client\CreateClientDTOTest;
use Symfony\Component\Form\Test\TypeTestCase;

class ClientTypeTest extends TypeTestCase
{
    public function testShouldCreateClientForm()
    {
        $formData = CreateClientDTOTest::createClient();

        $view = $this->factory
                     ->create(ClientType::class, $formData)
                     ->createView();

        $dataForm = $view->vars['value'];

        $this->assertArrayHasKey('name', $view);
        $this->assertArrayHasKey('city', $view);
        $this->assertArrayHasKey('street', $view);
        $this->assertArrayHasKey('zipCode', $view);
        $this->assertArrayHasKey('taxNumber', $view);
        $this->assertArrayHasKey('salary', $view);

        $this->assertEquals($formData->getSalary(), $dataForm->getSalary());
        $this->assertEquals($formData->getName(), $dataForm->getName());
    }

}