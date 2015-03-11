<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SeriesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('releasedAt', 'date', [
                'years' => range(1900, date('Y')+5),
                'data'  => new \DateTime(),
            ])
            ->add('summary')
            ->add('picture')
            ->add('country', 'country')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Series'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_series';
    }
}
