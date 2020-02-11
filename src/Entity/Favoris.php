<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FavorisRepository")
 */
class Favoris
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Useraccount", inversedBy="favoris", cascade={"persist", "remove"})
     */
    private $iduser;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Produit", inversedBy="favoris")
     */
    private $idproduit;

    public function __construct()
    {
        $this->idproduit = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIduser(): ?Useraccount
    {
        return $this->iduser;
    }

    public function setIduser(?Useraccount $iduser): self
    {
        $this->iduser = $iduser;

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getIdproduit(): Collection
    {
        return $this->idproduit;
    }

    public function addIdproduit(Produit $idproduit): self
    {
        if (!$this->idproduit->contains($idproduit)) {
            $this->idproduit[] = $idproduit;
        }

        return $this;
    }

    public function removeIdproduit(Produit $idproduit): self
    {
        if ($this->idproduit->contains($idproduit)) {
            $this->idproduit->removeElement($idproduit);
        }

        return $this;
    }
}
