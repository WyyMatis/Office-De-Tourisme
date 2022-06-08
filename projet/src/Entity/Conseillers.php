<?php

namespace App\Entity;


use App\Repository\ConseillersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConseillersRepository::class)
 */
class Conseillers
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDeNaissance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $tel;

    /**
     * @ORM\ManyToMany(targetEntity=Langue::class, inversedBy="conseillers",cascade={"persist"})
     */
    private $langues;

    /**
     * @ORM\ManyToMany(targetEntity=Specialite::class, inversedBy="conseillers",cascade={"persist"})
     */
    private $domaines;

    /**
     * @ORM\ManyToMany(targetEntity=Creneau::class, mappedBy="conseillers")
     */
    private $creneaus;

    /**
     * @ORM\OneToMany(targetEntity=RDV::class, mappedBy="conseillers")
     */
    private $rdv;

    public function __construct()
    {
        $this->langues = new ArrayCollection();
        $this->domaines = new ArrayCollection();
        $this->creneaus = new ArrayCollection();
        $this->rdv = new ArrayCollection();
    }

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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateDeNaissance(): ?\DateTimeInterface
    {
        return $this->dateDeNaissance;
    }

    public function setDateDeNaissance(\DateTimeInterface $dateDeNaissance): self
    {
        $this->dateDeNaissance = $dateDeNaissance;

        return $this;
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

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }
    public function getAge(): ?int
    {
        $datetime1 = new \DateTime(); // date actuelle
        $datetime2 =  $this->dateDeNaissance;
        return $age = $datetime1->diff($datetime2, true)->y;
    }

    /**
     * @return Collection|Langue[]
     */
    public function getLangues(): Collection
    {
        return $this->langues;
    }

    public function addLangue(Langue $langue): self
    {
        if (!$this->langues->contains($langue)) {
            $this->langues[] = $langue;
        }

        return $this;
    }

    public function removeLangue(Langue $langue): self
    {
        $this->langues->removeElement($langue);

        return $this;
    }

    /**
     * @return Collection|Specialite[]
     */
    public function getDomaines(): Collection
    {
        return $this->domaines;
    }

    public function addDomaine(Specialite $domaine): self
    {
        if (!$this->domaines->contains($domaine)) {
            $this->domaines[] = $domaine;
        }

        return $this;
    }

    public function removeDomaine(Specialite $domaine): self
    {
        $this->domaines->removeElement($domaine);

        return $this;
    }

    /**
     * @return Collection|Creneau[]
     */
    public function getCreneaus(): Collection
    {
        return $this->creneaus;
    }

    public function addCreneau(Creneau $creneau): self
    {
        if (!$this->creneaus->contains($creneau)) {
            $this->creneaus[] = $creneau;
            $creneau->addConseiller($this);
        }

        return $this;
    }

    public function removeCreneau(Creneau $creneau): self
    {
        if ($this->creneaus->removeElement($creneau)) {
            $creneau->removeConseiller($this);
        }

        return $this;
    }

    /**
     * @return Collection|RDV[]
     */
    public function getRdv(): Collection
    {
        return $this->rdv;
    }

    public function addRdv(RDV $rdv): self
    {
        if (!$this->rdv->contains($rdv)) {
            $this->rdv[] = $rdv;
            $rdv->setConseillers($this);
        }

        return $this;
    }

    public function removeRdv(RDV $rdv): self
    {
        if ($this->rdv->removeElement($rdv)) {
            // set the owning side to null (unless already changed)
            if ($rdv->getConseillers() === $this) {
                $rdv->setConseillers(null);
            }
        }

        return $this;
    }
}
