<?php declare(strict_types=1);

namespace PROJ\DB;

class Config
{
    public function connectToDb(): array
    {
        return array(
            'host' => 'localhost',
            'username' => 'laujan',
            'pass' => 'slaptas',
            'database' => 'projektas_2019'
        );
    }
}