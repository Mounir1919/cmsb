<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewUserNotification extends Notification
{
    use Queueable;

    /**
     * The ID of the unconfirmed user.
     *
     * @var int
     */
    public $unconfirmedUserId;
    
    /**
     * The name of the unconfirmed user.
     *
     * @var string
     */
    public $unconfirmedUsername;
    
    /**
     * The image path of the unconfirmed user.
     *
     * @var string
     */
    public $unconfirmedUserimage;
 
    /**
     * The image path of the unconfirmed user.
     *
     * @var string
     */
    public $unconfirmedUsergender;
    /**
     * Create a new notification instance.
     *
     * @param int $unconfirmedUserId
     * @param string $unconfirmedUsername
     * @param string $unconfirmedUserimage
     * @param string $unconfirmedUsergender

     */
    public function __construct(int $unconfirmedUserId, string $unconfirmedUsername, string $unconfirmedUserimage, string $unconfirmedUsergender)
    {
        $this->unconfirmedUserId = $unconfirmedUserId;
        $this->unconfirmedUsername = $unconfirmedUsername;
        $this->unconfirmedUserimage = $unconfirmedUserimage;
        $this->unconfirmedUsergender = $unconfirmedUsergender;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    { return [
        'unconfirmed_user_id' => $this->unconfirmedUserId,
        'message' => "A new user {$this->unconfirmedUsername} has been registered.",
        'image' => $this->unconfirmedUserimage,
        'Gender'=>$this->unconfirmedUsergender// Include the image path directly
        // Add any other relevant data you want to store in the database notification
    ];
    }
}
