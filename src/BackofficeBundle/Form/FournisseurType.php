<?php

namespace BackofficeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FournisseurType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('Name');
        $builder->add('Last_name');
        $builder->add('societe');
        $builder->add('numsociete');
        $builder ->add('secteur', ChoiceType::class, array('label' => 'secteur ',
        'choices' => array('AGRICULTRE' => 'AGRICULTRE',
            'FOOD' => 'FOOD',
            'TEXTILE' => 'TEXTILE'), 'required' => true));
        $builder->add('Birth_Date', DateType::class, [
            'widget' => 'single_text']);
    }

            /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BackofficeBundle\Entity\Fournisseur'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'backofficebundle_fournisseur';
    }


}
