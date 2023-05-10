<?php

namespace App\Form;

use App\Entity\Type;
use App\Entity\Brand;
use App\Entity\Product;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du produit',
                'empty_data' => ''
                ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'empty_data' => ''
            ])
            ->add('picture', UrlType::class, [
                'label' => 'Affiche',
                'attr' => ['placeholder' => 'par ex. htttps:\\...']
            ])
            ->add('price', NumberType::class, [
                'label' => 'Prix',
                'empty_data' => ''
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => true])
            ->add('type', EntityType::class, [
                'class' => Type::class,
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => true])
            ->add('brand', EntityType::class, [
                'class' => Brand::class,
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => true])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
