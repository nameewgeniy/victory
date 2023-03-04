<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'app:make:admin',
    description: 'Add a short description for your command',
)]
class MakeAdminCommand extends Command
{

    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly EntityManagerInterface $mn,
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('password', InputArgument::REQUIRED, 'Admin password');
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $password = $input->getArgument('password');
        $user = new User();

        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $password
        );

        $user->setEmail('admin@admin.admin')
            ->setPassword($hashedPassword)
            ->setRoles(['ROLE_ADMIN']);

        $this->mn->persist($user);
        $this->mn->flush();

        $io->success('Admin created');

        return Command::SUCCESS;
    }
}
