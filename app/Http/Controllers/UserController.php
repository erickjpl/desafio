<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\UserRepository;

class UserController extends Controller
{
    private $repository;

    public function __construct(UserRepository $userRepository)
    {
        $this->repository = $userRepository;
    }

    public function getUsers(Request $request) {
        try {
            $entity = $this->repository->all(
                $request->except(['limit']),
                $request->get('limit')
            );

            if ( $entity->isEmpty() )
                return response()->json([ "data" => 'No data was obtained ..!' ], 201);
            
            return response()->json([ "data" => $entity ], 200);
        } catch(\Exception $e) {
            throw new \App\Exceptions\CustomException();
        }
    }
}
