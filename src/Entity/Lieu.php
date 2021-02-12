<?php

namespace App\Entity;

use App\Repository\LieuRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LieuRepository::class)
 */
class Lieu
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(type="integer")
	 */
	private $id;
	
	/**
	 * @ORM\Column(type="string", length=50)
	 */
	private $nom;
	
	/**
	 * @ORM\Column(type="string", length=50, nullable=true)
	 */
	private $rue;
	
	/**
	 * @ORM\Column(type="float", nullable=true)
	 */
	private $latitude;
	
	/**
	 * @ORM\Column(type="float", nullable=true)
	 */
	private $longitude;
	
	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Ville", inversedBy="lieux")
	 */
	private $ville;
	
	/**
	 * @ORM\OneToMany (targetEntity="App\Entity\Sortie", mappedBy="lieu")
	 */
	private $sorties;
	
	
	public function getId(): ?int
	{
		return $this->id;
	}
	
	public function getNom(): ?string
	{
		return $this->nom;
	}
	
	public function setNom(string $nom): self
	{
		$this->nom = $nom;
		
		return $this;
	}
	
	public function getRue(): ?string
	{
		return $this->rue;
	}
	
	public function setRue(?string $rue): self
	{
		$this->rue = $rue;
		
		return $this;
	}
	
	public function getLatitude(): ?float
	{
		return $this->latitude;
	}
	
	public function setLatitude(?float $latitude): self
	{
		$this->latitude = $latitude;
		
		return $this;
	}
	
	public function getLongitude(): ?float
	{
		return $this->longitude;
	}
	
	public function setLongitude(?float $longitude): self
	{
		$this->longitude = $longitude;
		
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getVille()
	{
		return $this->ville;
	}
	
	/**
	 * @param mixed $ville
	 */
	public function setVille($ville): void
	{
		$this->ville = $ville;
	}
	
	public function __toString()
	{
		return (string) $this->getNom();
	}
	
	
}
