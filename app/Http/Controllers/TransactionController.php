<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Get recent transactions
        $transactions = Transaction::where('user_id', $user->id)
            ->orderBy('transaction_date', 'desc')
            ->orderBy('id', 'desc')
            ->take(10)
            ->get();

        // Calculate totals
        $pemasukan = Transaction::where('user_id', $user->id)
            ->where('type', 'pemasukan')
            ->sum('amount');

        $pengeluaran = Transaction::where('user_id', $user->id)
            ->where('type', 'pengeluaran')
            ->sum('amount');

        $totalSaldo = $pemasukan - $pengeluaran;

        $accounts = $user->accounts()->get();

        return view('dompet', compact('transactions', 'pemasukan', 'pengeluaran', 'totalSaldo', 'accounts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:pemasukan,pengeluaran',
            'category' => 'required|string|max:255',
            'other_category' => 'required_if:category,Lainnya|string|max:255|nullable',
            'account_type' => 'required|string|max:255',
            'other_account' => 'required_if:account_type,Lainnya|string|max:255|nullable',
            'amount' => 'required|numeric|min:1',
            'transaction_date' => 'required|date',
            'description' => 'nullable|string'
        ]);

        $category = $request->category === 'Lainnya' ? $request->other_category : $request->category;
        $accountName = $request->account_type === 'Lainnya' ? $request->other_account : $request->account_type;

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Update Saldo Account
        $account = $user->accounts()->firstOrCreate(
            ['account_name' => $accountName],
            ['balance' => 0]
        );

        if ($request->type === 'pemasukan') {
            $account->balance += $request->amount;
        } else {
            $account->balance -= $request->amount;
        }
        $account->save();

        Transaction::create([
            'user_id' => $user->id,
            'type' => $request->type,
            'category' => $category,
            'account_type' => $accountName,
            'amount' => $request->amount,
            'transaction_date' => $request->transaction_date,
            'description' => $request->description,
        ]);

        return redirect()->route('dompet.index')->with('success', 'Transaksi berhasil disimpan!');
    }

    public function allHistory()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Ambil semua transaksi user, urutkan berdasarkan tanggal terbaru
        $transactions = Transaction::where('user_id', $user->id)
            ->orderBy('transaction_date', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        // Kelompokkan data berdasarkan Bulan dan Tahun (misal: "Februari 2026")
        $groupedTransactions = $transactions->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->transaction_date)->translatedFormat('F Y');
        });

        $historyData = [];

        foreach ($groupedTransactions as $month => $trans) {
            $pemasukan = $trans->where('type', 'pemasukan')->sum('amount');
            $pengeluaran = $trans->where('type', 'pengeluaran')->sum('amount');
            $selisih = $pemasukan - $pengeluaran;

            $historyData[] = [
                'month' => $month,
                'transactions' => $trans,
                'pemasukan' => $pemasukan,
                'pengeluaran' => $pengeluaran,
                'selisih' => $selisih
            ];
        }

        return view('dompet-riwayat', compact('historyData'));
    }
}
