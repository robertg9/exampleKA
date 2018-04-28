<?php

namespace AppBundle\Form\Type;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * UserType constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     * @author Robert Glazer
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $translate = $this->container->get('translator');
        $builder
            ->add('firstname', TextType::class, [
                'required' => true,
                'attr' => [
                    'data-validation' => 'length custom',
                    'data-validation-length' => '3-20',
                    'data-validation-error-msg-length' => $translate->trans('firstname_range_error'),
                    'data-validation-regexp' => '^[a-zA-ZążźćńóęśłĄŻŹĆŃÓŚŁ]+$',
                    'data-validation-error-msg-custom' => $translate->trans('firstname_illegal_characters'),
                ],
            ])
            ->add('lastname', TextType::class, [
                'required' => true,
                'attr' => [
                    'data-validation' => 'length custom',
                    'data-validation-length' => '3-50',
                    'data-validation-error-msg-length' => $translate->trans('lastname_range_error'),
                    'data-validation-regexp' => '^[a-zA-ZążźćńóęśłĄŻŹĆŃÓŚŁ]+$',
                    'data-validation-error-msg-custom' => $translate->trans('lastname_illegal_characters'),
                ]
            ])
            ->add('experience', TextType::class, [
                'required' => true,
                'attr' => [
                    'data-validation' => 'length custom',
                    'data-validation-length' => '1-2',
                    'data-validation-regexp' => '^[0-9]+$',
                    'data-validation-error-msg' => $translate->trans('experience_not_number_or_to_high'),
                ]
            ])
            ->add('city', TextType::class, [
                'required' => true,
                'attr' => [
                    'data-validation' => 'length',
                    'data-validation-length' => '3-50',
                    'data-validation-error-msg' => $translate->trans('city_range_error'),
                ],
            ])
            ->add('availabilities', EntityType::class, [
                'class' => 'AppBundle\Entity\Availability',
                'multiple' => true,
                'expanded' => true,
                'choice_translation_domain' => true,
                'choice_attr' => function($val, $key, $index) {
                    return [
                        'data-validation' => 'checkbox_group',
                        'data-validation-qty' => 'min1',
                        'data-validation-error-msg' => $this->container->get('translator')->trans('availability_not_selected'),
                    ];
                },
            ])
            ->add('occupation', EntityType::class, [
                'class' => 'AppBundle\Entity\Occupation',
                'choice_translation_domain' => true,
            ])
            ->add('country', EntityType::class, [
                'class' => 'AppBundle\Entity\Country',
                'choice_translation_domain' => true,
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     * @author Robert Glazer
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\User',
        ]);
    }

}