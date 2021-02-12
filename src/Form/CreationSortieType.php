<?php

namespace App\Form;

use App\Entity\Lieu;
use App\Entity\Sortie;
use App\Entity\Ville;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreationSortieType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('nom', TextType::class, [
				'label' => 'Nom de la sortie :'
			])
			->add('dateHeureDebut', DateTimeType::class, [
				'label' => 'Date et heure de la sortie :'
			])
			->add('duree', NumberType::class, [
				'label' => 'Durée :'
			])
			->add('dateLimiteInscription', DateType::class, [
				'label' => 'Date limite d\'inscription :',
			])
			->add('nbInscriptionMax', TextType::class, [
				'label' => 'Nombre de places :'
			])
			->add('infosSortie', TextareaType::class, [
				'label' => 'Description et infos :'
			])
			->add('ville', EntityType::class, [
				'class'       => Ville::class,
				'placeholder' => '--choisissez la ville--',
				'mapped'      => false,
				'required'    => false
			]);
		$builder->get('ville')->addEventListener(
			FormEvents::POST_SUBMIT,
			function (FormEvent $event) {
				$form = $event->getForm();
				$this->addLieux($form->getParent(), $form->getData());
			});
		$builder->addEventListener(
			FormEvents::POST_SET_DATA,
			function (FormEvent $event) {
				$data = $event->getData();
				/* @var $lieux Lieu */
				$lieux = $data->getLieu();
				$form = $event->getForm();
				if ($lieux){
					$ville = $lieux->getVille();
					$this->addLieux($form, $ville);
					$form->get('ville')->setData($ville);
				} 
			}
		);
	}
	
	
	/**
	 * Rajoute un champ lieux au formulaire
	 * @param FormInterface $form
	 * @param Ville         $ville
	 */
	private function addLieux(FormInterface $form, Ville $ville)
	{
		$builder = $form->getConfig()->getFormFactory()->createNamedBuilder(
			'lieux',
			EntityType::class,
			null,
			[
				'class'           => Lieu::class,
				'placeholder'     => '--choisissez un lieu--',
				'mapped'          => false,
				'required'        => false,
				'auto_initialize' => false,
				'choices'         => $ville ? $ville->getLieux() : []
			]
		);
		
		$form->add($builder->getForm());
	}
	
	
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			                       'data_class' => Sortie::class,
		                       ]);
	}
}
