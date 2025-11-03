<?php

namespace App\Entity;

use App\Repository\CameraRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CameraRepository::class)]
class Camera
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $model = null;

    #[ORM\Column(length: 100)]
    private ?string $brand = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $price = null;

    #[ORM\Column]
    private ?int $megapixels = null;

    #[ORM\Column(length: 50)]
    private ?string $sensor_type = null;

    #[ORM\Column]
    private ?bool $wifi = null;

    #[ORM\Column]
    private ?bool $bluetooth = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $stock_quantity = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    public function __construct()
    {
        $this->created_at = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): static
    {
        $this->model = $model;
        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): static
    {
        $this->brand = $brand;
        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;
        return $this;
    }

    public function getMegapixels(): ?int
    {
        return $this->megapixels;
    }

    public function setMegapixels(int $megapixels): static
    {
        $this->megapixels = $megapixels;
        return $this;
    }

    public function getSensorType(): ?string
    {
        return $this->sensor_type;
    }

    public function setSensorType(string $sensor_type): static
    {
        $this->sensor_type = $sensor_type;
        return $this;
    }

    public function isWifi(): ?bool
    {
        return $this->wifi;
    }

    public function setWifi(bool $wifi): static
    {
        $this->wifi = $wifi;
        return $this;
    }

    public function isBluetooth(): ?bool
    {
        return $this->bluetooth;
    }

    public function setBluetooth(bool $bluetooth): static
    {
        $this->bluetooth = $bluetooth;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;
        return $this;
    }

    public function getStockQuantity(): ?int
    {
        return $this->stock_quantity;
    }

    public function setStockQuantity(int $stock_quantity): static
    {
        $this->stock_quantity = $stock_quantity;
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

    public function __toString(): string
    {
        return $this->brand . ' ' . $this->model;
    }
}