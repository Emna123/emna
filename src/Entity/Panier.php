<?php

namespace App\Entity;
use App\Entity\Useraccount;
use App\Entity\Produit;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PanierRepository")
 */



class Panier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;







    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Useraccount",cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    public $iduser;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Qteproduit", mappedBy="qnt_acom",cascade={"all"}, fetch="EAGER")
     */
    public $qnt_acom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Qteproduit", mappedBy="idpanier")
     */
    private $qteproduits;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commande", mappedBy="idpanier")
     */
    private $commandes;




    public function __construct()
    {
        $this->qnt_acom = new ArrayCollection();
        $this->qteproduits = new ArrayCollection();
        $this->commandes = new ArrayCollection();
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
     * @return Collection|Qteproduit[]
     */
    public function getQntAcom(): Collection
    {
        return $this->qnt_acom;
    }

    public function addQntAcom(Qteproduit $qntAcom): self
    {
        if (!$this->qnt_acom->contains($qntAcom)) {
            $this->qnt_acom[] = $qntAcom;
            $qntAcom->addQntAcom($this);
        }

        return $this;
    }

    public function removeQntaAcom(Qteproduit $qntAcom): self
    {
        if ($this->qnt_acom->contains($qntAcom)) {
            $this->qnt_acom->removeElement($qntAcom);
            $qntAcom->removeQntAcomc($this);

        }

        return $this;
    }

    /**
     * @return Collection|Qteproduit[]
     */
    public function getQteproduits(): Collection
    {
        return $this->qteproduits;
    }

    public function addQteproduit(Qteproduit $qteproduit): self
    {
        if (!$this->qteproduits->contains($qteproduit)) {
            $this->qteproduits[] = $qteproduit;
            $qteproduit->setIdpanier($this);
        }

        return $this;
    }

    public function removeQteproduit(Qteproduit $qteproduit): self
    {
        if ($this->qteproduits->contains($qteproduit)) {
            $this->qteproduits->removeElement($qteproduit);
            // set the owning side to null (unless already changed)
            if ($qteproduit->getIdpanier() === $this) {
                $qteproduit->setIdpanier(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setIdpanier($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->contains($commande)) {
            $this->commandes->removeElement($commande);


            // set the owning side to null (unless already changed)
            if ($commande->getIdpanier() === $this) {
                $commande->setIdpanier(null);
            }
        }

        return $this;
    }










}
