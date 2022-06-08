<?php

namespace App\Entity;

use App\Repository\LangueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LangueRepository::class)
 */
class Langue
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
    private $langage;

    /**
     * @ORM\ManyToMany(targetEntity=Conseillers::class, mappedBy="langues",cascade={"persist"})
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

    public function getLangage(): ?string
    {
        return $this->langage;
    }

    public function setLangage(string $langage): self
    {
        $this->langage = $langage;

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
        }

        return $this;
    }

    public function removeConseiller(Conseillers $conseiller): self
    {
        $this->conseillers->removeElement($conseiller);

        return $this;
    }

    public function __toString()
    {
        // to show the name of the Category in the select
        return $this->langage;
    }
}
