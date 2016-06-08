<?php

/**
 * Created by PhpStorm.
 * User: levadim
 * Date: 6/8/16
 * Time: 10:50 AM
 */

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class SpeakCommand extends Command
{
    protected function configure()
    {
        //parent::configure(); // TODO: Change the autogenerated stub
        $this->setName('speak')

            ->setDescription('Speak a message.')

            ->addArgument(
                'message',InputArgument::OPTIONAL,'What message should I speak?','Hello world'
            )
            ->addOption('vadim','o',null,'Set the option');
    }

    protected function execute(InputInterface $input,OutputInterface $output)
    {
        if($input->getOption('vadim')){
            exec('say "STOP Option triggered"');
        }else{
            exec('say ' . $input->getArgument('message'));
        }
        $output->writeln('<info>All done.</info>');
    }

}