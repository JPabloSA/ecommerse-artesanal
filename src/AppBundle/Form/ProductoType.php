<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\File\UploadedFile;



class ProductoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre', TextType::class ,array('attr' => array('class' => 'form-control'),'label'=>"Nombre"))
        ->add('descripcion', TextareaType::class ,array('attr' => array('class' => 'form-control')))
        ->add('precio', TextType::class ,array('attr' => array('class' => 'form-control')))
        ->add('preciomayorista', TextType::class ,array('attr' => array('class' => 'form-control')))
        ->add('imgurl', FileType::class, array(
            "label" => "Imagen:",
            "attr" =>array("class" => "form-control")
        ));


    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Producto'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_producto';
    }


}
