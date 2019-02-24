<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(
 * fields={"email"}, message ="this email is already used / L'email saisi est déjà utilisé",
 * fields={"username"}, message ="this Username is already used / Le Nom d'Utilisateur saisi est déjà utilisé")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="8", minMessage="Your password should have minimum 8 caracters / Le mot de passe doit comporter un minimum de 8 caractères.")
     */
    private $password;
    
    /**
     *@Assert\EqualTo(propertyPath="$pwd2", message="You've done a mistake between password and its confirmation / Le mot de passe et sa confirmation doivent être identiques.")
     */
    private $confirmPassword;
    //pwd2 is just declared, we doesn't persist, it is just to have only 
    //variable password (will be encoded (hash)) in our database
    //keeping 2 passwords doesn't interesting 

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

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
        
    //UserInterface's implementation
    //getPassword : exist in our class because we have a password field
    public function eraseCredentials(){}
    public function getSalt(){}    
    public function getRoles(){        
        return['ROLE_USER'];
    }

    
    
}
