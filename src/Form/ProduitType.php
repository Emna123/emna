<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',null, ['label'=>'Libellé : '])
            ->add('qte',null, ['label'=>'Quantité Restante: '])
            ->add('imageFile',FileType::class,['label'=>'Image : ','required'=>false])
            ->add('prix',null, ['label'=>'Prix : '])
            ->add('qnt_init',null, ['label'=>'Quantité Initiale: '])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
