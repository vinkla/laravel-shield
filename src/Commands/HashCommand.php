<?php

/*
 * This file is part of Laravel Shield.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Vinkla\Shield\Commands;

use Exception;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

/**
 * This is the hash command class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class HashCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'shield:hash';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hash basic auth user credentials';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        try {
            $credentials = $this->argument('credentials');

            foreach ($credentials as $credential) {
                $this->info(password_hash($credential, PASSWORD_BCRYPT));
            }

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
    protected function getArguments(): array
    {
        return [
            ['credentials', InputArgument::IS_ARRAY | InputArgument::REQUIRED, 'The user credentials (separate with space)'],
        ];
    }
}
