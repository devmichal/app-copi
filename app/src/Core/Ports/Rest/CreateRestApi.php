<?php


namespace App\Core\Ports\Rest;


use App\Shared\Domain\Exception\InvalidValidationForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;


abstract class CreateRestApi extends AbstractController
{

    private ValidatorInterface $validator;


    public function __construct(
        ValidatorInterface $validator
    )
    {
        $this->validator = $validator;
    }

    /**
     * @param Request $request
     * @param $nameClassType
     * @return mixed
     * @throws InvalidValidationForm
     */
    protected function buildObject(Request $request, $nameClassType)
    {
        $contentResponse = json_decode($request->getContent(), true);

        $buildForm = $this->createForm($nameClassType);
        $buildForm->submit($contentResponse);

        if (count($this->validator->validate($buildForm)) !== 0) {

            throw new InvalidValidationForm('Form data is invalid', 400);
        }

        return $buildForm->getData();
    }
}