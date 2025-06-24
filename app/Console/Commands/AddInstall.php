<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class AddInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:app';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install my app package';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->clearCustomImgFolder();
        $this->info('installling');
        $this->call('migrate:fresh');
        $this->call('db:seed', ['--class' => 'DatabaseSeeder']);
        $this->info('migrated');
        $this->info('database seeded succssfullly');
    }
    protected function clearCustomImgFolder()
    {
        $disk = Storage::disk('public'); // Use the appropriate disk

        $folderPath = 'media'; // Path within the disk

        // Check if the folder exists
        if ($disk->exists($folderPath)) {
            // Retrieve all files and directories within the folder
            $files = $disk->allFiles($folderPath);
            $directories = $disk->allDirectories($folderPath);

            // Delete all files
            foreach ($files as $file) {
                $disk->delete($file);
            }

            // Delete all directories
            foreach ($directories as $directory) {
                $disk->deleteDirectory($directory);
            }

            $this->info('mycustomimg folder cleared.');
        } else {
            $this->error('mycustomimg folder does not exist.');
        }
    }
}
