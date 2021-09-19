<?php

namespace App\Form;

use App\Entity\Evenement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\Type;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use  Symfony\Component\Form\Extension\Core\Type\HiddenType;


class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('name')
            ->add('contry',CountryType::class, array(
                'preferred_choices' => array('FR'),
                'choice_translation_locale' => null
            ))
            ->add('region')
            ->add('city')
            ->add('address')
            ->add('date',DateType::class, array(
            'label' => false,
            'widget' => 'single_text',
            'attr' => ['class' => 'datepicker'],
            'required' => false
            )
        )
            ->add('image',FileType::class, array('data_class' => null,'required' => false))
            /*->add('imageFile',FileType::class,[
                'required'=> false
            ])*/
            ->add('type' ,ChoiceType::class, [
               
                'attr'=> [

                    ' placeHolder' => 'Type of event'
                ],
                'choices' => [
                    'hip hop' => 'hip hop',
                    'adult' => 'adult',
                    'adulte'   => 'adulte',
                    'RNB' => 'rnb',
                    'soul' => 'soul',
                    'ragga' => 'ragga',
                    'dancehall' => 'dancehall',
                    'etudiant' => 'etudiant',
                    /*  'hip hop' => 'hip hop',*/
                    'hiphop' => 'hiphop',
                    'all publique' => 'all public',
                    'electro' => 'electro',
                    'kizomba'   => 'kizomba',
                    'bluese' => 'bluese',
                    'bike life' => 'bike life',
                    'zouk' => 'zouk',
                ]
            ])
            ->add('active')
            ->add('public')
            ->add('capaciterMaxPersonne')
            ->add('lat',HiddenType::class)
            ->add('lng',HiddenType::class)
            ->add('free')
            ->add('typeDeSale')
           /* ->add('filename')*/


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
