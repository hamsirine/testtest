<?php

namespace App\Form;

use App\Entity\Products;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProductsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ...
            ->add('brochure', FileType::class, [
                'label' => 'télecharger un fichier',

// unmapped means that this field is not associated to any entity property
                'mapped' => false,

// make it optional so you don't have to re-upload the PDF file
// every time you edit the Product details
                'required' => false,

// unmapped fields can't define their validation using annotations
// in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([

                        'mimeTypes' => [
                            'text/*',

                        ],
                        'mimeTypesMessage' => 'Please upload a valid txt document',
                    ])
                ],
            ])

            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'save'],
            ]);
// ...
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Products::class,
        ]);
    }
}
