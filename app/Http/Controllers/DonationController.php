<?php

namespace App\Http\Controllers;

use App\Deposit;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Donation;

class DonationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        //ADD VALIDATION

        $totalDeposits = Deposit::where('user_id', $request->user_id)->sum('amount');
        $totalDonations = Donation::where('user_id', $request->user_id)->sum('amount');
        $balance = $totalDeposits - $totalDonations;

        if ($request->amount > $balance) {
            return response()->json([
                'success' => false,
                'message' => 'INSUFFICIENT_FUNDS'
            ], 200);
        }

        $donation = new Donation();
        $donation->org_id = $request->org_id;
        $donation->user_id = $request->user_id;
        $donation->amount = $request->amount;
        $donation->status = 'pending';

        if (!$donation->save()) {
            return response()->json([
                'success' => false,
                'message' => 'DONATION_FAILED'
            ], 200);
        }

        return response()->json([
            'success' => true,
            'message' => 'DONATION_RECIEVED'
        ], 200);

    }

    public function get_donations_by_user($userId) {

        if (!$userId) {
            return response()->json([
                'success' => false,
                'message' => 'NO_USER_ID'
            ], 200);
        }

        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'USER_NOT_FOUND'
            ], 200);
        }

        $donations = Donation::with('org')->where('user_id', $userId)->orderBy('created_at', 'DESC')->get();

        return response()->json([
            'success' => true,
            'message' => 'FOUND',
            'data' => [
                'donations' => $donations
            ]
        ]);



    }

}
