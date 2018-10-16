<?php

namespace App\Jobs;

use App\Currency;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class PurchasePodcast implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
        //
    }

    public function handle()
    {
        $result = Currency::get_currencies();
        $data = [
            'topic_id' => 'currency_list',
            'data' => json_encode($result)
        ];

        \App\Classes\Socket\Pusher::sendDataToServer($data);

        $this->delete();
        $this->release(15);
    }
}
