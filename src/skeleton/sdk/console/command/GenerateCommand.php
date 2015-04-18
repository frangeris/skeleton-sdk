<?php namespace Skeleton\SDK\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('provider:generate')
            ->setDescription('Generate new provider')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
    	echo 'generate a new provider';
    }
}