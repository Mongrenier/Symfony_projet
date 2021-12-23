<?php

namespace App\Form;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class AnimalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                "label" => "Name",
                "required" => true,
            ])
            ->add('age', NumberType::class, [
                "label" => "Age",
                "required" => true,
            ])
            ->add('category_id', EntityType::class, [
                "label" => "Category",
                // L'entityType nous oblige a utiliser 2 options:
                // class qui indique à quelle entité on fait référence
                "class" => Category::class,
                // choice_label qui représente la propriété qui va être utilisée pour l'affichage des options
                // ici name pour le name des catégories
                "choice_label" => "name"
            ])
            ->add('date_arrival',DateType::class, [
                "label" => "Date d'arrivée",
                "widget" => 'single_text',
                "required" => true,
            ])
            ->add('description', TextareaType::class, [
                "label" => "Description"
            ])
            ->add('picture', FileType::class, [
                "label" => "Image (JPG/PNG)",
                "required" => false
            ])
            ->add("Ajouter", SubmitType::class);
    }

}