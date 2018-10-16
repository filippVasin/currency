<?php

namespace App\Http\Controllers;

use App\Currency;
use App\Jobs\PurchasePodcast;
use App\Jobs\SocketPusher;
use Illuminate\Support\Facades\DB;

class CurrancyController extends Controller
{

    use \Illuminate\Foundation\Bus\DispatchesJobs;

    public function index()
    {
       self::subscribe_topic();
       $currencies = Currency::get_currencies();
       return view('currencies', ['currencies' => $currencies]);
    }


    public function get_currencies()
    {
        self::subscribe_topic();
        $res['status'] = 'oK';
        $res['time'] = time();
        return json_encode($res);
    }

    private function subscribe_topic()
    {
        DB::table('jobs')
            ->where('payload', 'like', '%PurchasePodcast%')
            ->delete();

        $this->dispatch(
            new PurchasePodcast()
        );
    }
}