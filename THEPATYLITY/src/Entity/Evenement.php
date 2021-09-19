<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Void_;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraint;


/**
 * @ORM\Entity(repositoryClass="App\Repository\EvenementRepository")
 * @Vich\Uploadable
 * @ORM\HasLifecycleCallbacks()
 */
class Evenement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     */
    private $id;


    /**
     * @ORM\Column(type="datetime",nullable=true)
     * @var \DateTime|null
     */
    private $updated_at;
    /**

     * @Vich\UploadableField(mapping="evenements", fileNameProperty="filename")
     * @Assert\Valid()
     * @Assert\File()
     * @Assert\Image()
     * @var File
     */

    private $imageFile;


    private $file;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=3)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Country()
     */
    private $contry;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=3)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=5)
     */
    private $address;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     */
    private $date;

    /**

     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Valid()
     * @Assert\File()
     * @Assert\Image()
     * @var File
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $active;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $public;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $capaciterMaxPersonne;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typeDeSale;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=6, nullable=true)
     */
    private $Lat;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=6, nullable=true)
     */
    private $lng;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $FREE;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(min=3)
     */
    private $region;






    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getContry(): ?string
    {
        return $this->contry;
    }

    public function setContry(string $contry): self
    {
        $this->contry = $contry;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getImage(): ?string
    {



        return $this->image;
    }

    public function setImage(?string $image): Evenement
    {
        $this->image = $image;


        if ($this->image instanceof UploadedFile) {
            $this->updated_at = new \DateTime('now');
        }

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(?bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getPublic(): ?bool
    {
        return $this->public;
    }

    public function setPublic(?bool $public): self
    {
        $this->public = $public;

        return $this;
    }

    public function getCapaciterMaxPersonne(): ?int
    {
        return $this->capaciterMaxPersonne;
    }

    public function setCapaciterMaxPersonne(?int $capaciterMaxPersonne): self
    {
        $this->capaciterMaxPersonne = $capaciterMaxPersonne;

        return $this;
    }

    public function getTypeDeSale(): ?string
    {
        return $this->typeDeSale;
    }

    public function setTypeDeSale(?string $typeDeSale): self
    {
        $this->typeDeSale = $typeDeSale;

        return $this;
    }

    public function getLat()
    {
        return $this->Lat;
    }

    public function setLat($Lat): self
    {
        $this->Lat = $Lat;

        return $this;
    }
    /**
     * @return File
     */
    public function getImageFile(): File
    {
        return $this->imageFile;
    }

    /**
     * @param File $imageFile
     * @return Evenement
     */
    public function setImageFile(File $imageFile): Evenement
    {
        $this->imageFile = $imageFile;
        return $this;
    }

    public function getLng()
    {
        return $this->lng;
    }

    public function setLng($lng): self
    {
        $this->lng = $lng;

        return $this;
    }

    public function getFREE(): ?bool
    {
        return $this->FREE;
    }

    public function setFREE(?bool $FREE): self
    {
        $this->FREE = $FREE;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(?string $region): self
    {
        $this->region = $region;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFil()
    {
        return $this->fil;
    }

    /**
     * @param mixed $filename
     * @return Evenement
     */
    public function setFil(UploadedFile $fil)
    {
        $this->filename = $fil;
        return $this;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updated_at;
    }
    
    public function setUpdatedAt(\DateTime $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
    /**
     * @ORM\PreUpdate
     */
      public function updateDate()
    {
    $this->setUpdatedAt(new \DateTime());
    }

}
