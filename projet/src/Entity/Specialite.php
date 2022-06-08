<?php

namespace App\Entity;

use App\Repository\SpecialiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SpecialiteRepository::class)
 */
class Specialite
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
    private $domaine;

    /**
     * @ORM\ManyToMany(targetEntity=Conseillers::class, mappedBy="domaines",cascade={"persist"})
     */
    private $conseillers;

    public function __construct()
    {
        $this->conseillers = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDomaine(): ?string
    {
        return $this->domaine;
    }

    public function setDomaine(string $domaine): self
    {
        $this->domaine = $domaine;

        return $this;
    }

    /**
     * @return Collection|Conseillers[]
     */
    public function getConseillers(): Collection
    {
        return $this->conseillers;
    }

    public function addConseiller(Conseillers $conseiller): self
    {
        if (!$this->conseillers->contains($conseiller)) {
            $this->conseillers[] = $conseiller;
            $conseiller->addDomaine($this);
        }

        return $this;
    }

    public function removeConseiller(Conseillers $conseiller): self
    {
        if ($this->conseillers->removeElement($conseiller)) {
            $conseiller->removeDomaine($this);
        }

        return $this;
    }

    public function __toString()
    {
        // to show the name of the Category in the select
        return $this->domaine;
    }
}
