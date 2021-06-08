<?php

namespace App\Console\Commands;

use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendEmailVerificationReminderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enviar un correo a los usuarios que nos han validado la cuenta.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        User::query()
            ->whereDate('created_at', '<=', Carbon::now()->subDays(7)->format('Y-m-d'))
            ->whereNull('email_verified_at')
            ->each(function(User $user) {
                $user->sendEmailVerificationNotification();
            });
    }
}
