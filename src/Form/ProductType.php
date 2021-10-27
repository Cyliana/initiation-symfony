<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
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
                'label'=>'Description courte',
                'attr' => ['placeholder' =>'Entrez une description courte...',
                    'class' => 'form-control',
                    'rows' => 3,
                    'style' =>'resize:none;'],
                'label_attr' => ['class' => 'form-label'],
            ])
            ->add('price',MoneyType::class,[
                'label'=>'Prix',
                'attr'=>['placeholder'=>'Entrez un prix',
                    'class'=>'form-control'],
                'label_attr' => ['class' => 'form-label'],
                'currency'=>false
            ])
            ->add('longDescription', TextareaType::class,[
                'label'=>'Longue description',
                'attr'=>['placeholder'=>'Entrez une longue description...',
                    'class'=>'form-control',
                    'rows'=>10,
                    'style'=>'resize:none;'],
                'label_attr' => ['class' => 'form-label'],
            ])
            ->add('quantity',NumberType::class,[
                'label'=>'Quantité',
                'attr'=>['placeholder'=>'Entrez une quantité',
                    'class'=>'form-control'],
                'label_attr' => ['class' => 'form-label'],
                'html5'=>true
            ])

            ->add('visible', CheckboxType::class,[
                'label'=>'Visibilité',
                'attr'=>['placeholder'=>'Le produit sera-t\'il visible ?',
                    'class'=>'form-check-input'],
                'label_attr' => ['class' => 'form-check-label'],
                'required'=>false
            ])

            ->add('mainPicture', UrlType::class,[
                'label'=>'URL de votre image',
                'attr'=>['placeholder'=>'Entrez l\'url de votre image',
                    'class'=>'form-control'],
                'label_attr' => ['class' => 'form-label'],
            ])
            ->add('category',EntityType::class,[
                'class'=>Category::class,
                'label'=>'Catégories',
                'placeholder'=>'Choississez la catégorie',
                'attr'=>['class'=>'form-control'],
                'label_attr' => ['class' => 'form-label'],

                'query_builder' => function( EntityRepository $cat )
                {                
                    return $cat ->createQueryBuilder('qb')
                        ->orderBy('qb.name','ASC');
                },

                'choice_label' => function ($cat) 
                {
                    return strtoupper($cat);
                }
            ]);
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
