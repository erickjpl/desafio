<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Data\UserRepository;

class UserController extends Controller
{
    /** @var  UserRepository */
    private $repository;

    public function __construct(UserRepository $userRepository)
    {
        $this->repository = $userRepository;
    }

    public function getUsers(Request $request) 
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

    public function getPublicationUser($id) 
    {
        try {
            if (\Auth::id() == $id)
                $entity = new User();

            $entity = $entity->getPublicationsUser();

            if ( ! $entity )
                return response()->json([ "data" => 'No data was obtained ..!' ], 201);
            
            return response()->json([ "data" => $entity ], 200);
        } catch(\Exception $e) {
            throw new \App\Exceptions\CustomException($e->getMessage());
        }
    }
}
