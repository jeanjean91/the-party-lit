<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MapMarkerRepository")
 */
class MapMarker
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Evenement", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $EvnenementId;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=6)
     */
    private $lng;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=6)
     */
    private $lat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEvnenementId(): ?Evenement
    {
        return $this->EvnenementId;
    }

    public function setEvnenementId(Evenement $EvnenementId): self
    {
        $this->EvnenementId = $EvnenementId;

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

    public function getLat()
    {
        return $this->lat;
    }

    public function setLat($lat): self
    {
        $this->lat = $lat;

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
}
