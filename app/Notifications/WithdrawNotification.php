<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WithdrawNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $withdraw;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($withdraw)
    {
        //
        $this->withdraw = $withdraw;
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
        ->subject('উইথড্র নোটিফিকেশন')
        ->line($this->withdraw['amount']. ' টাকার উইথড্র রিকুয়েস্ট পাঠিয়েছেন। অনুগ্রহ করে মামাজের ড্যাশবোর্ডের মধ্যে নোটিফিকেশন চেক করুন।')
        ->action('উইখড্র সম্পর্কে জানতে ক্লিক করুন', route('apply.manage'))
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
            'id'                => $this->withdraw->id,
            'name'              => $this->withdraw->user_id,
            'amount'              => $this->withdraw->amount,
            'created_at'        => $notifiable
        ];
    }
}
