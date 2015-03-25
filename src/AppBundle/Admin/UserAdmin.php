<?php

namespace AppBundle\Admin;

use AppBundle\Entity\User;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class UserAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $isNew = null === $this->getSubject()->getId() ? true : false;

        $formMapper
            ->add('lastName')
            ->add('firstName')
            ->add('birthday', 'birthday', [
                'years' => range(date('Y')-90, date('Y')),
            ])
            ->add('gender', 'choice', [
                'choices' => [
                    User::GENDER_MALE   => 'Male',
                    User::GENDER_FEMALE => 'Female',
                ],
                'data' => true === $isNew ? User::GENDER_FEMALE : null,
            ])
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('lastName')
            ->add('firstName')
            //->add('birthday', null, [], 'date')
            ->add('gender', null, [], 'choice', [
                'choices' => [
                    User::GENDER_MALE   => 'Male',
                    User::GENDER_FEMALE => 'Female',
                ],
            ])
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('lastName')
            ->add('firstName')
            ->add('birthday')
            ->add('gender', 'choice', [
                'choices' => [
                    User::GENDER_MALE   => 'Male',
                    User::GENDER_FEMALE => 'Female',
                ],
            ])
            ->add('_action', 'actions', [
                'actions' => [
                    'show'   => [],
                    'edit'   => [],
                    'delete' => [],
                ],
            ])
        ;
    }

    // Fields to be shown on show action
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('lastName')
            ->add('firstName')
            ->add('birthday')
            ->add('gender')
        ;
    }
}