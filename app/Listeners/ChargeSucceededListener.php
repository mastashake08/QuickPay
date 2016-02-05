<?php

namespace App\Listeners;
use Illuminate\Contracts\Mail\Mailer;
use App\Events\ChargeSucceeded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ChargeSucceededListener implements ShouldQueue
{
  public $mailer;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Mailer $mailer)
    {
        //
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  ChargeSucceeded  $event
     * @return void
     */
    public function handle(ChargeSucceeded $event)
    {
        //
        $this->mailer->send('emails.newCharge',$event, function ($message) use($event)  {
          $message->from('payments@quikpay.me', env('APP_TITLE'));

          $message->to($event->user->email)->subject('You Made Money!');
        });

    }
}
