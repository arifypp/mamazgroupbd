<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingNotification extends Notification implements ShouldQueue
{
    use Queueable;
    protected $booking;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($booking)
    {
        //
        $this->booking  = $booking;
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
            ->line($this->booking['name']. ' আপনার বুকিং এর জন্য ধন্যবাদ। আমাদের প্রতিনিধি শিঘ্রই যোগাযোগ করবে। আপনার বুকিং নাম্বার: '. $this->booking['bookingid'])
            ->action('বর্তমান অবস্থা জানতে ভিজিট করুন', route('booking.list'))
            ->line('ভালবাসা অবিরাম মামাজের সঙ্গে থাকার জন্য!');
    }

    /**
     * Get the database representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase($notifiable)
    {
        return [
            //
            'id'             => $this->booking->id,
            'bookingauthid'  => $this->booking->name,
            'flatvalue'      => $this->booking->flatvalue,
            'created_at'     => $notifiable
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
}
