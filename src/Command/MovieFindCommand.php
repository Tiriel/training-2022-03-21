<?php

namespace App\Command;

use App\Entity\Movie;
use App\Fetcher\MovieFetcher;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class MovieFindCommand extends Command
{
    protected static $defaultName = 'app:movie:find';
    protected static $defaultDescription = 'Find a movie by title';
    private MovieFetcher $fetcher;

    public function __construct(MovieFetcher $fetcher, string $name = null)
    {
        parent::__construct($name);
        $this->fetcher = $fetcher;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('value', InputArgument::OPTIONAL, 'The title or id of the movie you want to fetch')
            ->addOption('type', 't', InputOption::VALUE_REQUIRED, 'The type of the value given, title or id')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $value = $input->getArgument('value');
        $type = $input->getOption('type');

        while (!$value) {
            $value = $io->ask('What is the title or id of the movie you want to fetch?');
        }

        while (!in_array($type, ['id', 'title'])) {
            $type = $io->ask('What is the type of the value given? (title or id)');
        }

        $io->note('Fetching movie...');
        $fetchMethod = 'fetchMovieBy' . ucfirst($type);
        /** @var Movie $movie */
        $movie = $this->fetcher->$fetchMethod($value);

        $io->success('Found!');
        $io->table(
            ['Id', 'OMDb Id', 'Title', 'Rated'],
            [
                [$movie->getId(), $movie->getOmdbId(), $movie->getTitle(), $movie->getRated()]
            ]
        );

        return Command::SUCCESS;
    }
}
