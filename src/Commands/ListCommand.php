<?php

namespace FintechSystems\DomainsCoza\Commands;

use FintechSystems\DomainsCoza\Facades\DomainsCoza;
use Illuminate\Console\Command;

class ListCommand extends Command
{
    public $signature = 'domainscoza:list';

    public $description = 'List domains at Domains.co.za';

    public function handle(): int
    {
        DomainsCoza::login();

        DomainsCoza::list();

        $this->comment('All done');

        return self::SUCCESS;
    }
}
