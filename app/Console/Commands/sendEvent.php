<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Client;
use App\Models\Event;
use App\Models\UserToEvent;

class sendEvent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'event:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $url = 'https://fcm.googleapis.com/fcm/send';
        $today = date("Y-m-d");  
        $events = Event::where('date_start', $today)->get();

        foreach ($events as $event) {
            $users = UserToEvent::where('event_id', $event->id)->get();
            foreach ($users as $user) {
                $fields = array (
                    'to' => $user->user()->device_token,
                    "notification" => [
                        "body" => "Сегодня событие " . $event->head,
                        "title" => "Внимание"
                    ]
                );
                $fields = json_encode ( $fields );
        
                $headers = array (
                        'Authorization: key=' . "AAAA6ySBDpw:APA91bH_y7bFtB0fHFyLiSiDjvy4BvqzkiOzsU_QbJyWFHAH0n1EdGqsllWm_r_wOxDGxiThbHtLRVF7WzaG3pZFTp_Skxk9bb-VeZdA8HOwIQG7hOvZb4LhOWqjX6sV9nkaHhbzpgzp",
                        'Content-Type: application/json'
                );
        
                $ch = curl_init ();
                curl_setopt ( $ch, CURLOPT_URL, $url );
                curl_setopt ( $ch, CURLOPT_POST, true );
                curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
                curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
                curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
        
                curl_exec ( $ch );
        
                curl_close ( $ch );
            };
        };

        $tomorrow = date("Y-m-d", strtotime("+1 day"));  
        $events = Event::where('date_start', $tomorrow)->get();

        foreach ($events as $event) {
            $users = UserToEvent::where('event_id', $event->id)->get();
            foreach ($users as $user) {
                $fields = array (
                    'to' => $user->user()->device_token,
                    "notification" => [
                        "body" => "Завтра событие " . $event->head,
                        "title" => "Внимание"
                    ]
                );
                $fields = json_encode ( $fields );
        
                $headers = array (
                        'Authorization: key=' . "AAAA6ySBDpw:APA91bH_y7bFtB0fHFyLiSiDjvy4BvqzkiOzsU_QbJyWFHAH0n1EdGqsllWm_r_wOxDGxiThbHtLRVF7WzaG3pZFTp_Skxk9bb-VeZdA8HOwIQG7hOvZb4LhOWqjX6sV9nkaHhbzpgzp",
                        'Content-Type: application/json'
                );
        
                $ch = curl_init ();
                curl_setopt ( $ch, CURLOPT_URL, $url );
                curl_setopt ( $ch, CURLOPT_POST, true );
                curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
                curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
                curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
        
                curl_exec ( $ch );
        
                curl_close ( $ch );
            };
        };
    }
}
