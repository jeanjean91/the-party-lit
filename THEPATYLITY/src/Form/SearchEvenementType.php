<?php

namespace App\Form;

use app\Entity\Evenement;
use App\Entity\EvenementSearch;
/*use Doctrine\DBAL\Types\TextType;*/
use phpDocumentor\Reflection\Types\Array_;
use phpDocumentor\Reflection\Types\String_;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\HttpFoundation\Request;

class SearchEvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('contry',CountryType::class, array(
                'preferred_choices' => array('FR'),
                'label' => false,
                'required'   => true,
                'choice_translation_locale' => null
            ))
            ->add('city' ,TextType::class,[
                'required'   => false,
                'label' => false,

                'attr'=> [

                    ' placeHolder' => 'enter a city'
                ]
            ])

            ->add('date',DateTimeType::class,[
                'required'   => false,
                'label' => false,

                'attr'=> [
                    'required' => false,
                    'label' => ''

                ]
            ] )

            ->add('type' ,ChoiceType::class, [
                'required'   => false,
                'label' => false,
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
                    'zouk' => 'zouk',
                ]
            ]);

         /* ->add('submit',SubmitType::class,[
               'label'=> 'search'
           ]);*/


    }




    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EvenementSearch::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }
    public function getBlockPrefix()
    {
        return '';
    }

}
