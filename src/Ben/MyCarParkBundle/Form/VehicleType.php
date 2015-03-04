<?php

namespace Ben\MyCarParkBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VehicleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('vehicleType')
            ->add('registrationNumber')
            ->add('colour')
            ->add('numberOfWheels')
            ->add('height')
            ->add('driver', 'entity', array(
                'required' => TRUE,
                'class' => 'BenMyCarParkBundle:Driver'
            ))
            ->add('registeredOwner', 'entity', array(
                'required' => TRUE,
                'class' => 'BenMyCarParkBundle:RegisteredOwner'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ben\MyCarParkBundle\Entity\Vehicle'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ben_mycarparkbundle_vehicle';
    }
}
