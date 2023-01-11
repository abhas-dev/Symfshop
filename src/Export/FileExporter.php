<?php

namespace App\Export;

use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;

class FileExporter
{
    public function __construct(private readonly Filesystem $filesystem)
    {
    }

    public function generateCSVFromData(string $data, string $type): void
    {
        try {
//            dump($data);
            $this->filesystem->dumpFile("src/Export/export/csv/$type.csv", $data);

        } catch (IOExceptionInterface $exception) {
            echo "An error occurred while creating your file at ".$exception->getPath();
        }
    }
}
