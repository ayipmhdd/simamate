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

        // Transaksi minggu ini untuk History Dashboard
        $transactions = Transaction::where('user_id', $user->id)
            ->whereBetween('transaction_date', [now()->startOfWeek()->format('Y-m-d'), now()->endOfWeek()->format('Y-m-d')])
            ->latest('transaction_date')
            ->latest('id')
            ->get();

        // Kalkulasi Pemasukan dan Pengeluaran BULAN INI
        $pemasukan = Transaction::where('user_id', $user->id)
            ->where('type', 'pemasukan')
            ->whereMonth('transaction_date', now()->month)
            ->whereYear('transaction_date', now()->year)
            ->sum('amount');

        $pengeluaran = Transaction::where('user_id', $user->id)
            ->where('type', 'pengeluaran')
            ->whereMonth('transaction_date', now()->month)
            ->whereYear('transaction_date', now()->year)
            ->sum('amount');

        // Saldo Kumulatif dari seluruh Akun/Dompet
        $accounts = $user->accounts()->get();
        $totalSaldo = $accounts->sum('balance');

        // Saldo Tabungan yang tersedia
        $savings = \App\Models\Saving::where('user_id', $user->id)
            ->where('current_amount', '>', 0)
            ->get();

        // Nama bulan untuk ditampilkan di view (misal: "Februari")
        $nama_bulan_ini = now()->translatedFormat('F');

        return view('features.dompet.keuangan', compact('transactions', 'pemasukan', 'pengeluaran', 'totalSaldo', 'accounts', 'nama_bulan_ini', 'savings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:pemasukan,pengeluaran',
            'category' => 'required|string|max:255',
            'other_category' => 'required_if:category,Lainnya|string|max:255|nullable',
            'account_type' => 'required|string|max:255',
            'other_account' => 'required_if:account_type,Lainnya|string|max:255|nullable',
            'saving_id' => 'required_if:account_type,Tabungan|nullable|exists:savings,id',
            'destination_account' => 'required_if:account_type,Tabungan|string|max:255|nullable',
            'other_destination' => 'required_if:destination_account,Lainnya|string|max:255|nullable',
            'amount' => 'required|numeric|min:1',
            'transaction_date' => 'required|date',
            'transaction_time' => 'nullable|date_format:H:i',
            'description' => 'nullable|string'
        ]);

        $category = $request->category === 'Lainnya' ? $request->other_category : $request->category;
        $accountName = $request->account_type === 'Lainnya' ? $request->other_account : $request->account_type;

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $description = $request->description;

        // Jika sumber dana adalah Pencairan Tabungan
        if ($accountName === 'Tabungan' && $request->type === 'pemasukan') {
            $saving = \App\Models\Saving::where('id', $request->saving_id)->where('user_id', $user->id)->firstOrFail();

            if ($request->amount > $saving->current_amount) {
                return redirect()->back()->withErrors(['amount' => 'Saldo tabungan tidak mencukupi!']);
            }

            $saving->current_amount -= $request->amount;
            $saving->save();

            $accountName = $request->destination_account === 'Lainnya' ? $request->other_destination : $request->destination_account;
            $description = empty($request->description) ? 'Pencairan Tabungan ' . $saving->item_name : $request->description;
        }

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

        $transactionDate = \Carbon\Carbon::parse($request->transaction_date);

        if ($request->filled('transaction_time')) {
            $timeString = $request->transaction_time;
            // timeString format is typically "H:i", we parse it and set it
            $transactionDate->setTimeFromTimeString($timeString);
        } else {
            // Jika kosong, gunakan waktu saat ini (Asia/Jakarta)
            $transactionDate->setTimeFrom(now());
        }

        Transaction::create([
            'user_id' => $user->id,
            'type' => $request->type,
            'category' => $category,
            'account_type' => $accountName,
            'amount' => $request->amount,
            'transaction_date' => $transactionDate,
            'description' => $description,
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

        return view('features.dompet.riwayat', compact('historyData'));
    }
}
