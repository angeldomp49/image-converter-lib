<?php 
namespace MakechTec\ImageConverter;

use MakechTec\ImageConverter\GFile;
use SplFileObject;
use \finfo;

class ImgFile extends SplFileObject {

    use GFile;

    public function getResource() {
        $fileStream = $this->readContent();
        return imagecreatefromstring( $fileStream );
    }

    public function mimeType(){
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        return $finfo->file($this->getPathname());
    }

    public function srcForHTML(){
        return "data:" . $this->mimeType() . ";base64, " . $this->base64Content();
    }

    public function displayInBrowser(){
        header('Content-Type: ' . $this->mimeType());
        $this->printRaw();
    }

    public function printRaw(){
        echo($this->readContent());
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