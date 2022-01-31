<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApplicationNotification extends Notification implements ShouldQueue
{
    use Queueable;
    protected $application;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($application)
    {
        //
        $this->application  = $application;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
        ->greeting('হ্যালো! ' .$notifiable->name)
        ->subject('আবেদন নোটিফিকেশন')
        ->line($this->application['name']. ' কাজ করার জন্য আবেদন করেছেন । মামাজ কর্তৃপক্ষকে আবেদনটি যাচাই/বাচাই করে দেখার অনুরোধ করা হচ্ছে।')
        ->action('আবেদন সম্পর্কে জানতে ক্লিক করুন', route('apply.manage'))
        ->line('ভালবাসা অবিরাম মামাজের সঙ্গে থাকার জন্য!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            //
            'id'             => $this->application->id,
            'name'          => $this->application->name,
            'created_at'     => $notifiable
        ];
    }
}
