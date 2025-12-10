<?php

namespace App\Http\Controllers;

use App\Models\StoreBalance;
use App\Models\StoreBalanceHistory;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class SellerWithdrawalController extends Controller
{
    public function index(Request $request)
    {
        $user  = $request->user();
        $store = $user->store()->with('balance.withdrawals')->firstOrFail();

        $balance = $store->balance;

        if (!$balance) {
            $balance = StoreBalance::create([
                'store_id' => $store->id,
                'balance'  => 0,
            ]);

            $store->setRelation('balance', $balance);
        }

        $withdrawals = $balance->withdrawals()->orderByDesc('created_at')->get();

        return view('seller.withdrawals.index', compact('store', 'balance', 'withdrawals'));
    }

    public function store(Request $request)
    {
        $user  = $request->user();
        $store = $user->store()->with('balance')->firstOrFail();
        $balance = $store->balance;

        if (!$balance) {
            $balance = StoreBalance::create([
                'store_id' => $store->id,
                'balance'  => 0,
            ]);

            $store->setRelation('balance', $balance);
        }

        $data = $request->validate([
            'amount'              => 'required|numeric|min:1',
            'bank_account_name'   => 'required|string|max:255',
            'bank_account_number' => 'required|string|max:50',
            'bank_name'           => 'required|string|max:255',
        ]);

        if ($data['amount'] > $balance->balance) {
            return back()
                ->withErrors(['amount' => 'Saldo toko tidak mencukupi untuk penarikan.'])
                ->withInput();
        }

        $data['store_balance_id'] = $balance->id;
        $data['status']           = 'pending';

        $withdrawal = Withdrawal::create($data);

        $balance->decrement('balance', $data['amount']);

        StoreBalanceHistory::create([
            'store_balance_id' => $balance->id,
            'type'             => 'withdraw',
            'reference_id'     => $withdrawal->id,
            'reference_type'   => Withdrawal::class,
            'amount'           => -$data['amount'],
            'remarks'          => 'Pengajuan penarikan saldo',
        ]);

        return redirect()
            ->route('seller.withdrawals.index')
            ->with('success', 'Pengajuan penarikan dana berhasil diajukan.');
    }
}