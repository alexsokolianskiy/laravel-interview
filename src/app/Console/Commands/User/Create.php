<?php

namespace App\Console\Commands\User;

use App\Models\User;
use App\Services\User\Create as CreateService;
use Illuminate\Console\Command;
use App\Services\User\CreateUserObject;

class Create extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {fname} {lname}';

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
    public function handle(CreateService $createService)
    {
        $userObject = new CreateUserObject();
        $userObject->password = base64_encode(random_bytes(10));
        $userObject->firstName = $this->argument('fname');
        $userObject->lastName = $this->argument('lname');
        $user = $createService->create($userObject);
        $this->info(sprintf('User: %s was created!', $user->username));
        $this->newLine(1);
        $this->info(sprintf("Password:\n%s", $userObject->password));

        return Command::SUCCESS;
    }
}
