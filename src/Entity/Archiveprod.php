<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArchiveprodRepository")
 */
class Archiveprod
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_com;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $id_com;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $qnt_com;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $id_prod;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $total;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCom(): ?\DateTimeInterface
    {
        return $this->date_com;
    }

    public function setDateCom(?\DateTimeInterface $date_com): self
    {
        $this->date_com = $date_com;

        return $this;
    }

    public function getIdCom(): ?int
    {
        return $this->id_com;
    }

    public function setIdCom(?int $id_com): self
    {
        $this->id_com = $id_com;

        return $this;
    }

    public function getQntCom(): ?int
    {
        return $this->qnt_com;
    }

    public function setQntCom(?int $qnt_com): self
    {
        $this->qnt_com = $qnt_com;

        return $this;
    }

    public function getIdProd(): ?int
    {
        return $this->id_prod;
    }

    public function setIdProd(?int $id_prod): self
    {
        $this->id_prod = $id_prod;

        return $this;
    }

    public function getTotal(): ?string
    {
        return $this->total;
    }

    public function setTotal(?string $total): self
    {
        $this->total = $total;

        return $this;
    }
}
