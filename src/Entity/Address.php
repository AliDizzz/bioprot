<?php

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AddressRepository::class)
 */
class Address
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="integer")
     */
    private $postCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phone;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isInvoiceAddress;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isDeliveryAddress;

    /**
     * @ORM\OneToMany(targetEntity=order::class, mappedBy="address")
     */
    private $orderAddress;

    public function __construct()
    {
        $this->orderAddress = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPostCode(): ?int
    {
        return $this->postCode;
    }

    public function setPostCode(int $postCode): self
    {
        $this->postCode = $postCode;

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

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getIsInvoiceAddress(): ?bool
    {
        return $this->isInvoiceAddress;
    }

    public function setIsInvoiceAddress(?bool $isInvoiceAddress): self
    {
        $this->isInvoiceAddress = $isInvoiceAddress;

        return $this;
    }

    public function getIsDeliveryAddress(): ?bool
    {
        return $this->isDeliveryAddress;
    }

    public function setIsDeliveryAddress(?bool $isDeliveryAddress): self
    {
        $this->isDeliveryAddress = $isDeliveryAddress;

        return $this;
    }

    /**
     * @return Collection|order[]
     */
    public function getOrderAddress(): Collection
    {
        return $this->orderAddress;
    }

    public function addOrderAddress(order $orderAddress): self
    {
        if (!$this->orderAddress->contains($orderAddress)) {
            $this->orderAddress[] = $orderAddress;
            $orderAddress->setAddress($this);
        }

        return $this;
    }

    public function removeOrderAddress(order $orderAddress): self
    {
        if ($this->orderAddress->contains($orderAddress)) {
            $this->orderAddress->removeElement($orderAddress);
            // set the owning side to null (unless already changed)
            if ($orderAddress->getAddress() === $this) {
                $orderAddress->setAddress(null);
            }
        }

        return $this;
    }
}
