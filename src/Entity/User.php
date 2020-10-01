<?php

namespace App\Entity;

use App\Repository\UserRepository;
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
}
