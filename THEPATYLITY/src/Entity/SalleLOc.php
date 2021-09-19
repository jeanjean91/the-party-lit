<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SalleLOcRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class SalleLOc
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="salleLOcs")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(min=3)
     */
    private $type;



    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(min=3)
     */
    private $SalleName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(min=3)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=5)
     */
    private $adress;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Country()
     */
    private $coutry;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=3)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(min=3)
     */
    private $region;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $zipCode;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0, nullable=true)
     */
    private $lat;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0, nullable=true)
     */
    private $lng;
    /**
     * @ORM\Column(type="datetime",nullable=true)
     * @var \DateTime|null
     */
    private $updated_at;
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $disponible;

    /**
     * @ORM\Column(type="integer")
     */
    private $capaciter;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix;
    /**
     * @Vich\UploadableField(mapping="salle", fileNameProperty="filename")
     * @Assert\Valid()
     * @Assert\File()
     * @Assert\Image()
     *
     * File
     * @var File
     */
    private $imageFile;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Valid()
     * @Assert\File()
     * @Assert\Image()
     * @var File
     */
    private $image;


    /**
     * @ORM\OneToMany(targetEntity=Images::class, mappedBy="salle", orphanRemoval=true, cascade= {"persist"})
     */
    private $images;





    /**
     * @ORM\OneToMany(targetEntity=Booking::class, mappedBy="salle", orphanRemoval=true, cascade= {"persist"})
     */
    private $Booking;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->sallname = new ArrayCollection();
        $this->booking = new ArrayCollection();
    }


    /**
     * @return mixed
     */
    public function getSalleName()
    {
        return $this->SalleName;
    }

    /**
     * @param mixed $SalleName
     * @return SalleLOc
     */
    public function setSalleName($SalleName)
    {
        $this->SalleName = $SalleName;
        return $this;
    }





    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }


     public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getBooking(): ArrayCollection
    {
        return $this->booking;
    }

    /**
     * @param ArrayCollection $booking
     * @return SalleLOc
     */
    public function setBooking(ArrayCollection $booking): SalleLOc
    {
        $this->booking = $booking;
        return $this;
    }



//      public function updateDate()
//    {
//    $this->setUpdatedAt(new \DateTimeInterface());
//    }

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getCoutry(): ?string
    {
        return $this->coutry;
    }

    public function setCoutry(string $coutry): self
    {
        $this->coutry = $coutry;

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

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(?string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getZipCode(): ?int
    {
        return $this->zipCode;
    }

    public function setZipCode(?int $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getLat(): ?string
    {
        return $this->lat;
    }

    public function setLat(?string $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLng(): ?string
    {
        return $this->lng;
    }

    public function setLng(?string $lng): self
    {
        $this->lng = $lng;

        return $this;
    }

    public function getDisponible(): ?bool
    {
        return $this->disponible;
    }

    public function setDisponible(?bool $disponible): self
    {
        $this->disponible = $disponible;

        return $this;
    }

    public function getCapaciter(): ?int
    {
        return $this->capaciter;
    }

    public function setCapaciter(int $capaciter): self
    {
        $this->capaciter = $capaciter;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getSallname(): ArrayCollection
    {
        return $this->sallname;
    }

    /**
     * @param ArrayCollection $sallname
     * @return SalleLOc
     */
    public function setSallname(ArrayCollection $sallname): SalleLOc
    {
        $this->sallname = $sallname;
        return $this;
    }










    /**
     * @return Collection|Images[]
     */
    /*public function getImages(): Collection
    {
        return $this->images;
    }*/

    public function addImage(Images $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setSalle($this);
        }

        return $this;
    }


    /**
     * @return File
     */
    public function getImageFile():?File
    {
        return $this->imageFile;
    }
    /**
     * @param File $imageFile
     * @return SalleLOc
     */
    public function setImageFile(File $imageFile): SalleLOc
    {
        $this->imageFile = $imageFile;
        return $this;
    }
    public function getImage(): ?string
    {
        return $this->image;
    }
    public function setImage(?string $image): SalleLOc
    {
        $this->image = $image;
        if ($this->image instanceof UploadedFile) {
            $this->updated_at = new \DateTime('now');
        }
        return $this;
    }

















}
