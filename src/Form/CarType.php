<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Client;
use App\Entity\Parking;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('licensePlate')
            ->add('mark')
            ->add('model')
            ->add('numberOfSeats')
            ->add('fuel')
            ->add('imagePath')
            ->add('clientNumber')
            ->add('parkingNumber');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
