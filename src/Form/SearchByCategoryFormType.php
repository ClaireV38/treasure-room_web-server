<?php

namespace App\Form;

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
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository, UserRepository $userRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $categories = $this->categoryRepository->findAll();
            $builder
            ->add('category', ChoiceType::class, [
                'choices' => [$categories],
                'choice_label' => 'name'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
        ]);
    }
}
