<?php

namespace App\Form;

use App\Entity\Admini;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',null, ['label'=>'Nom : '])
            ->add('prenom',null, ['label'=>'Prenom : '])


           ->add('cin', TextType::class, ['label'=>'CIN : '])


            ->add('username',EmailType::class,['label'=>'E-mail : '])

            ->add('tel',TelType::class,['label'=>'Tel : '])

            ->add('lieu',TextareaType::class, ['label'=>'Lieu : '])
            ->add('imageFile',FileType::class,['label'=>'Image : ','required'=>false])

           ->add('password', RepeatedType::class, [
               'type' => PasswordType::class,
               'invalid_message' => 'Confirmation de Mot de Passe incorrect.',
               'options' => ['attr' => ['class' => 'password-field']],
               'required' => true,
               'first_options'  => ['label' => 'Mot de Passe :'],
               'second_options' => ['label' => 'Confirmer mot de passe :'],
           ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Admini::class,
        ]);

    }
}
