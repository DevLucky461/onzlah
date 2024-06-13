<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendingEmailJob;
use App\Notification;

class EmailCron extends Command
{
    
    protected $signature = 'email:cron';
    protected $description = 'Command description';

    
    public function __construct()
    {
        parent::__construct();
    }

   
    public function handle()
    {
        $noti = Notification::where(["type" => "email", "status" => "unsend"])->get();
        
        SendingEmailJob::dispatch($noti);

        foreach($noti as $n){
            Notification::where("id", $n->id)->update(["status" => "send",]);
        }

    }
}
