<?php

namespace App\Observers;

use App\Models\Application;
use App\Models\Notification;
use App\Models\User;

class ApplicationObserver
{
    /**
     * Handle the Application "created" event.
     */
    public function created(Application $application): void
    {
        $this->createNotification($application, 'დაემატა');
    }

    /**
     * Handle the Application "updated" event.
     */
    public function updated(Application $application): void
    {

    }

    /**
     * Handle the Application "deleted" event.
     */
    public function deleted(Application $application): void
    {
        $this->createNotification($application, 'წაიშალა');
    }

    /**
     * Handle the Application "restored" event.
     */
    public function restored(Application $application): void
    {
        //
    }

    /**
     * Handle the Application "force deleted" event.
     */
    public function forceDeleted(Application $application): void
    {
        //
    }


    protected function createNotification(Application $application, $action)
    {
        $users=User::all();
        foreach ($users as $user) {
            if(auth()->check() && $user->id !==auth()->user()->id){
                Notification::create([
                    'user_id' => $user->id,
                    'application_id'=>$application->id,
                    'type' => "$action განაცხადი",
                    'read' => false,
                ]);
            }

        }
    }
}
