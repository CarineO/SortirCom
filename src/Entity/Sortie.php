<?php

namespace App\Entity;

use App\Repository\SortieRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=SortieRepository::class)
 */
class Sortie
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
     * @ORM\Column(type="datetime")
     */
    private $dateHeureDebut;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $duree;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateLimiteInscription;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbInscriptionMax;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $infosSortie;
	
	/**
	 * @ORM\ManyToOne (targetEntity="App\Entity\Ville")
	 * @Assert\NotBlank()
	 */
    private $ville;
	
	/**
	 * @ORM\ManyToOne (targetEntity="App\Entity\Lieu", inversedBy="sorties")
	 */
    private $lieu;
	
	/**
	 * @ORM\ManyToOne (targetEntity="App\Entity\Participant", inversedBy="organisateur")
	 *
	 */
    private $organisateur;
	
	/**
	 * @ORM\ManyToMany(targetEntity="App\Entity\Participant")
	 */
    private $participants;
	
	/**
	 * @ORM\ManyToOne (targetEntity="App\Entity\Campus")
	 */
    private $campus;
	
	/**
	 * @ORM\ManyToOne (targetEntity="App\Entity\Etat")
	 *
	 */
    private $etat;

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

    public function getDateHeureDebut(): ?\DateTimeInterface
    {
        return $this->dateHeureDebut;
    }

    public function setDateHeureDebut(\DateTimeInterface $dateHeureDebut): self
    {
        $this->dateHeureDebut = $dateHeureDebut;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(?int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getDateLimiteInscription(): ?\DateTimeInterface
    {
        return $this->dateLimiteInscription;
    }

    public function setDateLimiteInscription(\DateTimeInterface $dateLimiteInscription): self
    {
        $this->dateLimiteInscription = $dateLimiteInscription;

        return $this;
    }

    public function getNbInscriptionMax(): ?int
    {
        return $this->nbInscriptionMax;
    }

    public function setNbInscriptionMax(int $nbInscriptionMax): self
    {
        $this->nbInscriptionMax = $nbInscriptionMax;

        return $this;
    }

    public function getInfosSortie(): ?string
    {
        return $this->infosSortie;
    }

    public function setInfosSortie(?string $infosSortie): self
    {
        $this->infosSortie = $infosSortie;

        return $this;
    }

   
	
	
	/**
	 * @return mixed
	 */
	public function getOrganisateur()
	{
		return $this->organisateur;
	}
	
	/**
	 * @param mixed $organisateur
	 */
	public function setOrganisateur($organisateur): void
	{
		$this->organisateur = $organisateur;
	}
	
	
	
	/**
	 * @return mixed
	 */
	public function getParticipants()
	{
		return $this->participants;
	}
	
	/**
	 * @param mixed $participants
	 */
	public function setParticipants($participants): void
	{
		$this->participants = $participants;
	}
	
	/**
	 * @return mixed
	 */
	public function getCampus()
	{
		return $this->campus;
	}
	
	/**
	 * @param mixed $campus
	 */
	public function setCampus($campus): void
	{
		$this->campus = $campus;
	}
	
	/**
	 * @return mixed
	 */
	public function getEtat()
	{
		return $this->etat;
	}
	
	/**
	 * @param mixed $etat
	 */
	public function setEtat($etat): void
	{
		$this->etat = $etat;
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
	
	/**
	 * @return mixed
	 */
	public function getLieu()
	{
		return $this->lieu;
	}
	
	/**
	 * @param mixed $lieu
	 */
	public function setLieu($lieu): void
	{
		$this->lieu = $lieu;
	}
	
	
	
	
	public function __toString()
	{
		return (string) $this->getNom();
	}
	
	
}
