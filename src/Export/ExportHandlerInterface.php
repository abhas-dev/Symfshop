<?php

namespace App\Export;
interface ExportHandlerInterface
{
    public function supports(string $type): bool;

    public function doExport(): string;
}
