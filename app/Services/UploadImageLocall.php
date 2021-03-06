<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class UploadImageLocall{
  public function createImageLocal($file_path, $name_of_file, $save_path)
  {
    $file = file_get_contents("$file_path", true);    //path for file where we have all URL links in txt//                 exemple --f=storage/URL.txt
    $url_array = explode("\n", $file);

    $client = new Client();
    $count = 1;
    

    foreach ($url_array as $value) {
      //$statusCode = $client->request('GET', trim($value))->getStatusCode(); //------------------------------CHECK STATUS CODE OF HTTP REQUEST-------------------
      $path_info = trim(pathinfo($value)['extension']);                   //-------------------------------CHECK FORMAT FILE---------------------------------
      $error_line = "\n---------------------------------------------Error on line $count-----------------------------------------------------------------\n";
      $successful_line = "\n---------------------------------------------Successful image upload line $count-----------------------------------------------------------------\n";

      try {
        $client->request('GET', trim($value));
      } catch (GuzzleException $e) {
        print "$error_line"
         . $e->getMessage();
         $count++;
        continue;
      }

        switch ($path_info) {

          case 'jpg':
            $resource = fopen("$name_of_file-$count.jpg", 'w');
            $client->request('GET', trim($value), ['sink' => $resource,]); //------------------------SAVE IMAGES IN FORMAT JPG ----------------------------
            if (trim($save_path) !== '') {
              rename("$name_of_file-$count.jpg", "$save_path/$name_of_file-$count.jpg");
            }
            echo ($successful_line);
            $count++;
            break;

          case 'png':
            $resource = fopen("$name_of_file-$count.png", 'w');
            $client->request('GET', trim($value), ['sink' => $resource,]); //------------------------SAVE IMAGES IN FORMAT PNG ----------------------------
            if (trim($save_path) !== '') {
              rename("$name_of_file-$count.png", "$save_path/$name_of_file-$count.png");
            }
            echo ($successful_line);
            $count++;
            break;

          case 'gif':
            $resource = fopen("$name_of_file-$count.gif", 'w');
            $client->request('GET', trim($value), ['sink' => $resource,]); //------------------------SAVE IMAGES IN FORMAT GIF ----------------------------
            if (trim($save_path) !== '') {
              rename("$name_of_file-$count.gif", "$save_path/$name_of_file-$count.gif");
            }
            echo ($successful_line);
            $count++;
            break;

          default:
            echo ("\n------------------------------NOT correct format for image on line $count------------------------------------ \n your format now is $path_info \n");
            $count++;
            break;
        }

       // echo ("You have $statusCode Error!!!!! \n");
      
    }
  }
}