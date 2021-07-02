<?php

namespace App\Form;

use App\Entity\MealPlanItem;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
class MealPlanItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('day', ChoiceType::class, [
                'choices' => array_combine(MealPlanItem::DAYS, MealPlanItem::DAYS)
            ])
            ->add('meal')
            ->add('course', EntityType::class,[
                'class' => 'App\Entity\Course'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MealPlanItem::class,
        ]);
    }
}
