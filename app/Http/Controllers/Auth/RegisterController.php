<?php

namespace App\Http\Controllers\Auth;

use Response;
use Illuminate\Http\Request;
use App\Mail\RegisterUserMail;
use App\Http\Data\UserRepository;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;

    /** @var  UserRepository */
    private $repository;

    public function __construct(UserRepository $userRepo)
    {
        $this->repository = $userRepo;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function register(CreateUserRequest $request)
    {
        try {
            event(new Registered( $user = $this->repository->create($request->all() )));
            
            #Mail::to($user->email)->send(new RegisterUserMail( $user ));

            return response()->json([ "data" => 'User created successfully' ], 201);
        } catch(Exception $e) {
            throw new \App\Exceptions\CustomException($e->getMessage());
        }
    }
}
