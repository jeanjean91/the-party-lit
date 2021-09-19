<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user')
            ->add('email')

            ->add('civilite',ChoiceType::class, [

                'attr'=> [

                    ' placeHolder' => 'Civilite'
                ],
                'choices' => [
                    'Male' => 'Male',
                    'Femelle '=> 'Femelle',
                    'Autres' => 'Autres',

                ]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat Password']
            ]);
        

        /*->add('contry',CountryType::class, array(
            'preferred_choices' => array('FR'),
            'choice_translation_locale' => null
        ))
        ->add('city')
        ->add('image',FileType::class, array('data_class' => null,'required' => false))
        ->add('zipCiode')
        ->add('accompte')
        ->add('category');*/

        /* ->add('submit',SubmitType::class,[
               'label'=> 'search'
           ]);*/
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
