<?php

namespace App\Console;

use App\User;
use DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use GenderApi\Client as GenderApiClient;


class GenderAPIScheduler extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $genderless_users = App\User::where('gender','=',null);

            $apiClient = new GenderApiClient(env('GENDER_API_KEY'));

            foreach ($genderless_users as $user) {
                if ($user->firstname) {
                    $lookup = $apiClient->getByFirstNameAndCountry($user->firstname, 'DE');

                    if ($lookup->genderFound()) {
                    
                        $user->gender = substr($lookup->getGender(),0,1);
                        $user->save();
                    }
                }
                
            }

        })->twiceDaily(1, 13);
    }

}