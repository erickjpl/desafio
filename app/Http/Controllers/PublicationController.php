<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Data\PublicationRepository;

class PublicationController extends Controller
{
    private $repository;

    public function __construct(PublicationRepository $userRepository)
    {
        $this->repository = $userRepository;
    }

    public function getPublications(Request $request) 
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

    public function getPublication($id) 
    {
        try {
            $entity = $this->repository->find($id, true);

            if ( ! $entity )
                return response()->json([ "data" => 'No data was obtained ..!' ], 201);
            
            return response()->json([ "data" => $entity ], 200);
        } catch(\Exception $e) {
            throw $e;
            
            throw new \App\Exceptions\CustomException($e->getMessage());
        }
    }
}
