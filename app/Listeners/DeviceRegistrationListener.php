<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Jenssegers\Agent\Facades\Agent;

class DeviceRegistrationListener
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
    public function handle(object $event): void
    {
        $user = User::find($event->user->id);
        $device = '';
        if (Agent::isDesktop()) {
            $browser = Agent::browser();
            $device = "Desktop:browser $browser";
        }else if(Agent::isTablet()){
            $deviceName = Agent::device();
            $device = "Tablet $deviceName";
        }else if(Agent::isPhone()){
            $deviceName = Agent::device();
            $device = "Tablet $deviceName";
        }
        else{
            $deviceName = Agent::device();
            $device = "$deviceName";

        }
        $user->device = $device;
        $user->save();
    }
}
