<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\ValidateCredentialsRequest;
use App\Http\Resources\User\UserResource;
use App\Repositories\UserRepository;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(protected UserRepository $userRepository)
    {
        
    }

    /**
     * @OA\Post(
     * path="/auth/validate",
     * operationId="authenticateUser",
     * tags={"Auth"},
     * summary="Authenticate user",
     * description="Authenticate user using credentials",
     * @OA\RequestBody(
     *    required=true,
     *    @OA\JsonContent(
     *       required={"phone", "password"},
     *       @OA\Property(property="email", type="string", format="string", example="test@domain.tld"),
     *       @OA\Property(property="password", type="string", format="string", example="12345678"),
     *    ),
     * ),
     *         @OA\Response(
     *          response=200,
     *          description="User authenticated",
     *          @OA\JsonContent(
     *              @OA\Examples(example="response", value={"success":true,"message":"User logged in","data":{"user":{"id":2,"name":"test","username":"4example","email":"test@test.test","updated_at":"2024-08-10T12:30:02.000000Z","created_at":"2024-08-10T12:30:02.000000Z"},"token":"6|ugDdVEoLs1TM2AtGbwAPR2B0z1nLHerNYyU6Nisfsdfe"}}, summary="A response"),
     *          )
     *       ),
     *         @OA\Response(
     *          response=403,
     *          description="invalid credentials",
     *          @OA\JsonContent(
     *              @OA\Examples(example="response", value={"success":false,"message":"Credentials not valid! Please try again.","data":{}}, summary="A response"),
     *          )
     *       ),
     * )
     */
    public function validateCredentials(ValidateCredentialsRequest $request)
    {
        if ($this->userRepository->attempt($request->email, $request->password, $request)) {
            $user = $this->userRepository->findByEmail($request->email);
            return $this->sendSuccess('User logged in', [
                'user' => new UserResource($user),
                'token' => $user->createToken('token')->plainTextToken,
            ]);
        }
        return $this->sendError('Credentials not valid! Please try again.', [], 403);
    }
}
