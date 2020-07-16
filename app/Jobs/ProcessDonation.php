<?php

namespace App\Jobs;

use App\Deposit;
use App\Donation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessDonation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $donation;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Donation $donation)
    {
        $this->donation = $donation;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $totalDeposits = Deposit::where('user_id', $this->donation->user_id)->sum('amount');
        $totalDonations = Donation::where('user_id', $this->donation->user_id)->sum('amount');
        $balance = $totalDeposits - $totalDonations;

        if ($this->donation->amount > $balance) {
            return response()->json([
                'success' => false,
                'message' => 'INSUFFICIENT_FUNDS'
            ], 200);
        }

        if (!$this->donation->save()) {
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
}
