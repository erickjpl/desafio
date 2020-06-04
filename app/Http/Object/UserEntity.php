<?php

namespace App\Http\Object;

use App\User;
use App\Publication;
use \Illuminate\Http\Response;

class UserEntity
{
    private $id;
    private $name;
    private $lastname;
    private $full_name;
    private $email;
    private $password;
    private $relation_publications;

    public function __construct(User $user)
    {
        $this->id        = $user->id;
        $this->name      = $user->name;
        $this->lastname  = $user->lastname;
        $this->full_name = $user->full_name;
        $this->email     = $user->email;

        $this->relation_publications = collect();
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

    public function addPublication(Publication $publication)
    {
        if( ! $this->relation_publications->contains($publication) ) {
            $this->relation_publications->add($publication);
        }
    }

    public function setPublications($publications) {
        $this->relation_publications = $publications;
    }

    public function getPublications()
    {
        return $this->relation_publications;
    }

    public function toResponse()
    {
        $response = array(
            'id'           => $this->getId(),
            'full_name'    => $this->getFullName(),
            'email'        => $this->getEmail(),
        );

        if ( $this->getPublications()->isNotEmpty() )
            $response['publications'] = $this->getPublications();

        return $response;
    }
}
