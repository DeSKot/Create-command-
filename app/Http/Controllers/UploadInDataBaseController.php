<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Console\Commands\Test2;

class UploadInDataBaseController extends Controller
{
    public function uploadInDataBase(){
        echo "I save your Images in Data Base - Successfully";
    }
}
