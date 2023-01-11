<?php

namespace App\Export;

class Registry
{
    public function __construct(private iterable $handlers) {}

    public function export(string $type): string
    {
        foreach ($this->handlers as $handler) {
            /* @var \App\Export\ExportHandlerInterface $handler */
            if ($handler->supports($type))
            $data = $handler->doExport($type);
        }
        return $data;
    }
}
