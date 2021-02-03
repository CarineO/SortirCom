<?php

namespace App\Controller;

use App\Form\ProfilType;
use App\Repository\ParticipantRepository;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ProfilController extends AbstractController
{
	/**
	 * @Route("/profil", name="profil")
	 */
	public function monprofil(Request $request, EntityManagerInterface $em, ParticipantRepository $participant, UserPasswordEncoderInterface $encoder)
	{
		$participant = $this->getUser();
		$formProfil  = $this->createForm(ProfilType::class, $participant);
		$formProfil->handleRequest($request);
		if ($formProfil->isSubmitted() && $formProfil->isValid()) {
			if (!empty($participant->getPlainPassword())) {
				
				$hashed = $encoder->encodePassword($participant, $participant->getPassword());
				$participant->setPassword($hashed);
				$participant->getPlainPassword();
			
			$em->persist($participant);
			$em->flush();
			return $this->redirectToRoute('home');
			}
		}
		
		return $this->render('profil/monprofil.html.twig', [
			'formProfil'  => $formProfil->createView(),
			'participant' => $participant
		
		]);
	}
	
}
