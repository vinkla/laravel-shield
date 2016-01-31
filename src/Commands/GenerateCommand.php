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

use Illuminate\Console\Command;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Filesystem\Filesystem;
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
    protected $description = 'Generate a new basic auth user';

    /**
     * The config repository instance.
     *
     * @var \Illuminate\Contracts\Config\Repository
     */
    protected $config;

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $filesystem;

    /**
     * Create a new generate command instance.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     * @param \Illuminate\Filesystem\Filesystem $filesystem
     *
     * @return void
     */
    public function __construct(Repository $config, Filesystem $filesystem)
    {
        $this->config = $config;
        $this->filesystem = $filesystem;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @throws \RuntimeException
     *
     * @return int
     */
    public function handle()
    {
        $user = $this->argument('user');
        $username = password_hash($this->argument('username'), PASSWORD_BCRYPT);
        $password = password_hash($this->argument('password'), PASSWORD_BCRYPT);

        $this->save($user, $username, $password);

        $this->info("The user $user was successfully created!");

        return 0;
    }

    protected function save($user, $username, $password)
    {
        dd($this->filesystem->get());
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['user', InputArgument::REQUIRED, 'The name of the user'],
            ['username', InputArgument::REQUIRED, 'The hashed username'],
            ['password', InputArgument::REQUIRED, 'The hashed password'],
        ];
    }
}
