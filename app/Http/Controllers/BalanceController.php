<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Deposit;
use App\Donation;

class BalanceController extends Controller
{

    public function get_user_balance($user_id) {

        $totalDeposits = Deposit::where('user_id', $user_id)->sum('amount');
        $totalDonations = Donation::where('user_id', $user_id)->sum('amount');

        return response()->json([
            'success' => true,
            'message' => 'FOUND',
            'data' => [
                'balance' => $totalDeposits - $totalDonations
            ]
        ]);

    }

}
