<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
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
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $hash;

    /**
     * @ORM\OneToMany(targetEntity=PrivateMessage::class, mappedBy="sender")
     */
    private $sender;

    /**
     * @ORM\OneToMany(targetEntity=PrivateMessage::class, mappedBy="recipient")
     */
    private $receiver;

    public function __construct()
    {
        $this->sender = new ArrayCollection();
        $this->receiver = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getHash(): ?string
    {
        return $this->hash;
    }

    public function setHash(string $hash): self
    {
        $this->hash = $hash;

        return $this;
    }
    
    public function getRoles(){
        return ['ROLE_ADMIN'];
    }

    public function getPassword(){
        return $this->hash;
    }

    public function getSalt(){
    
    }

    public function getUsername(){
        return $this->login;
    }

    public function eraseCredentials(){

    }

    /**
     * @return Collection<int, PrivateMessage>
     */
    public function getSender(): Collection
    {
        return $this->sender;
    }

    public function addSender(PrivateMessage $sender): self
    {
        if (!$this->sender->contains($sender)) {
            $this->sender[] = $sender;
            $sender->setSender($this);
        }

        return $this;
    }

    public function removeSender(PrivateMessage $sender): self
    {
        if ($this->sender->removeElement($sender)) {
            // set the owning side to null (unless already changed)
            if ($sender->getSender() === $this) {
                $sender->setSender(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PrivateMessage>
     */
    public function getReceiver(): Collection
    {
        return $this->receiver;
    }

    public function addReceiver(PrivateMessage $receiver): self
    {
        if (!$this->receiver->contains($receiver)) {
            $this->receiver[] = $receiver;
            $receiver->setRecipient($this);
        }

        return $this;
    }

    public function removeReceiver(PrivateMessage $receiver): self
    {
        if ($this->receiver->removeElement($receiver)) {
            // set the owning side to null (unless already changed)
            if ($receiver->getRecipient() === $this) {
                $receiver->setRecipient(null);
            }
        }

        return $this;
    }
}
