<?php

namespace App\Notifications;

use App\Channels\SendCloudChannel;
use App\Mailer\UserMailer;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;
use Naux\Mail\SendCloudTemplate;
use Mail;

class NewUserFollowNotification extends Notification
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

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database',SendCloudChannel::class];
    }

    public function toSendCloud($notifiable)
    {
       /* $data = [
            'url' => url('http://zhihu.dev'),
            'name'=> Auth::guard('api')->user()->name,
        ];
        $template = new SendCloudTemplate('zhihu_new_user_follow', $data);

        Mail::raw($template, function ($message)  use($notifiable){
            $message->from('ghcz10@outlook.com', 'JellyBean');

            $message->to($notifiable->email);
        });*/
        (new UserMailer())->followNotifyEmail($notifiable->email);
    }

    public function toDatabase($notifiable)
    {
        return [
            'name'=>Auth::guard('api')->user()->name,

        ];

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
