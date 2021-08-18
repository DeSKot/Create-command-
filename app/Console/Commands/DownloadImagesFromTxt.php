<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DownloadImagesFromTxt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'download:txt  {--file=} {--name=} {--d|directory=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description =  'Command for download images from txt file with URL. Exemple : "php artisan download:txt --file=storage/URI.txt --name=logo --directory=strage/app". 
    Where "--file=storage/URI.txt" is path to directory in local project where we have URL adress in txt file, "--name=logo" is new name of download images and "--directory=strage/app" this is the path where you want save picture in local project';

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
        $directory = $this->option('directory') ?? "./";
        $name = $this->option('name');
        $file = $this->option('file');


        $file = file_get_contents("./$file", true);    //path for file where we have all URL links in txt//                 exemple --f=storage/URL.txt
        $url_array = explode(' ', $file);              // array with all Links

        $count = 1;
        foreach ($url_array as $value) {
            $img_url = $value;
            $Headers = @get_headers($img_url);
            if (preg_match("|200|", $Headers[0])) {
                $image = file_get_contents($img_url);
                file_put_contents("./$directory/$name$count.jpg", $image);   //Path for uploaded images  and you can change format to another
                $this->info("$count - count of images");
                $count++;
            } else {
                echo "Not Found";
            }
        }

        $this->info('Pictures from the links have been downloaded successfully');
    }
}
