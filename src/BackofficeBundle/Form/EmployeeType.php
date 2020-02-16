<?php

namespace BackofficeBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('Name');
        $builder->add('Last_name') ->add('Fonction', ChoiceType::class, array('label' => 'Fonction ',
        'choices' => array(' GESIONNAIRE COMMUNICATION' => 'GESIONNAIRE COMMUNICATION',
            'GESTIONNAIRE STOCK' => 'GESTIONNAIRE STOCK',
            'GESTIONNAIRE FACTURATION' => 'GESTIONNAIRE FACTURATION'), 'required' => true));
           $builder->add('Birth_Date', DateType::class, [
            'widget' => 'single_text']);

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BackofficeBundle\Entity\Employee'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'backofficebundle_employee';
    }


}
