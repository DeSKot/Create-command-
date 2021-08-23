<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Console\Commands\Test2;

class UploadInGoogleDriveController extends Controller
{
    public function saveImagesOnGoogleDrive(){
        echo "I save your Images on Google Drive - Successfully";
    }
}
