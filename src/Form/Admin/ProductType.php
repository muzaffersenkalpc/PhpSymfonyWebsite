<?php

namespace App\Form\Admin;

use App\Entity\Admin\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('keywords')
            ->add('description')
            ->add('type')
            ->add('seller_id')
            ->add('Model')
            ->add('amount')
            ->add('pprice')
            ->add('sprice')
            ->add('image')
            ->add('gallery')
            ->add('firma_id')
            ->add('category_id')
            ->add('status')
            ->add('detail')




        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
            'csrf_protection'=>false,
        ]);
    }
}
