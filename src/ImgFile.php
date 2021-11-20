<?php 
namespace MakechTec\ImageConverter;

use MakechTec\ImageConverter\GFile;
use SplFileObject;

class ImgFile extends SplFileObject {

    use GFile;

    public function getResource() {
        $fileStream = $this->readContent();
        return imagecreatefromstring( $fileStream );
    }

    public static function createFileFromString( String $content ) : String {
        $name = self::uniqueName();
        $imgFile = new self($name, 'w+');
        $imgFile->fwrite($content);

        return $name;
    }

    public static function uniqueName( String $basename = '', String $extension = ''){
        if(empty($extension)){
            return $basename . (new \DateTime())->getTimestamp();
        }
        return $basename . (new \DateTime())->getTimestamp() . '.' . $extension;
    }

}