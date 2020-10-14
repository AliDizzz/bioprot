<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(
 * fields={"email"},
 * message="ce compte existe déjà !!! GRrrr...!!!")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *  min = 3,
     *  max = 100,
     *  minMessage = "Votre prénom doit faire au minimum {{ limit }} caractères",
     *  maxMessage = "Votre prénom doit faire au maximum {{ limit }} caractères",
     *  allowEmptyString = false
     * )
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *  min = 3,
     *  max = 100,
     *  minMessage = "Votre nom doit faire au minimum {{ limit }} caractères",
     *  maxMessage = "Votre nom doit faire au maximum {{ limit }} caractères",
     *  allowEmptyString = false
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(
     *  message = "l'email '{{ value }}' n'est pas valide.",
     * checkMX=true
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *  min = 10,
     *  max = 20,
     *  minMessage = "Votre mot de passe doit faire au minimum {{ limit }} caractères",
     *  maxMessage = "Votre mot de passe doit faire au maximum {{ limit }} caractères",
     *  allowEmptyString = false
     * )
     * @Assert\Regex(
     *     pattern="/^(?=.{10,}$)(?=.*?[a-z])(?=.*?[A-Z])(?=.*?[0-9])(?=.*?\W).*$/",
     *     match=true,
     *     message="Le mot de passe doit contenir au moins 1 majuscule 1 chiffre et 1 caractère spécial"
     * )
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $roles;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hasAcceptedCondition;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $hasSubscribedNewsletter;

    /**
     * @ORM\ManyToOne(targetEntity=Newsletter::class, inversedBy="users")
     */
    private $newsletter;

    /**
     * @ORM\OneToMany(targetEntity=Order::class, mappedBy="user")
     */
    private $userOrder;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="user")
     */
    private $comment;

    public function __construct()
    {
        $this->comment = new ArrayCollection();
        $this->userOrder = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles()
    {
        return [$this->roles];
    }

    public function setRoles(string $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getHasAcceptedCondition(): ?bool
    {
        return $this->hasAcceptedCondition;
    }

    public function setHasAcceptedCondition(bool $hasAcceptedCondition): self
    {
        $this->hasAcceptedCondition = $hasAcceptedCondition;

        return $this;
    }

    public function getHasSubscribedNewsletter(): ?bool
    {
        return $this->hasSubscribedNewsletter;
    }

    public function setHasSubscribedNewsletter(?bool $hasSubscribedNewsletter): self
    {
        $this->hasSubscribedNewsletter = $hasSubscribedNewsletter;

        return $this;
    }

    public function eraseCredentials()
    {
    }

    public function getSalt()
    {
    }

    public function getUsername()
    {
    }

    public function getNewsletter(): ?Newsletter
    {
        return $this->newsletter;
    }

    public function setNewsletter(?Newsletter $newsletter): self
    {
        $this->newsletter = $newsletter;

        return $this;
    }

    /**
     * @return Collection|Order[]
     */
    public function getUserOrder(): Collection
    {
        return $this->userOrder;
    }

    public function addUserOrder(Order $userOrder): self
    {
        if (!$this->userOrder->contains($userOrder)) {
            $this->userOrder[] = $userOrder;
            $userOrder->setUser($this);
        }

        return $this;
    }

    public function removeUserOrder(Order $userOrder): self
    {
        if ($this->userOrder->contains($userOrder)) {
            $this->userOrder->removeElement($userOrder);
            // set the owning side to null (unless already changed)
            if ($userOrder->getUser() === $this) {
                $userOrder->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComment(): Collection
    {
        return $this->comment;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comment->contains($comment)) {
            $this->comment[] = $comment;
            $comment->setUser($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comment->contains($comment)) {
            $this->comment->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getUser() === $this) {
                $comment->setUser(null);
            }
        }

        return $this;
    }
}
