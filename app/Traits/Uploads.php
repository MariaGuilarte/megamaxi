<?php

namespace App\Traits;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Facades\Storage;

trait Uploads
{    
  public function upload(Request $request, String $fileGroupName)
  {
    $json_files = [];
    $sizes = ['40', '300'];
    
    Storage::append('file.log', $fileGroupName);
    
    if( $files = $request->file($fileGroupName) ){
      
      if( !is_array( $files ) ){
        $files = [$files];
      }
      
      foreach( $files as $file ){
        Storage::append('file.log', $fileGroupName);
        $path = $file->store('public/' . $fileGroupName);
        $newFileName = pathinfo( $path, PATHINFO_BASENAME );
        
        if($fileGroupName == 'profile_picture'){
          foreach( $sizes as $size ){
            if( !Storage::exists( $folder = "public/thumbnails/$size" ) ){
              Storage::makeDirectory($folder);
            }
            $thumbnail = Image::make( storage_path( 'app/' . $path ) )->fit($size);
            $thumbnail->save( storage_path( "app/" . $folder . "/" . $newFileName ));
          }
        }
        
        $json_files[] = [
          'name' => $file->getClientOriginalName(),
          'path' => $path,
          'url'  => str_replace('public', 'storage', $path)
        ];
      }
    }
    return $json_files;
  }
}