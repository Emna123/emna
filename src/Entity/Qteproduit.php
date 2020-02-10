<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QteproduitRepository")
 */
class Qteproduit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    public $qteproduit;

   /* /**
     * @ORM\OneToOne(targetEntity="App\Entity\Produit", inversedBy="id_prod", cascade={"persist", "remove","all"}, fetch="EAGER")
     * @ORM\JoinColumn(nullable=false)
     */
   /* public $id_prod;*/

    /*/**
     * @ORM\ManyToMany(targetEntity="App\Entity\Panier", mappedBy="id_qnt",cascade={"all","persist", "remove"}, fetch="EAGER")
     */
 /*   private $id_qnt;*/

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Panier", inversedBy="qnt_acom",cascade={"all","persist", "remove"}, fetch="EAGER")
     */
    public $qnt_acom;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Produit", inversedBy="idproduit",cascade={"all","persist", "remove"}, fetch="EAGER")
     * @ORM\JoinColumn(nullable=false)
     */
    public $idproduit;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Panier", inversedBy="qteproduits")
     */
    private $idpanier;







    public function __construct()
    {
      /*  $this->id_qnt = new ArrayCollection();*/
        $this->qnt_acom = new ArrayCollection();
    }




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQteproduit(): ?int
    {
        return $this->qteproduit;
    }

    public function setQteproduit(int $qteproduit): self
    {
        $this->qteproduit = $qteproduit;

        return $this;
    }

   /* public function getIdProd(): ?Produit
    {
        return $this->id_prod;
    }

   public function setIdProd(Produit $id_prod): self
    {
        $this->id_prod = $id_prod;

        return $this;
    }*/

    /**
     * @return Collection|Panier[]
     */
    public function getQntAcom(): Collection
    {
        return $this->qnt_acom;
    }

    public function addQntAcom(Panier $qntAcom): self
    {
        if (!$this->qnt_acom->contains($qntAcom)) {
            $this->qnt_acom[] = $qntAcom;
        }

        return $this;
    }

 public function removeQntAcomc(Panier $qntAcom): self
          {
              if ($this->qnt_acom->contains($qntAcom)) {
                                                   
                  $this->qnt_acom->removeElement($qntAcom);
              }
                                                   
              return $this;
          }

    public function getIdproduit(): ?Produit
    {
        return $this->idproduit;
    }

    public function setIdproduit(?Produit $idproduit): self
    {
        $this->idproduit = $idproduit;

        return $this;
    }

    public function getIdpanier(): ?Panier
    {
        return $this->idpanier;
    }

    public function setIdpanier(?Panier $idpanier): self
    {
        $this->idpanier = $idpanier;

        return $this;
    }









}