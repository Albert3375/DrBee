<?php

namespace App\FileControl;

use File;
use Storage;
use DateTime;

class FileControl
{
   private $dateFile;

   public static function storeFile($file, $relative_location)
   {
      $dateFile = new DateTime();

      for($i = 0; $i < count($file); $i++){
      $fileName[] = "{$dateFile->getTimestamp()}_{$file[$i]->getClientOriginalName()}";
      Storage::disk($relative_location)->put($fileName, File::get($file[$i]));
      }

      return $fileName;
   }

   public static function storeSingleFile($file, $relative_location)
   {
      $dateFile = new DateTime();
      $fileName = "{$dateFile->getTimestamp()}_{$file->getClientOriginalName()}";
      Storage::disk($relative_location)->put($fileName, File::get($file));

      return $fileName;
   }

   public static function deleteFile($relative_path, $relative_location)
   {
      $relative_path = parse_url($relative_path, PHP_URL_PATH);
      $relative_pathFragments = explode('/', $relative_path);
      $img = end($relative_pathFragments);
      $response  = Storage::disk($relative_location)->delete($img);

      return $response;
   }

   public static function updateFile($relative_path, $file, $relative_location)
   {
      self::deleteFile($relative_path, $relative_location);
      $fileName =  self::storeFile($file, $relative_location);

      return $fileName;
   }
}