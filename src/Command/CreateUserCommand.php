<?php

namespace App\Command;

use App\DTO\RegisterUserRequest;
use App\Repository\UserRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use function Symfony\Component\Translation\t;

#[AsCommand(
    name: 'app:create-user',
    description: 'Command to create new user including ADMIN'
)]
class CreateUserCommand extends Command
{
    protected UserRepository $userRepository;
    public function __construct($name = 'create-user', UserRepository $userRepository = null)
    {
        parent::__construct($name);
        $this->userRepository = $userRepository;
    }

    protected function configure(): void
    {
        $this->setDescription('');
        $this->setHelp('Help description needed');
//        $this->addArgument('email', InputArgument::REQUIRED, 'Email: ');
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $helper = $this->getHelper('question');
        $output->writeln('<info>User creation started...</info>');
        $question = new Question('Please provide email:'.PHP_EOL);

        $email = $helper->ask($input, $output, $question);

        $hiddenQuestion = new Question('Password:');
        $hiddenQuestion->setHidden(true);

        $password = $helper->ask($input, $output, $hiddenQuestion);

        $firstNameQuestion = new Question('Please provide firstName:'.PHP_EOL);
        $firstName = $helper->ask($input, $output, $firstNameQuestion);

        $lastNameQuestion = new Question('Please provide lastName:'.PHP_EOL);
        $lastName = $helper->ask($input, $output, $lastNameQuestion);

        $roleQuestion = new Question('Please provide role (ADMIN, USER):'.PHP_EOL);
        $roleQuestion->setValidator(function ($answer) {
            $answer = strtoupper($answer); // Convert to uppercase for case-insensitive match
            if (!in_array($answer, ['ADMIN', 'USER'])) {
                throw new \RuntimeException('Invalid role. Please provide either "ADMIN" or "USER".');
            }
            return $answer;
        });

        $role = $helper->ask($input, $output, $roleQuestion);

        $output->writeln('email: '.$email);
        $output->writeln('password: '.$password);
        $output->writeln('firstName: '.$firstName);
        $output->writeln('lastname: '.$lastName);
        $output->writeln('role: '.$role);

        $userRequest = new RegisterUserRequest();
        $userRequest->firstName = $firstName;
        $userRequest->lastName = $lastName;
        $userRequest->email = $email;
        $userRequest->password = $password;

        $createUserResult = $this->userRepository->create($userRequest);

        if(!$createUserResult){
            $output->writeln('failed to create user');

            return command::FAILURE;
        }
        else{
            $output->writeln('created user successfully');
            return command::SUCCESS;
        }
    }
}