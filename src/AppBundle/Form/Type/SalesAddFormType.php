<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Sale;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Url;

class SalesAddFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('region', 'choice', array(
                'choices' => Sale::$regionDescr,
                'empty_value' => 'Выберите регион',
                'label' => 'Регион',
                'required' => false,
                'constraints' => array(
                    new NotBlank([
                        'message' => "Выберите регион"
                    ]),
                ),
            ))
            ->add('saleDate', 'text', array(
                'label' => 'Дата закупки',
                'required' => true,
                'constraints' => array(
                    new NotBlank([
                        'message' => "Укажите дату"
                    ]),
                ),
            ))
            ->add('link', 'text', array(
                'label' => 'Ссылка на форум/группу',
                'required' => true,
                'constraints' => array(
                    new NotBlank([
                        'message' => "Укажите ссылку"
                    ]),
                    new Url([
                        'message' => "Неверная ссылка"
                    ])
                ),
            ))
            ->add('hasTransportDelivery', 'checkbox', array(
                'label' => 'Отправление транспортной компанией розничным клиентам',
                'required' => false
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
        return 'altermoda_sales_add';
    }
} 
