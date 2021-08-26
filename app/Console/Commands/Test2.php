<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use  App\Services\Base\DataBase;
use  App\Services\Base\GoogleDrive;
use  App\Services\Base\SaveLocal;

class Test2 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test2:txt {file} {name} {saveIn?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for uploading Images from txt file with URL adrress. Example "php artisan test2:txt URL_file.txt GoodLuck storage"
    URL_file.txt - path to file with your URL;
    GoodLuck - name of your images;
    storage - if you want save on your server writte the path to your directory;
    DB - if you want save on DataBasa
    GD - if you want save on GoogleDrive';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $file_path = $this->argument('file');
        $name_of_file = $this->argument('name');
        $save_path = $this->argument('saveIn');

        switch (trim($save_path)) {
            case 'GD':
                app(GoogleDrive::class)->saveImagesOnGoogleDrive();
                break;
            case 'DB':
                app(DataBase::class)->uploadInDataBase();
                break;
            default:
                app(SaveLocal::class)->createImageLocal($file_path, $name_of_file, $save_path);
                break;
        }
    }
}
