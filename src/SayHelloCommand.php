<?php namespace Acme;
use Symfony\Component\Console\Command\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
/**
 * Created by PhpStorm.
 * User: levadim
 * Date: 6/8/16
 * Time: 4:27 PM
 */



class NewCommand extends Command
{


    public function configure()
    {
        $this->setName('new')
            ->setDescription('Create new project')
            ->addArgument('name',InputArgument::REQUIRED);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {

        $directory = getcwd() . '/' . $input->getArgument('name');
        $this->assertApplicationDoesNotExist($directory);

    }

    private function assertApplicationDoesNotExist($directory,OutputInterface $output){
        if(is_dir($directory)){
            $output->writeln('Directory already exist');
            exit(1);
        }else{
            return true;
        }
    }


}