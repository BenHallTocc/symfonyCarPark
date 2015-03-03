<?php

namespace Ben\MyCarParkBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StayType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('entryTime')
            ->add('exitByTime')
            ->add('carPark')
            ->add('vehicle')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ben\MyCarParkBundle\Entity\Stay'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ben_mycarparkbundle_stay';
    }
}
