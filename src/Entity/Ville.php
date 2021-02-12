<?php

namespace App\Entity;

use App\Repository\VilleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VilleRepository::class)
 */
class Ville
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
     * @ORM\Column(type="string", length=50)
     */
    private $codePostal;
	
	/**
	 * @ORM\OneToMany (targetEntity="App\Entity\Lieu", mappedBy="ville")
	 */
	private $lieux;
	
	
	
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

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }
	
	/**
	 * @return mixed
	 */
	public function getLieux()
	{
		return $this->lieux;
	}
	
	/**
	 * @param mixed $lieux
	 */
	public function setLieux($lieux): void
	{
		$this->lieux = $lieux;
	}
	
	
	
	public function __toString()
	{
		return (string) $this->getNom();
		
	}
}
