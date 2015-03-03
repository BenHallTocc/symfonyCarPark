<?php

namespace Ben\MyCarParkBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CarParkType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('maxHeight')
            ->add('numberOfCarSpaces')
            ->add('numberOfLorrySpaces')
            ->add('numberOfMotorbikeSpaces')
            ->add('maxStay')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ben\MyCarParkBundle\Entity\CarPark'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ben_mycarparkbundle_carpark';
    }
}
