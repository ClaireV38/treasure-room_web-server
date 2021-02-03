<?php

namespace App\Form;

use App\Entity\Asset;
use App\Entity\Category;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
            ->add('owner', EntityType::class,[
                'class' => User::class,
                'choice_label' => 'name',
            ])
            ->add('category', EntityType::class,[
                'class' => Category::class,
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Asset::class,
        ]);
    }
}
