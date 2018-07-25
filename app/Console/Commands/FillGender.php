<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GenderApi\Client as GenderApiClient;
use App\User;
use DB;


class FillGender extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tool:fill-gender';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fill user profiles with statistical gender data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
        $genderless_users = User::where('gender','=',null);

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

        
    }
}
