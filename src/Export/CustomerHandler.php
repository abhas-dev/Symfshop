<?php

namespace App\Export;

class CustomerHandler implements ExportHandlerInterface
{

    public function supports(string $type): bool
    {
        return $type == 'customer';
    }

    public function doExport(): string
    {
        dump(get_class($this));
        return "";
    }
}
