<?php

/*
 * This file is part of Laravel Shield.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vinkla\Shield\Commands;

use Exception;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

/**
 * This is the generate command class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class GenerateCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'shield:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate basic auth user credentials';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $user = password_hash($this->argument('user'), PASSWORD_BCRYPT);
            $password = password_hash($this->argument('password'), PASSWORD_BCRYPT);

            $this->info(sprintf('User: %s', $user));
            $this->info(sprintf('Password: %s', $password));

            return 0;
        } catch (Exception $e) {
            $this->error($e->getMessage());

            return 1;
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['user', InputArgument::REQUIRED, 'The hashed user'],
            ['password', InputArgument::REQUIRED, 'The hashed password'],
        ];
    }
}
