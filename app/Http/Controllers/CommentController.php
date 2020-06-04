<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Data\CommentRepository;
use App\Http\Requests\CreateCommentRequest;

class CommentController extends Controller
{
    private $repository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->repository = $commentRepository;
    }

    public function getComments(Request $request) 
    {
        try {
            $entity = $this->repository->all(
                $request->except(['limit']),
                $request->get('limit')
            );

            if ( $entity->isEmpty() )
                return response()->json([ "data" => 'No data was obtained ..!' ], 201);
            
            return response()->json([ "data" => $entity ], 200);
        } catch(\Exception $e) {
            throw new \App\Exceptions\CustomException($e->getMessage());
        }
    }

    public function addComment(CreateCommentRequest $request) 
    {
        try {
            $entity = $this->repository->create( $request->all() );

            if ( ! $entity )
                return response()->json([ "data" => 'No data was obtained ..!' ], 201);
            
            return response()->json([ "data" => $entity ], 200);
        } catch(\Exception $e) {
            throw new \App\Exceptions\CustomException($e->getMessage());
        }
    }
}
