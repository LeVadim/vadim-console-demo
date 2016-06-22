<?php namespace Acme;
/**
 * Created by PhpStorm.
 * User: levadim
 * Date: 6/8/16
 * Time: 5:25 PM
 */




use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AddCommand extends Command
{


    public function configure()
    {
        $this->setName('add')
            ->setDescription('Add task')
            ->addArgument('description', InputArgument::REQUIRED);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $description = $input->getArgument('description');
        $this->database->query(
            'INSERT INTO tasks(description) VALUES (:description)',
            compact('description'));
        $output->writeln('<info>Task Added!</info>');

        $this->showTasks($output);
    }


}