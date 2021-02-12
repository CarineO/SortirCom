<?php

namespace App\Controller;



use App\Entity\Sortie;
use App\Form\CreationSortieType;
use App\Form\SortieType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SortieController extends AbstractController
{
	/**
	 * @Route("/home",name="home")
	 */
	public function searchSorties(Request $request, EntityManagerInterface $em)
	{
		
		$campus = $request->query->get('campus');
		$search = $request->query->get('search');
		$date1  = $request->query->get('date1');
		$date2  = $request->query->get('date2');
		if ($organisateur = $request->query->get('organisateur')) {
			$organisateur = $this->getUser();
		}
		$datepassee = $request->query->get('datepassee');
		
		
		$repo    = $em->getRepository(Sortie::class);
		$sorties = $repo->searchByFiltre($campus, $search, $date1, $date2, $organisateur, $datepassee);
		return $this->render('main/home.html.twig', [
			'sorties' => $sorties,
		]);
	}
	
	
	/**
	 * @Route("/creationSortie", name="creation_sortie")
	 */
	public function creationSortie (Request $request, EntityManagerInterface $em) {
		
		
		$participant = $this->getUser();
		
		$sortie = new Sortie();
		$sortie->setOrganisateur($participant);
		$creationSortieForm = $this->createForm(CreationSortieType::class, $sortie);
		$creationSortieForm->handleRequest($request);
		
		if ($creationSortieForm->isSubmitted() && $creationSortieForm->isValid()) {
			
			$em->persist($sortie);
			$em->flush();
			return $this->redirectToRoute('home');
			
		}
		
		return $this->render('main/creationSortie.html.twig', [
			'creationSortieForm'  => $creationSortieForm->createView(),
			'sortie' => $sortie,
			
		
		]);
		
		
	}
}

