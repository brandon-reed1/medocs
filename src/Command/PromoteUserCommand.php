<?php
/**
 * PromoteUserCommand
 * Symfony Command
 * Add role to User
 *
 */
namespace App\Command;

use App\Entity\User;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;


/*
 *  @author Novitz Jean-Philippe <novitz@gmail.com>
 */
final class PromoteUserCommand extends Command
{
    protected static $defaultName = 'app:promote-user';
    protected static $defaultDescription = 'Promote user by adding a role';
    protected $em;


    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();
        $this->em = $em;

    }

    protected function configure(): void
    {
        $this->setDescription($this->getDescription());
        $this->addArgument('field', InputArgument::REQUIRED, 'The field used to find the user.');
        $this->addArgument('role', InputArgument::OPTIONAL, 'The role you would like to add');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            'Promote User ',
            '============',
            '',
        ]);
        $field = $input->getArgument('field');
        if (!$role = strtoupper($input->getArgument('role'))){
            $helper = $this->getHelper('question');
            $question = new ConfirmationQuestion('Not role given .... use ROLE_ADMIN ? (n) ', false,  '/^(y|o)/i');
            if (!$helper->ask($input, $output, $question)) {
                return 0;
            }

            $role = "ROLE_ADMIN";
        }

        $output->write('Finding user ' . $field . ' ... ');

        if (! $user = $this->findUser($field)) {
            $output->writeln('User doesn\'t exists !');
            return Command::FAILURE;
        }
        $output->writeln('OK');

        $user_roles = $user->getRoles();

        if (!in_array($role, $user_roles)) {
            array_push($user_roles, $role);
            $user->setRoles($user_roles);
            try {
                $this->em->flush();
                $output->writeln('Role Added');
                return Command::SUCCESS;
            } catch (Exception $exception) {
                $output->writeln('ERROR !');
                $output->writeln($exception);
                return Command::FAILURE;
            }
        } else {
            $output->writeln('Role alreadey exists !');
            $output->writeln($user->getRoles());

            return Command::FAILURE;
        }
    }

    public function findUser($field)
    {
        return $this->em->createQuery('SELECT u FROM ' . User::class . ' u WHERE u.email like :email')
            ->setParameter('email', $field)
            ->getOneOrNullResult();
    }

}
