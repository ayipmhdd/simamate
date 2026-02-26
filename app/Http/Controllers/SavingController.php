<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Saving;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SavingController extends Controller
{
    public function index()
    {
        $savings = Saving::where('user_id', Auth::id())->get();
        return view('features.dompet.tabungan', compact('savings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:1',
            'target_date' => 'nullable|date',
            'image' => 'nullable|image|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('savings', 'public');
        }

        Saving::create([
            'user_id' => Auth::id(),
            'item_name' => $request->item_name,
            'target_amount' => $request->target_amount,
            'current_amount' => 0,
            'target_date' => $request->target_date,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('savings.index')->with('success', 'Wishlist berhasil ditambahkan!');
    }

    public function addFunds(Request $request, Saving $saving)
    {
        if ($saving->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'amount' => 'required|numeric|min:1',
            'account_type' => 'required|string|max:255',
            'other_account' => 'required_if:account_type,Lainnya|string|max:255|nullable',
            'transaction_date' => 'required|date',
            'transaction_time' => 'nullable|date_format:H:i',
        ]);

        $accountName = $request->account_type === 'Lainnya' ? $request->other_account : $request->account_type;

        $saving->current_amount += $request->amount;
        $saving->save();

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Update Saldo Account (Deduct)
        $account = $user->accounts()->firstOrCreate(
            ['account_name' => $accountName],
            ['balance' => 0]
        );
        $account->balance -= $request->amount;
        $account->save();

        // Handle Date Time
        $transactionDate = \Carbon\Carbon::parse($request->transaction_date);
        if ($request->filled('transaction_time')) {
            $transactionDate->setTimeFromTimeString($request->transaction_time);
        } else {
            $transactionDate->setTimeFrom(now());
        }

        // Catat sebagai Pengeluaran
        Transaction::create([
            'user_id' => $user->id,
            'type' => 'pengeluaran',
            'category' => 'Tabungan',
            'account_type' => $accountName,
            'amount' => $request->amount,
            'transaction_date' => $transactionDate,
            'description' => 'Menabung untuk ' . $saving->item_name,
        ]);

        return redirect()->route('savings.index')->with('success', 'Berhasil memindahkan saldo ke tabungan impian!');
    }

    public function destroy(Saving $saving)
    {
        if ($saving->user_id !== Auth::id()) {
            abort(403);
        }

        if ($saving->image_path) {
            Storage::disk('public')->delete($saving->image_path);
        }

        $saving->delete();

        return redirect()->route('savings.index')->with('success', 'Wishlist berhasil dihapus!');
    }
}
