<?php

namespace App\Command;

use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class UsersCommand extends Command implements LoggerAwareInterface
{
    protected static $defaultName = 'app:users';

    use LoggerAwareTrait;

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this
            ->setDescription('List of people')
            ->addArgument('maxRandom', InputArgument::REQUIRED, 'Max random number');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->logger->debug('Command run');
        $io = new SymfonyStyle($input, $output);
        $maxRandom = $input->getArgument('maxRandom');

        $result = rand(1, intval($maxRandom));
        $io->writeln('Your random number is: ' . $result);

        if ('tak' === $io->choice('List people?', ['nie', 'tak'])) {
            $users = $this->entityManager->getRepository(Users::class)->findAll();
            foreach ($users as $user) {
                $io->text($user->getName() . ' ' . $user->getSurname());
            }
        }

        $io->success('Success!');

        return 0;
    }
}
