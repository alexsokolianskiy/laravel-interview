<?php

namespace App\Console\Commands\User;

use App\Models\User;
use Illuminate\Console\Command;

class Create extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create user command';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $password = base64_encode(random_bytes(10));
        $user = User::factory()->create([
            'password' => password_hash($password, PASSWORD_BCRYPT)
        ]);
        $this->info(sprintf('User: %s was created!', $user->username));
        $this->newLine(1);
        $this->info(sprintf("Password:\n%s", $password));

        return Command::SUCCESS;
    }
}
