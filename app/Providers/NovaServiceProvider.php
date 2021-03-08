<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class NovaServiceProvider extends ServiceProvider
{
    public function tools()
	{
	    return [
	        new CpanelMail()
	    ];
	} 
}
