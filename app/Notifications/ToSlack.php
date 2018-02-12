<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;

class ToSlack extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function via($notifiable){
        return ['slack'];
    }

    public function toSlack($notifiable){
      return(new SlackMessage)
          ->success()
          ->content("通知本文")
          ->attachment(function ($attachment){
            $attachment->title('From Laravel')
                ->content('Laravelからの通知です。');
          });
    }

    public function routeNotificationForSlack(){
      return "https://hooks.slack.com/services/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";
    }

}
