<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Notification;
use App\Mail\SendEmail;
use App\User;

class SendingEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $notification;

    public function __construct($notification)
    {
        $this->notification = $notification;
    }

    
    public function handle()
    {
        foreach($this->notification as $noti){
            Mail::to(User::where("id", $noti->user_id)->first()->email)->send(new SendEmail($noti->notification, $noti->users->email ));  
        }
       
    }
}
