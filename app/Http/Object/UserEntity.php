<?php

namespace App\Http\Object;

use App\User;
use \Illuminate\Http\Response;

class UserEntity
{
    private $id;
    private $name;
    private $lastname;
    private $full_name;
    private $email;
    private $password;

    public function __construct(User $user)
    {
        $this->id = $user->id;
        $this->name = $user->name;
        $this->lastname  = $user->lastname;
        $this->full_name  = $user->full_name;
        $this->email  = $user->email;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFullName()
    {
        return $this->full_name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function toResponse()
    {
        return array(
            'id'        => $this->getId(),
            'full_name' => $this->getFullName(),
            'email'     => $this->getEmail()
        );
    }
}
