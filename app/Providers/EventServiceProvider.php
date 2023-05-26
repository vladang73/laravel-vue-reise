<?php

namespace App\Providers;

use App\Events\AgencyDeleted;
use App\Events\BookingCreated;
use App\Events\DefaultSchedulingCreated;
use App\Events\DefaultSchedulingUpdated;
use App\Events\ForgotPassword;
use App\Events\PolicyChecked;
use App\Listeners\AgencyDeletedListener;
use App\Listeners\BookingCreatedListener;
use App\Listeners\DefaultSchedulingCreatedListener;
use App\Listeners\DefaultSchedulingUpdatedListener;
use App\Listeners\ForgotPasswordListener;

use App\Listeners\PolicyCheckedListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
        ForgotPassword::class => [
            ForgotPasswordListener::class
        ],
        BookingCreated::class => [
            BookingCreatedListener::class
        ],
        AgencyDeleted::class => [
            AgencyDeletedListener::class
        ],
        PolicyChecked::class => [
            PolicyCheckedListener::class
        ],
        DefaultSchedulingCreated::class => [
            DefaultSchedulingCreatedListener::class
        ],
        DefaultSchedulingUpdated::class => [
            DefaultSchedulingUpdatedListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
