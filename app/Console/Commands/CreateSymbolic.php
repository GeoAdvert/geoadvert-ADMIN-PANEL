<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateSymbolic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sym:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Symbolic link';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $targetFolder = base_path('storage/app/public');
        $linkFolder = public_path('storage');

        if (is_link($linkFolder)) {
            $this->info('The symbolic link already exists.');
            return;
        }

        if (symlink($targetFolder, $linkFolder)) {
            $this->info('Symbolic link created successfully.');
        } else {
            $this->error('Failed to create symbolic link.');
        }
    }
}
