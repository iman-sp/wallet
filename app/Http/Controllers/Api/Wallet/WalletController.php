<?php

namespace App\Http\Controllers\Api\Wallet;

use App\Http\Controllers\Controller;
use App\Http\Resources\Wallet\WalletResource;
use App\Repositories\WalletRepository;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function __construct(protected WalletRepository $walletRepository)
    {
        
    }
    /**
     * @OA\Get(
     * path="/wallet",
     * operationId="getUserWalletInfo",
     * tags={"Wallet"},
     * summary="Get wallet info",
     * security={ {"sanctum": {} }},
     *         @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Examples(example="response", value={"success":true,"message":"Wallet credit","data":{"credit":0}}, summary="A response"),
     *          )
     *       ),
     * )
     */
    public function show()
    {
        $user = auth()->user();
        $wallet = $this->walletRepository->show($user);
        return $this->sendSuccess('Wallet credit', new WalletResource($wallet));
    }
}
