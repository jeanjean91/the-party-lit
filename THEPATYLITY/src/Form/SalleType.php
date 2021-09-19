<?php

namespace App\Form;

use App\Entity\SalleLOc;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use  Symfony\Component\Form\Extension\Core\Type\HiddenType;
class SalleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type')
            ->add('SalleName')
            ->add('description')
            ->add('adress')
            ->add('imageFile', FileType::class,
                array('data_class' => null,'required' => false))

            ->add('images', FileType::class, [
                'label' => false,
                'multiple' => true,
                'mapped' => false,
                'required' => false
            ])
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


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SalleLOc::class,
        ]);
    }
}
