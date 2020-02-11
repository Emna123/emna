<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\UploadedFile;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ProduitRepository")
 * @Vich\Uploadable()
 */
class Produit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $qte;


    /**
     * @ORM\Column(type="string",length=255)
     *
     * @var string|null
     */
    private $img;



    /**
     * @Vich\UploadableField(mapping="admini_image", fileNameProperty="img")
     *
     * @var File|null
     */
    private $imageFile;



    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $prix;




    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Qteproduit", mappedBy="idproduit", orphanRemoval=true,cascade={"all"}, fetch="EAGER")
     */
    private $idproduit;



    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $update_at;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $heart;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $qnt_init;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Favoris", mappedBy="idproduit")
     */
    private $favoris;




    public function __construct()
    {
        $this->idproduit = new ArrayCollection();
        $this->favoris = new ArrayCollection();
    }










   /* /**
     * @ORM\OneToOne(targetEntity="App\Entity\Qteproduit", mappedBy="id_prod", cascade={"persist", "remove","all"}, fetch="EAGER")
     */
 /*   private $id_prod;*/













    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(string $id): self
    {
        $this->id = $id;

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

    public function getQte(): ?int
    {
        return $this->qte;
    }

    public function setQte(?int $qte): self
    {
        $this->qte = $qte;

        return $this;
    }



    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * @return Collection|Qteproduit[]
     */
    public function getIdProduit(): Collection
    {
        return $this->idproduit;
    }

    public function addIdProduit(Qteproduit $idProduit): self
    {
        if (!$this->idproduit->contains($idProduit)) {
            $this->idproduit[] = $idProduit;
            $idProduit->setIdProduit($this);
        }

        return $this;
    }

    public function removeIdProd(Qteproduit $idproduit): self
    {
        if ($this->idproduit->contains($idproduit)) {
            $this->idproduit->removeElement($idproduit);
            // set the owning side to null (unless already changed)
            if ($idproduit->getIdProduit() === $this) {
                $idproduit->setIdProduit(null);
            }
        }

        return $this;
    }



    /**
     * @return string|null
     */
    public function getImg(): ?string
    {
        return $this->img;
    }

    /**
     * @param string|null $img
     */
    public function setImg(?string $img): void
    {
        $this->img = $img;
    }

    /**
     * @return File|null
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }


    /**
     * @param File|null $imageFile
     * @throws Exception
     */
    public function setImageFile(?File $imageFile): void
    {
        $this->imageFile = $imageFile;
        if ($this->imageFile instanceof UploadedFile) {
            $this->update_at = new \DateTime('now');
        }

    }

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->update_at;
    }

    public function setUpdateAt(?\DateTimeInterface $update_at): self
    {
        $this->update_at = $update_at;

        return $this;
    }

    public function getHeart(): ?string
    {
        return $this->heart;
    }

    public function setHeart(?string $heart): self
    {
        $this->heart = $heart;

        return $this;
    }

    public function getQntInit(): ?int
    {
        return $this->qnt_init;
    }

    public function setQntInit(?int $qnt_init): self
    {
        $this->qnt_init = $qnt_init;

        return $this;
    }

    /**
     * @return Collection|Favoris[]
     */
    public function getFavoris(): Collection
    {
        return $this->favoris;
    }

    public function addFavori(Favoris $favori): self
    {
        if (!$this->favoris->contains($favori)) {
            $this->favoris[] = $favori;
            $favori->addIdproduit($this);
        }

        return $this;
    }

    public function removeFavori(Favoris $favori): self
    {
        if ($this->favoris->contains($favori)) {
            $this->favoris->removeElement($favori);
            $favori->removeIdproduit($this);
        }

        return $this;
    }














  /*  public function getIdProd(): ?Qteproduit
    {
        return $this->id_prod;
    }

    public function setIdProd(Qteproduit $id_prod): self
    {
        $this->id_prod = $id_prod;

        // set the owning side of the relation if necessary
        if ($id_prod->getIdProd() !== $this) {
            $id_prod->setIdProd($this);
        }

        return $this;
    }*/












}
