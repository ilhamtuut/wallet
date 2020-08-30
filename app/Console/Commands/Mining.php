<?php

namespace App\Console\Commands;

use Ixudra\Curl\Facades\Curl;
use Illuminate\Console\Command;

class Mining extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mining:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mining Coin';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $address = '91eec562f6f734540455a3f91db31a3c45f55b2c54858e71f51c29a8fcfce699';
        $response = Curl::to('http://mumbai.solusi.cloud:3001/miner/mine')
            ->withData([
                'rewardAddress' => $address,
                'feeAddress' => $address
            ])
            ->withHeader('Content-Type: application/json')
            ->asJson()
            ->post();
        return $response;
    }
}
