<?php
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\User\UserInterface;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @Vich\Uploadable
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(fields="email", message="un compte a deja ete creer avec cette adresse emeil!")
 * @UniqueEntity(fields="user", message="un compte a deja ete creer avec ce pseudo!  rajoujetez un chifre ou une lettre ")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @Vich\UploadableField(mapping="users", fileNameProperty="filename")
     * @Assert\Valid()
     * @Assert\File()
     * @Assert\Image()
     * 
     * File
     * @var File
     */
    private $imageFile;
    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * 
     */
    private $email;
    /**
     * @ORM\Column(type="string", length=255, nullable=true))
     */
    private $civilite;
    /**
     * @ORM\Column(type="json",nullable=true)
     */
    private $roles = [];
    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Assert\Length(min=6)
     */
    private $password;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Country()
     */
    private $contry;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(min=3)
     */
    private $city;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $zipCiode;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $accompte;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $category;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(min=5)
     */
    private $user;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Valid()
     * @Assert\File()
     * @Assert\Image()
     * @var File
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SalleLOc", mappedBy="user")
     */
    private $salleLOcs;

    /**
     * @var string le token qui servira lors de l'oubli de mot de passe
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $resetToken;
     /**
     * @ORM\Column(type="datetime",nullable=true)
     * @var \DateTime|null
     */
    private $updated_at;
   



    public function __construct()
    {
        $this->salleLOcs = new ArrayCollection();
    }

    
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }
    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }
    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }
    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }
    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }
    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
    public function getUser(): ?string
    {
        return $this->user;
    }
    public function setUser(?string $user): self
    {
        $this->user = $user;
        return $this;
    }
    public function getContry(): ?string
    {
        return $this->contry;
    }
    public function setContry(?string $contry): self
    {
        $this->contry = $contry;
        return $this;
    }
    public function getCity(): ?string
    {
        return $this->city;
    }
    public function setCity(?string $city): self
    {
        $this->city = $city;
        return $this;
    }
    public function getAdress(): ?string
    {
        return $this->adress;
    }
    public function setAdress(?string $adress): self
    {
        $this->adress = $adress;
        return $this;
    }
    public function getZipCiode(): ?int
    {
        return $this->zipCiode;
    }
    public function setZipCiode(?int $zipCiode): self
    {
        $this->zipCiode = $zipCiode;
        return $this;
    }
    public function getAccompte(): ?string
    {
        return $this->accompte;
    }
    public function setAccompte(?string $accompte): self
    {
        $this->accompte = $accompte;
        return $this;
    }
    public function getCategory(): ?string
    {
        return $this->category;
    }
    public function setCategory(?string $category): self
    {
        $this->category = $category;
        return $this;
    }

    public function getCivilite(): ?string
    {
        return $this->civilite;
    }

    public function setCivilite(string $civilite): self
    {
        $this->civilite = $civilite;

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
     * @return Evenement
     */
    public function setImageFile(File $imageFile): User
    {
        $this->imageFile = $imageFile;
        return $this;
    }
    public function getImage(): ?string
    {
        return $this->image;
    }
    public function setImage(?string $image): User
    {
        $this->image = $image;
        if ($this->image instanceof UploadedFile) {
            $this->updated_at = new \DateTime('now');
        }
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

    /**
     * @return Collection|SalleLOc[]
     */
    public function getSalleLOcs(): Collection
    {
        return $this->salleLOcs;
    }

    public function addSalleLOc(SalleLOc $salleLOc): self
    {
        if (!$this->salleLOcs->contains($salleLOc)) {
            $this->salleLOcs[] = $salleLOc;
            $salleLOc->setUser($this);
        }

        return $this;
    }

    public function removeSalleLOc(SalleLOc $salleLOc): self
    {
        if ($this->salleLOcs->contains($salleLOc)) {
            $this->salleLOcs->removeElement($salleLOc);
            // set the owning side to null (unless already changed)
            if ($salleLOc->getUser() === $this) {
                $salleLOc->setUser(null);
            }
        }

        return $this;
    }
    
     /**
     * @return string
     */
    public function getResetToken(): string
    {
        return $this->resetToken;
    }

    /**
     * @param string $resetToken
     */
    public function setResetToken(?string $resetToken): void
    {
        $this->resetToken = $resetToken;
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