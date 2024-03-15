<?php

namespace App\Entity;

use App\Entity\Traits\TimestampTraits;
use App\Repository\PropertyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PropertyRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Property
{
    use TimestampTraits;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $propHousingType = null;

    #[ORM\Column]
    private ?int $propNbRooms = null;

    #[ORM\Column]
    private ?int $propSqm = null;

    #[ORM\Column]
    private ?int $propPrice = null;

    #[ORM\Column(nullable: true)]
    private ?int $propNbBeds = null;

    #[ORM\Column(nullable: true)]
    private ?int $propNbBaths = null;

    #[ORM\Column(nullable: true)]
    private ?int $propNbSpaces = null;

    #[ORM\Column(nullable: true)]
    private ?bool $propFurnished = null;

    #[ORM\OneToMany(targetEntity: Picture::class, mappedBy: 'property', cascade: ['persist', 'remove'])]
    private Collection $picture;

    #[ORM\ManyToOne(inversedBy: 'properties')]
    private ?Category $category = null;

    #[ORM\Column(type: Types::ARRAY , nullable: true)]
    private ?array $feature = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(length: 255)]
    private ?string $adress = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    public function __construct()
    {
        $this->picture = new ArrayCollection();
    }



    /**
     * @return Collection<int, Picture>
     */
    public function getPicture(): Collection
    {
        return $this->picture;
    }

    public function addPicture(Picture $picture): static
    {
        if (!$this->picture->contains($picture)) {
            $this->picture->add($picture);
            $picture->setProperty($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): static
    {
        if ($this->picture->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getProperty() === $this) {
                $picture->setProperty(null);
            }
        }

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getFeature(): ?array
    {
        return $this->feature;
    }

    public function setFeature(?array $feature): static
    {
        $this->feature = $feature;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPropHousingType(): ?string
    {
        return $this->propHousingType;
    }

    public function setPropHousingType(string $propHousingType): static
    {
        $this->propHousingType = $propHousingType;

        return $this;
    }

    public function getPropNbRooms(): ?int
    {
        return $this->propNbRooms;
    }

    public function setPropNbRooms(int $propNbRooms): static
    {
        $this->propNbRooms = $propNbRooms;

        return $this;
    }

    public function getPropSqm(): ?int
    {
        return $this->propSqm;
    }

    public function setPropSqm(int $propSqm): static
    {
        $this->propSqm = $propSqm;

        return $this;
    }

    public function getPropPrice(): ?int
    {
        return $this->propPrice;
    }

    public function setPropPrice(int $propPrice): static
    {
        $this->propPrice = $propPrice;

        return $this;
    }

    public function getPropNbBeds(): ?int
    {
        return $this->propNbBeds;
    }

    public function setPropNbBeds(?int $propNbBeds): static
    {
        $this->propNbBeds = $propNbBeds;

        return $this;
    }

    public function getPropNbBaths(): ?int
    {
        return $this->propNbBaths;
    }

    public function setPropNbBaths(?int $propNbBaths): static
    {
        $this->propNbBaths = $propNbBaths;

        return $this;
    }

    public function getPropNbSpaces(): ?int
    {
        return $this->propNbSpaces;
    }

    public function setPropNbSpaces(?int $propNbSpaces): static
    {
        $this->propNbSpaces = $propNbSpaces;

        return $this;
    }

    public function isPropFurnished(): ?bool
    {
        return $this->propFurnished;
    }

    public function setPropFurnished(?bool $propFurnished): static
    {
        $this->propFurnished = $propFurnished;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): static
    {
        $this->adress = $adress;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }



}
