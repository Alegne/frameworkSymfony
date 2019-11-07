<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Commande;
use App\Entity\LigneCommande;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateCommande', DateType::class)
            ->add('client', EntityType::class, [
                'class' => Client::class,
                'choice_label' => 'nom'
            ])
            ->add('ligneCommandes', CollectionType::class, [
                'entry_type' => LigneCommandeType::class,
                'allow_add'    => true,
                'allow_delete' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
