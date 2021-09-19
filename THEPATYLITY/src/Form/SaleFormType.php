<?php

namespace App\Form;

use App\Entity\SalleLOc;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SaleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type')
            ->add('description')
            ->add('adress')
            ->add('coutry',CountryType::class, array(
                'preferred_choices' => array('FR'),
                'choice_translation_locale' => null
            ))
            ->add('city')
            ->add('region')
            ->add('zipCode')
            ->add('lat',HiddenType::class)
            ->add('lng',HiddenType::class)
            ->add('disponible')
            ->add('capaciter')
            ->add('prix')
            ->add('user')
            ->add('imageSAl',ImageSalleType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SalleLOc::class,
        ]);
    }
}
