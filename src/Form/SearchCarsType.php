<?php

namespace App\Form;

use App\Entity\SearchCars;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class SearchCarsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('minYear', IntegerType::class,[
                "required" => false, 
                "label"   => "Année de : ", 
                "attr"    => [
                    "placeholder" => "2005"
                ]
            ])
            ->add('maxYear', IntegerType::class,[
                "required" => false, 
                "label"   => "Année à : ",
                "attr"    => [
                    "placeholder" => "2020"
                ] 
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class"      => SearchCars::class, 
            "method"          => "get",
            "csrf_protection" => false
        ]);
    }
}
