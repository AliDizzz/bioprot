<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="float")
     */
    private $tva;

    /**
     * @ORM\Column(type="integer")
     */
    private $rateTva;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPaid;

    /**
     * @ORM\Column(type="datetime")
     */
    private $deliveryDate;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="userOrder")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=OrderLine::class, mappedBy="newOrder")
     */
    private $orderLine;

    /**
     * @ORM\ManyToOne(targetEntity=Address::class, inversedBy="orderAddress")
     */
    private $address;

    public function __construct()
    {
        $this->orderLine = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getTva(): ?float
    {
        return $this->tva;
    }

    public function setTva(float $tva): self
    {
        $this->tva = $tva;

        return $this;
    }

    public function getRateTva(): ?int
    {
        return $this->rateTva;
    }

    public function setRateTva(int $rateTva): self
    {
        $this->rateTva = $rateTva;

        return $this;
    }

    public function getIsPaid(): ?bool
    {
        return $this->isPaid;
    }

    public function setIsPaid(bool $isPaid): self
    {
        $this->isPaid = $isPaid;

        return $this;
    }

    public function getDeliveryDate(): ?\DateTimeInterface
    {
        return $this->deliveryDate;
    }

    public function setDeliveryDate(\DateTimeInterface $deliveryDate): self
    {
        $this->deliveryDate = $deliveryDate;

        return $this;
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

    /**
     * @return Collection|OrderLine[]
     */
    public function getOrderLine(): Collection
    {
        return $this->orderLine;
    }

    public function addOrderLine(OrderLine $orderLine): self
    {
        if (!$this->orderLine->contains($orderLine)) {
            $this->orderLine[] = $orderLine;
            $orderLine->setNewOrder($this);
        }

        return $this;
    }

    public function removeOrderLine(OrderLine $orderLine): self
    {
        if ($this->orderLine->contains($orderLine)) {
            $this->orderLine->removeElement($orderLine);
            // set the owning side to null (unless already changed)
            if ($orderLine->getNewOrder() === $this) {
                $orderLine->setNewOrder(null);
            }
        }

        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): self
    {
        $this->address = $address;

        return $this;
    }
}
