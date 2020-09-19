<?php


namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class addNoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('etudiant', ChoiceType::class, array(
                'choices'  => $options['data']['student_choice']
            ))
            ->add('module', ChoiceType::class, array(
                'choices'  => $options['data']['module_choice']
            ))
            ->add('note', TextType::class)
            ->add('save', SubmitType::class, array(
                'attr' => array('class' => 'save')
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'trait_choices' => null,
        ]);
    }
}
