<?php


namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function createTransaction(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);

        $transaction = new Transaction();
        $transaction->order_id = $order->id;
        $transaction->transaction_code = 'TXN' . strtoupper(uniqid());
        $transaction->amount = $order->orderItems->sum('price');
        $transaction->status = 'pending';
        $transaction->transaction_date = now();
        $transaction->save();

        return response()->json($transaction, 201);
    }

    public function updateTransactionStatus(Request $request, $transactionId)
    {
        $transaction = Transaction::findOrFail($transactionId);
        $transaction->status = $request->input('status');
        $transaction->save();

        return response()->json($transaction, 200);
    }

    public function getTransactionHistory($userId)
    {
        $transactions = Transaction::whereHas('order', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();

        return response()->json($transactions, 200);
    }
}
