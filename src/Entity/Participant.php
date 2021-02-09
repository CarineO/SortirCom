<?php

namespace App\Entity;

use App\Repository\ParticipantRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=ParticipantRepository::class)
 * @UniqueEntity(
 *     fields={"pseudo"},
 *     errorPath="pseudo",
 *     message="Ce pseudo est déjà utilisé"
 * )
 */
class Participant implements UserInterface
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(type="integer")
	 */
	private $id;
	
	/**
	 * @ORM\Column(type="string", length=180, unique=true)
	 */
	
	private $pseudo;
	
	/**
	 * @ORM\Column(type="json")
	 */
	private $roles = [];
	
	/**
	 * @var string The hashed password
	 * @ORM\Column(type="string")
	 */
	private $password;
	
	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $email;
	
	/**
	 * @ORM\Column(type="string", length=50)
	 */
	private $nom;
	
	/**
	 * @ORM\Column(type="string", length=50)
	 */
	private $prenom;
	
	/**
	 * @ORM\Column(type="string", length=15)
	 */
	private $telephone;
	
	private $plainPassword;
	
	/**
	 * @ORM\ManyToOne (targetEntity="App\Entity\Campus")
	 */
	private $campus;
	

	
	/**
	 * @ORM\ManyToMany (targetEntity="App\Entity\Sortie")
	 */
	private $sorties;
	
	/**
	 * @return mixed
	 */
	public function getSorties()
	{
		return $this->sorties;
	}
	
	/**
	 * @param mixed $sorties
	 */
	public function setSorties($sorties): void
	{
		$this->sorties = $sorties;
	}
	
	
	
	public function getPlainPassword()
	{
		return $this->plainPassword;
	}
	
	
	public function setPlainPassword($password)
	{
		$this->plainPassword = $password;
	}
	
	
	public function getId(): ?int
	{
		return $this->id;
	}
	
	public function getPseudo(): ?string
	{
		return $this->pseudo;
	}
	
	public function setPseudo(string $pseudo): self
	{
		$this->pseudo = $pseudo;
		
		return $this;
	}
	
	/**
	 * A visual identifier that represents this user.
	 *
	 * @see UserInterface
	 */
	public function getUsername(): string
	{
		return (string)$this->pseudo;
	}
	
	/**
	 * @see UserInterface
	 */
	public function getRoles(): array
	{
		$roles = $this->roles;
		// guarantee every user at least has ROLE_USER
		$roles[] = 'ROLE_USER';
		
		return array_unique($roles);
	}
	
	public function setRoles(array $roles): self
	{
		$this->roles = $roles;
		
		return $this;
	}
	
	/**
	 * @see UserInterface
	 */
	public function getPassword(): string
	{
		return (string)$this->password;
	}
	
	public function setPassword(string $password): self
	{
		$this->password = $password;
		
		return $this;
	}
	
	/**
	 * @see UserInterface
	 */
	public function getSalt()
	{
		// not needed when using the "bcrypt" algorithm in security.yaml
	}
	
	/**
	 * @see UserInterface
	 */
	public function eraseCredentials()
	{
		// If you store any temporary, sensitive data on the user, clear it here
		// $this->plainPassword = null;
	}
	
	public function getEmail(): ?string
	{
		return $this->email;
	}
	
	public function setEmail(string $email): self
	{
		$this->email = $email;
		
		return $this;
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
	
	public function getPrenom(): ?string
	{
		return $this->prenom;
	}
	
	public function setPrenom(string $prenom): self
	{
		$this->prenom = $prenom;
		
		return $this;
	}
	
	public function getTelephone(): ?string
	{
		return $this->telephone;
	}
	
	public function setTelephone(string $telephone): self
	{
		$this->telephone = $telephone;
		
		return $this;
	}
	
	/**
	 * @return mixed
	 */
	public function getCampus()
	{
		return $this->campus;
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
	 * @param mixed $campus
	 */
	public function setCampus($campus): void
	{
		$this->campus = $campus;
	}
	
	
	
	
}
