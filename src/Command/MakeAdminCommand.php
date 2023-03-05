<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\User;
use App\Security\Enum\UserRolesEnum;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

use function Symfony\Component\DependencyInjection\Loader\Configurator\env;

#[AsCommand(
    name: 'app:make:admin',
    description: 'Add a short description for your command',
)]
class MakeAdminCommand extends Command
{
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly EntityManagerInterface $mn,
        private readonly ContainerBagInterface $params
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('password', InputArgument::REQUIRED, 'Admin password');
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $password = $input->getArgument('password');
        $user = new User();

        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $password
        );

        $user->setEmail($this->params->get('admin_email'))
            ->setPassword($hashedPassword)
            ->setRoles([UserRolesEnum::Admin]);

        $this->mn->persist($user);
        $this->mn->flush();

        $io->success('Admin created');

        return Command::SUCCESS;
    }
}
