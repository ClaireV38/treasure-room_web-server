<?php

namespace App\Form;

use App\Entity\Asset;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AssetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('placeOfDiscovery')
            ->add('depositDate')
            ->add('value')
            ->add('photo')
            ->add('updatedAt')
            ->add('owner')
            ->add('category')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Asset::class,
        ]);
    }
}
