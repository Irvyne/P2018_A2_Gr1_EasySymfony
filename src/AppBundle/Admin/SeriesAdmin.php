<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class SeriesAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', null, [
                'attr' => [
                    'class'    => 'custom-text',
                    'data-url' => 'https://google.com',
                ],
            ])
            ->add('releasedAt', 'date', [
                'years' => range(1900, date('Y')+5),
                'data'  => new \DateTime(),
            ])
            ->add('summary')
            ->add('picture')
            ->add('country', 'country')
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('releasedAt')
            ->add('country')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('name')
            ->add('releasedAt')
            ->add('country')
        ;
    }
}