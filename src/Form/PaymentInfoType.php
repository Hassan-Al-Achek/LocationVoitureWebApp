<?php

namespace App\Form;

use App\Entity\PaymentInfo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaymentInfoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('licensePlate')
            ->add('model')
            ->add('KM')
            ->add('amountPerHour')
            ->add('reduction')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PaymentInfo::class,
        ]);
    }
}
