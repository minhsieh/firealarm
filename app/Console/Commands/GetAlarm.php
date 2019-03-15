<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Cockpit\Services\ParserDom;

class GetAlarm extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'firealarm:getalarm';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Fire alarm';

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
     * @return mixed
     */
    public function handle()
    {
        // Guzzle Curl request
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET','http://www.nrove.tw/api/firealarm.php');
        $html = $response->getBody();

        // Html dom parse
        $dom = new ParserDom($html);

        // Find Alarm imformation
        $tds = $dom->find("table tr[style=\"height: 25px\"]");
        $result = [];
        foreach($tds as $key => $one){
            $two = $one->find("td");
            $result[] = [
                'time' => str_replace ("&nbsp;&nbsp;&nbsp;&nbsp;"," ",$two[0]->getPlainText()),
                'type' => $two[1]->getPlainText(),
                'team' => $two[2]->getPlainText(),
                'status' => $two[3]->getPlainText(),
                'location' => $two[4]->getPlainText(),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }

        //
        print_r($result);
    }
}
