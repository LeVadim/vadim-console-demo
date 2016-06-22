<?php namespace Acme;
use Symfony\Component\Console\Command\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use GuzzleHttp\ClientInterface;
use ZipArchive;
/**
 * Created by PhpStorm.
 * User: levadim
 * Date: 6/8/16
 * Time: 4:27 PM
 */



class NewCommand extends Command
{

    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
        parent::__construct();
    }

    public function configure()
    {
        $this->setName('new')
            ->setDescription('Create new project')
            ->addArgument('name',InputArgument::REQUIRED);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $directory = getcwd() . '/' . $input->getArgument('name');
        $output->writeln('<info> Crafting application.... </info>');
        $this->assertApplicationDoesNotExist($directory,$output);

        $this->download($zipFile = $this->makeFileName())
            ->extract($zipFile, $directory)
            ->cleanUp($zipFile);

        $output->writeln('<comment>Application ready</comment>');

    }

    private function assertApplicationDoesNotExist($directory,OutputInterface $output){
        if(is_dir($directory)){
            $output->writeln('<error>Directory already exist</error>');
            exit(1);
        }else{
            return true;
        }
    }

    private function makeFileName()
    {
        return getcwd() . '/laravel_' . md5(time().uniqid()) . '.zip';
    }

    private function download($zipFile)
    {
        $response = $this->client->get('http://cabinet.laravel.com/latest.zip')->getBody();

        file_put_contents($zipFile,$response);

        return $this;
    }

    private function extract($zipFile, $directory)
    {
        $archive = new ZipArchive();

        $archive->open($zipFile);
        $archive->extractTo($directory);
        $archive->close();

        return $this;
    }

    private function cleanUp($zipFile){
        @chmod($zipFile, 0777);
        @unlink($zipFile);
        return $this;
    }

}