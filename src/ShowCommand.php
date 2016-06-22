<?php namespace Acme;
/**
 * Created by PhpStorm.
 * User: levadim
 * Date: 6/8/16
 * Time: 5:25 PM
 */



use Acme\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ShowCommand extends Command
{


    public function configure()
    {
        $this->setName('show')
            ->setDescription('Render some tabular data');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->showTasks($output);
    }



}