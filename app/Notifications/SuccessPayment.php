<?php

namespace App\Notifications;
 
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use NotificationChannels\Messagebird\MessagebirdChannel;
use NotificationChannels\Messagebird\MessagebirdMessage; 


class SuccessPayment extends Notification
{ 
    public $invoice;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {  
        return [MessagebirdChannel::class];
    }
 
    public function toMessagebird($notifiable)
    {
        return (new MessagebirdMessage("Your {$notifiable->service} was ordered!"))->view(
            'emails.success_payment', ['invoice' => $this->invoice]
        ) 
        ->from('barrett@example.com', 'Barrett Blair')
        ->error()
        ->subject('Pembayaran Sukses');
        //Additionally you can add recipients (single value or array)
        //return (new MessagebirdMessage("Your {$notifiable->service} was ordered!"))->setRecipients($recipients);
        //In order to handle a status report you can also set a reference
        //return (new MessagebirdMessage("Your {$notifiable->service} was ordered!"))->setReference($id);
    }

    /**
     * Determine if the notification should be sent.
     *
     * @param  mixed  $notifiable
     * @param  string  $channel
     * @return bool
     */
    public function shouldSend($notifiable, $channel)
    {
        return $this->invoice->isPaid();
    }

}
