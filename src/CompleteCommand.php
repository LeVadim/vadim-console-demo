<?php namespace Acme;
/**
 * Created by PhpStorm.
 * User: levadim
 * Date: 6/8/16
 * Time: 5:25 PM
 */




use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CompleteCommand extends Command
{


    public function configure()
    {
        $this->setName('complete')
            ->setDescription('Complete a task by its id')
            ->addArgument('id', InputArgument::REQUIRED);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $id = $input->getArgument('id');
        $this->database->query(
            'DELETE from tasks WHERE id = :id',
            compact('id'));

        $output->writeln('<info>Task completed!</info>');

        $this->showTasks($output);
    }


}