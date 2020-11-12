<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Command\OutputStyle\CustomStyle;

/**
 * Reset database
 *
 * @link https://symfony.com/doc/current/console.html
 */
class ResetDatabaseCommand extends Command
{
    protected static $defaultName = 'app:reset-database';

    protected function configure()
    {
        $this
            ->setDescription('Rest all tables in database')
            ->setHelp('This command allows you to reset your database.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->io = new CustomStyle($input, $output);

        $this->output = $output;
        $this->env = $input->getOption('env');

        $this->io->title('Executing command: ' . self::$defaultName);

        /* Drop Tables */
        $this->runCommand('doctrine:schema:drop', [
            '--force' => true,
            '--full-database' => true,
        ]);

        /* Migrations */
        $this->runCommand('doctrine:migrations:migrate');

        /* Load Fixtures */
        $this->runCommand('doctrine:fixtures:load');

        $this->io->endTitle('Succesfully executed command: ' . self::$defaultName);

        return Command::SUCCESS;
    }

    private function runCommand($commandName, $arguments = [])
    {
        $this->io->section('Start: ' . $commandName);

        $command = $this->getApplication()->find($commandName);
        $env = ['--env' => $this->env];

        $input = new ArrayInput(array_merge($env, $arguments));
        $input->setInteractive(false);

        $outputCode = $command->run($input, $this->output);

        $this->io->endSection('End: ' . $commandName);

        return $outputCode;
    }
}
