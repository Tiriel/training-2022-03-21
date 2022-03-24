<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class BookFindCommand extends Command
{
    protected static $defaultName = 'app:book:find';
    protected static $defaultDescription = 'Find a book (duh!)';

    protected function configure(): void
    {
        $this
            ->addArgument('title', InputArgument::OPTIONAL, 'The title you are searching for.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('title');

        if (!$arg1) {
            $arg1 = $io->ask('What is the title of the book you\'re serching for?');
        }
        
        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }


        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
