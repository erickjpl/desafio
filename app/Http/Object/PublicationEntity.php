<?php

namespace App\Http\Object;

use App\Publication;
use \Illuminate\Http\Response;

class PublicationEntity
{
    private $id;
    private $title;
    private $content;
    private $user_id;
    private $relation_comments;

    public function __construct(Publication $publication)
    {
        $this->id = $publication->id;
        $this->title = $publication->title;
        $this->content  = $publication->content;
        $this->user_id  = $publication->user_id;

        $this->relation_comments = collect();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function addComment(Comment $comment)
    {
        if( ! $this->relation_comments->contains($comment) ) {
            $this->relation_comments->add($comment);
        }
    }

    public function setComments($comments) {
        $this->relation_comments = $comments;
    }

    public function getComments()
    {
        return $this->relation_comments;
    }

    public function toResponse()
    {
        $response = array(
            'id'      => $this->getId(),
            'title'   => $this->getTitle(),
            'content' => $this->getContent(),
            'user_id' => $this->getUserId()
        );
        
        if ( $this->getComments()->isNotEmpty() )
            $response['comments'] = $this->getComments();

        return $response;
    }
}
