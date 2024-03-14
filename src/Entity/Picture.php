<?php

namespace App\Entity;

use App\Entity\Traits\TimestampTraits;
use App\Repository\PictureRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: PictureRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[Vich\Uploadable]
class Picture
{
    use TimestampTraits;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?string $attachment = null;

    #[vich\UploadableField(mapping: 'products', fileNameProperty: 'attachment')]
    private ?File $attachmentFile = null;

    #[ORM\Column(nullable: true)]
    private ?int $imageSize = null;

    #[ORM\ManyToOne(inversedBy: 'picture')]
    private ?Property $property = null;

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getAttachment(): ?string
    {
        return $this->attachment;
    }

    public function setAttachment(?string $attachment): void
    {
        $this->attachment = $attachment;
    }

    public function getAttachmentFile(): ?File
    {
        return $this->attachmentFile;
    }

    public function setAttachmentFile(?File $attachmentFile = null): void
    {
        $this->attachmentFile = $attachmentFile;

        if (null !== $attachmentFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function setImageSize(?int $imageSize): void
    {
        $this->imageSize = $imageSize;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }

    public function getProperty(): ?Property
    {
        return $this->property;
    }

    public function setProperty(?Property $property): static
    {
        $this->property = $property;

        return $this;
    }

}
