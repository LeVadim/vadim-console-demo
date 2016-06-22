<?php
/**
 * Created by PhpStorm.
 * User: levadim
 * Date: 6/8/16
 * Time: 5:25 PM
 */

namespace Acme;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RenderCommand extends Command
{

    public function configure()
    {
        $this->setName('render')
            ->setDescription('Render some tabular data');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $table = new Table($output);

        $table->setHeaders(['Name','Age'])
            ->setRows([
                ['John Done', '20'],
                ['Maxim Makarenko', '18'],
                ['Vadim Denis', '17'],
            ])
            ->render();
    }

}