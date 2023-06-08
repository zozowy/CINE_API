<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'app:create-user',
)]
class CreateUserCommand extends Command
{
    // protected static $defaultName = 'app:create-user';
    private EntityManagerInterface $em;
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher)
    {
        $this->em = $em;
        $this->passwordHasher = $passwordHasher;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription('Creates a super admin user.')
        ->setHelp('This command allows you to create a user..');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /**
         * @var QuestionHelper $helper
         */
        $helper = $this->getHelper('question');
        // outputs multiple lines to the console (adding "\n" at the end of each line)
        $output->writeln(
            [
                'User Creator',
                '============',
            ]
        );

        $question = new Question('Email de l\'utilisateur : ', '');
        $mail = $helper->ask($input, $output, $question);
        $question = new Question('Mot de passe de l\'utilisateur : ', '');
        $password = $helper->ask($input, $output, $question);

        $user = new User();
        $user->setEmail($mail);

        $encodedPass = $this->passwordHasher->hashPassword($user, $password);

        // $user->setToken(null);
        $user->setPassword($encodedPass);

        $this->em->persist($user);
        $this->em->flush();
        // dd($user);
        $output->writeln(
            [
                '============',
                'User created',
            ]
        );

        return Command::SUCCESS;
    }
}
