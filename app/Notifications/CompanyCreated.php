<?php

namespace App\Notifications;
 
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use NotificationChannels\Messagebird\MessagebirdChannel;
use NotificationChannels\Messagebird\MessagebirdMessage; 


class CompanyCreated extends Notification
{ 
    protected $company;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($company)
    {
        $this->company = $company;
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
        return (new MessagebirdMessage("Your {$notifiable->service} was ordered!"));
        //Additionally you can add recipients (single value or array)
        //return (new MessagebirdMessage("Your {$notifiable->service} was ordered!"))->setRecipients($recipients);
        //In order to handle a status report you can also set a reference
        //return (new MessagebirdMessage("Your {$notifiable->service} was ordered!"))->setReference($id);
    } 
 
}
