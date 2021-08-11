<?php

namespace App\Form;

use Mael\MaelRecaptchaBundle\Type\MaelRecaptchaCheckboxType;
use Mael\MaelRecaptchaBundle\Validator\MaelRecaptcha;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'required'   => true,
                'attr' => [
                    'placeholder' => 'Dupont'
                ]
            ])


            ->add('prenom', TextType::class, [
                'required'   => true,
                'attr' => [
                    'placeholder' => 'Jean',
                ]
            ])

            ->add('fonction', TextType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => 'Coördinator',
                ]
            ])

            ->add('telephone', TelType::class, [
                'required' => false,
                'constraints' => [
                    new Length(['min' => 8, 'minMessage' => "Een telefoonnummer bestaat uit minimaal 8 cijfers"]),
                    new Length(['max' => 14, 'maxMessage' => "Gelieve maximaal 14 cijfers in te voeren"]),
                ],
                'attr' => [
                    'placeholder' => '0123456789'
                ]
            ])

            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 6, 'minMessage' => "Voer ten minste 6 tekens in"]),
                ],
                'required'   => true,
                'attr' => [
                    'placeholder' => 'exemple@mail.com',
                ]
            ])

            ->add('objet', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 10, 'minMessage' => "Voer ten minste 10 tekens in"]),
                ],
                'required'   => true,
                'attr' => [
                    'placeholder' => 'Onderwerp van het bericht',
                ]
            ])

            ->add('message', TextareaType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 10, 'minMessage' => "Voer ten minste 10 tekens in"]),
                ],
                'required'   => true,
                'attr' => [
                    'placeholder' => 'Uw bericht (minimaal 10 tekens.)',
                    'rows' => 10,
                ]
            ])

            ->add('captcha_checkvox', MaelRecaptchaCheckboxType::class, [
                'constraints' =>[
                    new MaelRecaptcha()
                ]
            ])

            ->add('verzenden', SubmitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here


        ]);
    }
}
