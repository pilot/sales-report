<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Sale;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class SalesRequestFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $regions = Sale::$regionDescr;
        sort($regions, SORT_STRING);
        $builder
            ->add('region', 'choice', array(
                'choices' => $regions,
                'empty_value' => 'Выберите регион',
                'label' => 'Регион',
                'required' => false,
            ))
            ->add('email', 'text', array(
                'label' => 'Ваш e-mail',
                'required' => true,
                'constraints' => array(
                    new Email([
                        'message' => "Пожалуйста, укажите корректный e-mail"
                    ]),
                    new NotBlank([
                        'message' => "Укажите e-mail"
                    ]),
                ),
            ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'csrf_protection' => false,
        ]);
    }

    public function getName()
    {
        return 'altermoda_sales_request';
    }
} 
