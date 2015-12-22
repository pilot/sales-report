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
        $regions = Sale::$regionDescr;
        sort($regions, SORT_STRING);
        $builder
            ->add('region', 'choice', array(
                'choices' => $regions,
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
                'label' => 'Дата завершения закупки',
                'required' => true,
                'constraints' => array(
                    new NotBlank([
                        'message' => "Укажите дату"
                    ]),
                ),
            ))
            ->add('link', 'text', array(
                'label' => 'Укажите ссылку на Вашу закупку или сайт (помните, что размещение закупок на закрытых форумах и сайтах ограничивает Ваши продажи)',
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
                'label' => 'Поставьте галочку, если Вы отправляете заказы в другие регионы.',
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
