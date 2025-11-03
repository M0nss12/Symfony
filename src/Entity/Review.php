<?php

namespace App\Entity;

use App\Repository\ReviewRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReviewRepository::class)]
class Review
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Customer $customer = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Camera $camera = null;

    #[ORM\Column]
    private ?int $rating = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $comment = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $review_date = null;

    #[ORM\Column(length: 100)]
    private ?string $title = null;

    #[ORM\Column]
    private ?bool $is_verified_purchase = null;

    #[ORM\Column(nullable: true)]
    private ?int $image_quality_rating = null;

    #[ORM\Column(nullable: true)]
    private ?int $ease_of_use_rating = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    public function __construct()
    {
        $this->review_date = new \DateTime();
        $this->created_at = new \DateTime();
        $this->is_verified_purchase = false;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): static
    {
        $this->customer = $customer;
        return $this;
    }

    public function getCamera(): ?Camera
    {
        return $this->camera;
    }

    public function setCamera(?Camera $camera): static
    {
        $this->camera = $camera;
        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): static
    {
        $this->rating = $rating;
        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): static
    {
        $this->comment = $comment;
        return $this;
    }

    public function getReviewDate(): ?\DateTimeInterface
    {
        return $this->review_date;
    }

    public function setReviewDate(\DateTimeInterface $review_date): static
    {
        $this->review_date = $review_date;
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

    public function isIsVerifiedPurchase(): ?bool
    {
        return $this->is_verified_purchase;
    }

    public function setIsVerifiedPurchase(bool $is_verified_purchase): static
    {
        $this->is_verified_purchase = $is_verified_purchase;
        return $this;
    }

    public function getImageQualityRating(): ?int
    {
        return $this->image_quality_rating;
    }

    public function setImageQualityRating(?int $image_quality_rating): static
    {
        $this->image_quality_rating = $image_quality_rating;
        return $this;
    }

    public function getEaseOfUseRating(): ?int
    {
        return $this->ease_of_use_rating;
    }

    public function setEaseOfUseRating(?int $ease_of_use_rating): static
    {
        $this->ease_of_use_rating = $ease_of_use_rating;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): static
    {
        $this->created_at = $created_at;
        return $this;
    }

    public function getStarRating(): string
    {
        return str_repeat('★', $this->rating) . str_repeat('☆', 5 - $this->rating);
    }

    public function __toString(): string
    {
        return $this->title . ' - ' . $this->rating . '/5';
    }
}