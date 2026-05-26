<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateStorageLink extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:link-custom';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the symbolic link from public/storage to storage/app/public (works on restricted servers)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $target = storage_path('app/public');
        $link = public_path('storage');

        // Check if symlink already exists
        if (file_exists($link)) {
            if (is_link($link)) {
                $this->info('The [public/storage] directory already exists and is a symbolic link.');
                return Command::SUCCESS;
            } else {
                $this->error('The [public/storage] directory already exists but is not a symbolic link.');
                $this->error('Please remove or rename it first.');
                return Command::FAILURE;
            }
        }

        // Try to create symlink using symlink() function (doesn't require exec)
        if (function_exists('symlink')) {
            try {
                if (@symlink($target, $link)) {
                    $this->info('The [public/storage] directory has been linked successfully.');
                    return Command::SUCCESS;
                } else {
                    $this->error('Failed to create symbolic link. symlink() function is available but failed.');
                    $this->error('Please contact your hosting provider to create the link manually:');
                    $this->line("ln -s {$target} {$link}");
                    return Command::FAILURE;
                }
            } catch (\Exception $e) {
                $this->error('Exception: ' . $e->getMessage());
                $this->error('Please contact your hosting provider to create the link manually:');
                $this->line("ln -s {$target} {$link}");
                return Command::FAILURE;
            }
        } else {
            $this->error('Both symlink() and exec() functions are disabled on this server.');
            $this->error('Please contact your hosting provider to create the symbolic link manually:');
            $this->line("ln -s {$target} {$link}");
            $this->newLine();
            $this->info('Or use cPanel File Manager to create a symbolic link.');
            return Command::FAILURE;
        }
    }
}
