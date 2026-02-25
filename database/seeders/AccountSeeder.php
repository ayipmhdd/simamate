<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = \App\Models\User::all();
        $defaultAccounts = ['Cash', 'Dana', 'SeaBank', 'GoPay'];

        foreach ($users as $user) {
            if ($user->accounts()->count() === 0) {
                foreach ($defaultAccounts as $acc) {
                    $user->accounts()->create([
                        'account_name' => $acc,
                        'balance' => 0
                    ]);
                }
            }
        }
    }
}
