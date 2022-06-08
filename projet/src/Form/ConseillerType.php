<?php

namespace App\Form;

use App\Entity\Conseillers;

use App\Entity\Langue;
use App\Entity\Specialite;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class ConseillerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',null, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Nom',
                    'value' => '',
                ]
            ])
            ->add('prenom',null, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Prénom',
                    'value' => '',
                ]
            ])
            ->add('date_de_naissance',BirthdayType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Date de naissance',
                    'value' => '',

                ]
            ])
            ->add('email',EmailType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => '@Mail',
                    'value' => '',
                ]
            ])
            ->add('tel',null, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Téléphone',
                    'value' => '',
                ]
            ])
            ->add('langues',null, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Langues',
                ]
            ])
            ->add('domaines',null, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Domaine',
                ]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Conseillers::class,
        ]);
    }
}
