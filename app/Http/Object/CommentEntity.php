<?php

namespace App\Http\Object;

use App\Comment;
use App\Publication;
use \Illuminate\Http\Response;

class CommentEntity
{
    private $id;
    private $content;
    private $status;
    private $publication_id;
    private $created_at;
    private $relation_publication;

    public function __construct(Comment $comment)
    {
        $this->id = $comment->id;
        $this->status = $comment->status;
        $this->content  = $comment->content;
        $this->created_at  = $comment->created_at;
        $this->publication_id  = $comment->publication_id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getPublicationId()
    {
        return $this->publication_id;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setPublication(Publication $publication) {
        $this->relation_publication = $publication;
    }

    public function getPublication()
    {
        return $this->relation_publication;
    }

    public function toResponse()
    {
        $response = array(
            'id'      => $this->getId(),
            'status'   => $this->getstatus(),
            'content' => $this->getContent(),
            'publication_id' => $this->getPublicationId(),
            'created_at' => $this->getCreatedAt()
        );
        
        if ( ! empty( $this->getPublication() ) )
            $response['publication'] = $this->getPublication();

        return $response;
    }
}
