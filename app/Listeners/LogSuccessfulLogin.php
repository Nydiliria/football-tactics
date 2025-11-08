<?php

namespace App\Listeners;

use App\Models\Login as LoginModel;
use Illuminate\Auth\Events\Login as LoginEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;


class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(LoginEvent $event): void
    {
        LoginModel::create([
            'user_id' => $event->user->id,
            'logged_in_at' => now(),
        ]);
    }
}
