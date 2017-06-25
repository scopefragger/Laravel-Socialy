<?php
namespace Scopefragger\LaravelSocialy\Commands;

use App\User;
use App\DripEmailer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class PurgeSocial extends Command
{
    protected $signature = 'social:purge';
    protected $description = 'Purges the social feeds';

    public function handle()
    {
        DB::table('ls_social')->drop();
    }
}