<?php
declare(strict_types=1);
namespace App\Controller;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class DefaultController{
    /**
     * @Route("/")
     */
    public function __invoke(FormFactoryInterface $formFactory, ValidatorInterface $validator)
    {
        $data = new MyForm();

        $form = $formFactory->create(MyFormType::class, $data);
        $violations = $validator->validate($form);
        return new Response($violations->get(0));
    }
}

class MyForm {
    public $firstName = '';
}

class MyFormType  extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstName', TextType::class, ['constraints'=> [new NotBlank(), new NotNull()], 'error_bubbling'=>true]);
    }
}