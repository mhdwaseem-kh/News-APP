<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Requests\AuthRequests\LoginUserRequest;
use App\Http\Requests\AuthRequests\RegisterUserRequest;
use App\Http\Resources\UserResources\UserResource;
use App\Messaging\Response;
use App\Services\UserServices\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{

    /** @var UserService */
    private UserService $service;

    /**
     * Create a new UserService instance.
     *
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * @param LoginUserRequest $request
     * @return JsonResponse
     */
    public function login(LoginUserRequest $request)
    {
        $credentials = $request->all(['email', 'password']);

        if (Auth::attempt($credentials)) {
            // Authentication was successful, issue a token
            $user = Auth::user(); // Get the authenticated user

            $token = $user->createToken(config('app.name'))->accessToken; // Issue a Passport token

            return $this->respondWithToken($token);
        }
        return response()->json(new Response(null, 'Wrong credentials.'), 401);
    }


    /**
     * @param string $token
     * @return JsonResponse
     */
    protected function respondWithToken(string $token)
    {
        return $this->ok([
            'access_token' => $token,
            'token_type' => 'bearer',
        ]);
    }


    /**
     * @param RegisterUserRequest $request
     * @return JsonResponse
     */
    public function register(RegisterUserRequest $request)
    {
        $data = $request->all();


        $newUser = $this->service->addUser(data: $data);

        return $this->ok(new UserResource($newUser));
    }


    /**
     * @return JsonResponse
     */
    public function me()
    {
        return $this->ok(new UserResource(auth()->user()));
    }


    /**
     * @return JsonResponse
     */
    public function logout()
    {
        auth()->user()->token()->revoke();
        return $this->ok(null, 'Successfully logged out.');
    }

}
