<?php

namespace App\Entity;

use Exception;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdminiRepository")
 * @UniqueEntity("username",message = "Email déjà utilisé .")
  * @UniqueEntity("cin",message = "CIN déjà utilisé .")
 * @UniqueEntity("tel",message = "Numéro Tel déjà utilisé .")
 * @Vich\Uploadable()
 */
class Admini implements UserInterface,\Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string",length=255)
     *
     * @var string|null
     */
    private $imageName;
    /**
     * @Vich\UploadableField(mapping="admini_image", fileNameProperty="imageName")
     *
     * @var File|null
     */
    private $imageFile;
    /**
     * @Assert\Email(
     *     message = "Email non valide."
     * )
     * @ORM\Column(type="string", length=50)
     */
    protected  $username;
    /**
     * @Assert\Regex("/[a-zA-Z]$/",message = "Nom contient uniquement des lettres  .")
     * @ORM\Column(type="string", length=50)
     */


    private $nom;

    /**
     * @Assert\Regex("/[a-zA-Z]$/",message = "Prenom contient uniquement des lettres .")
     * @ORM\Column(type="string", length=20)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;



    /**
     * @Assert\Regex("/^[0-9]{8}$/",message = " Numéro CIN contient uniquement 8 chiffres .")
     * @ORM\Column(type="string", length=8)
     */
    private $cin;

    /**
     * @Assert\Regex("/[0-9]$/",message = "Numéro Tel contient uniquement des chiffres  .")
     * @ORM\Column(type="string", length=8)
     */
    private $tel;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $lieu;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;





 


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password= $password;

        return $this;
    }



    public function getCin(): ?string
    {
        return $this->cin;
    }

    public function setCin(string $cin): self
    {
        $this->cin = $cin;

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

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }


    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return ['ROLE_ADMIN'];
    }


    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return null;
    }


    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }

    /**
     * @inheritDoc
     */
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->username,
            $this->password]);
    }

    /**
     * @inheritDoc
     */
    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->username,
            $this->password
            ) = unserialize($serialized, ['allowed_classes' => false]);
    }

    /**
     * @return string|null
     */
    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    /**
     * @param string|null $imageName
     */
    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
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
            $this->updated_at = new \DateTime('now');
        }
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

 





}
