<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                'label'=>'Nom',
                'attr'=>['placeholder' => 'Nom...',
                    'class' => 'form-control'],
                'label_attr' =>['class' => 'form-label'],
            ])
            ->add('shortDescription',TextareaType::class,[
                'label'=>"Description courte",
                'attr' => ['placeholder' =>'entrez une description courte...',
                    'class' => 'form-control',
                    'rows' => 3,
                    'style' =>'resize:none;'],
                'label_attr' => ['class' => 'form-label'],
            ])
            ->add('price')
            ->add('longDescription')
            ->add('quantity')
            ->add('visible')
            ->add('created_at')
            ->add('mainPicture')
            ->add('category');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
