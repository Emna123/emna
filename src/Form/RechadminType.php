<?php
namespace App\Form;

use App\Entity\Admini;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechadminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('search' ,null , ['attr'=>['placeholder '=>'search...' , 'class'=>'form-group'] ,'required'=>false]);


   }




}