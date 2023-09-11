<?php

namespace App\Form;

use App\Entity\ExperienciLaboral;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExperienciLaboralType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombreempresa')
            ->add('puesto')
            ->add('descripcion')
            ->add('fechainicio')
            ->add('fechafin')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ExperienciLaboral::class,
        ]);
    }
}
