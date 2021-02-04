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

class SearchByOwnerFormType extends AbstractType
{

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $owners = $this->userRepository->findAll();
            $builder
            ->add('owner', ChoiceType::class, [
                'choices' => [$owners],
                'choice_label' => 'name'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
        ]);
    }
}
