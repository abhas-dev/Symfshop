<?php

namespace App\Command;

use App\Export\CustomerHandler;
use App\Export\FileExporter;
use App\Export\ProductHandler;
use App\Export\Registry;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:export',
    description: 'Export a specific type of entity',
)]
class ExportCommand extends Command
{
    public function __construct(
        private readonly Registry $registry,
        private readonly FileExporter $exporter,
        string $name = null)
    {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this
            ->addArgument('type', InputArgument::REQUIRED, 'Type of export')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $type = $input->getArgument('type');

        $exportedData = $this->registry->export(strtolower($type));
        $this->exporter->generateCSVFromData($exportedData, $type);

        return Command::SUCCESS;
    }
}
