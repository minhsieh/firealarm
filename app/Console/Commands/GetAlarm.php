<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Cockpit\Services\ParserDom;
use App\Alarm;

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
                'time' => str_replace ("&nbsp;&nbsp;&nbsp;"," ", $two[0]->getPlainText()),
                'type' => $two[1]->getPlainText(),
                'team' => $two[2]->getPlainText(),
                'status' => $two[3]->getPlainText(),
                'location' => $two[4]->getPlainText(),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }

        $valuestore = app('valuestore');
        $page_token = $valuestore->get('page_access_token');

        foreach($result as $one){
            // Save to DB
            $alarm = Alarm::firstOrNew(['time' => $one['time'] , 'location' => $one['location']]);

            $alarm->type = $one['type'];
            $alarm->team = $one['team'];
            $alarm->status = $one['status'];
            $alarm->location = $one['location'];
            $alarm->save();
        }

        $pend_alarm = Alarm::whereNull('publish_at')->orderBy('created_at','DESC')->take(10)->get();

        echo "Pend Publish:".count($pend_alarm).PHP_EOL;

        foreach($pend_alarm as $alarm){
            $message = $alarm->type."\n".$alarm->time."\n出動分隊：".$alarm->team."\n案件地點：".$alarm->location."\n\n\n#即時消防\n#".$alarm->team;
            $types = explode("-",$alarm->type);
            if(!empty($types[0])){
                $message = $message."\n#".$types[0];
            }
            if(!empty($types[1])){
                $message = $message."\n#".$types[1];
            }
            $response = $client->request('POST','https://graph.facebook.com/113165399264137/feed?message='.urlencode($message).'&access_token='.$page_token);
            $alarm->publish_at = date("Y-m-d H:i:s");
            $alarm->save();
        }
    }
}
