<?php

namespace App\Http\Controllers\Api\Transaction;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Transaction\TransactionStoreRequest;
use App\Http\Resources\Transaction\TransactionResource;
use App\Repositories\TransactionRepository;
use App\Repositories\WalletRepository;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct(protected TransactionRepository $transactionRepository, protected WalletRepository $walletRepository)
    {
        
    }

    /**
     * @OA\Get(
     * path="/transaction",
     * operationId="getTransactionsList",
     * tags={"Transaction"},
     * summary="Get all transactions",
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
    public function index()
    {
        $user = auth()->user();
        $transactions = $this->transactionRepository->all($user);
        return $this->sendSuccess('Transactions list', [
            'transactions' => TransactionResource::collection($transactions),
        ]);
    }

    /**
     * @OA\Post(
     * path="/transaction/",
     * operationId="createTransaction",
     * tags={"Transaction"},
     * summary="Create transaction",
     * description="Deposit into wallet or withdraw from wallet",
     * security={ {"sanctum": {} }},
     * @OA\RequestBody(
     *    required=true,
     *    @OA\JsonContent(
     *       required={"amount", "type"},
     *       @OA\Property(property="amount", type="string", format="string", example="8000"),
     *       @OA\Property(property="type", type="string", format="enum", example="deposit|withdraw"),
     *       @OA\Property(property="description", type="string", format="string", example="This is test description"),
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
    public function store(TransactionStoreRequest $request)
    {
        $user = auth()->user();
        switch ($request->type) {
            case 'deposit':
                $transaction = $this->transactionRepository->create($user, $request->validated());
                $this->walletRepository->deposit($user, $request->amount);
                return $this->sendSuccess('Transaction created successfully', new TransactionResource($transaction));
                break;
            case 'withdraw':
                if ($this->walletRepository->checkCredit($user, $request->amount)) {
                    $transaction = $this->transactionRepository->create($user, $request->validated());
                    $this->walletRepository->Withdraw($user, $request->amount);
                    return $this->sendSuccess('Transaction created successfully', new TransactionResource($transaction));
                } else {
                    return $this->sendError('Not enough credit!');
                }
                break;
        }
    }
}
