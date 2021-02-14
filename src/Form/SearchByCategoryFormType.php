<?php

namespace App\Form;

use App\Data\SearchData;
use App\Entity\Asset;
use App\Entity\Category;
use App\Repository\ApplicantRepository;
use App\Repository\CategoryRepository;
use App\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchByCategoryFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('category', EntityType::class, [
            'choice_label' => 'name',
            'required' => false,
            'class' => Category::class,
            'expanded' => false,
            'multiple' => false,
            'placeholder' => 'Tout voir',
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchData::class,
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
