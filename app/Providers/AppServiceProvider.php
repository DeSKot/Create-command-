<?php

namespace App\Providers;


use App\Services\UploadInDataBase;
use App\Services\UploadInGoogleDrive;
use App\Services\UploadImageLocall;
use App\Services\Base\DataBase;
use App\Services\Base\GoogleDrive;
use App\Services\Base\SaveLocal;
use Illuminate\Support\ServiceProvider;



class AppServiceProvider extends ServiceProvider
{
    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [

    ];

    /**
     * All of the container singletons that should be registered.
     *
     * @var array
     */
    public $singletons = [
            DataBase::class => UploadInDataBase::class,
            GoogleDrive::class => UploadInGoogleDrive::class,
            SaveLocal::class => UploadImageLocall::class
    ];
}
