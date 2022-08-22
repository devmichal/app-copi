<?php

namespace App\Tests\Core\Infrastructure\Form\TypeText;

use App\Core\Application\Command\TypeText\CreateTypeTextDTO;
use App\Core\Infrastructure\Form\TypeText\TypeTextType;
use Symfony\Component\Form\Test\TypeTestCase;

class TypeTextTypeTest extends TypeTestCase
{
    public const destination = 'some variable';

    public function testShouldCreateTypeTextType()
    {
        $formData = new CreateTypeTextDTO();
        $formData->setDestination(self::destination);

        $view = $this->factory
                     ->create(TypeTextType::class, $formData)
                     ->createView();

        $dataForm = $view->vars['value'];

        $this->assertArrayHasKey('destination', $view);
        $this->assertEquals(self::destination, $dataForm->getDestination());
    }
}
