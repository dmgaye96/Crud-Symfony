<?php

namespace App\Form;

use App\Entity\Employe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('matricule')
            ->add('nomcomplet')
            ->add('datenaissance', DateType::class ,['widget' => 'single_text','format' =>'yyyy-MM-dd'])
            ->add('salaire')
            ->add('serices',EntityType::class,[
                'class' =>Serices::class,
                'choice_label' => 'libelle'
            ])
            /* ->add('save', SubmitType::class ,[
                'label' => 'Enregistrez'
            ]) */
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Employe::class,
        ]);
    }
}
