<?php 
namespace MakechTec\ImageConverter\Converters;

use MakechTec\ImageConverter\ImgFile;

abstract class Converter{
    public String $imgFile;
    public String $tempFilename;

    public function convertFromToFile( String $fromFilename, String $destinationFilename ){
        $imgFile = new ImgFile($fromFilename);
        $newImgName = $this->convertToFile($imgFile->readContent(), $destinationFilename);
        return new ImgFile($newImgName);
    }

    public function convertToFile( String $raw, String $destinationFilename ) : String {
        $newRaw = $this->convertRaw($raw);
        $newImgName = ImgFile::createFileFromString($newRaw, $destinationFilename);
        return new ImgFile($newImgName);
    }

    public function convertRaw(String $raw) : String {
        $content = $this->loadImgContent( $raw )
                        ->transform()
                        ->getImgContent();

        $this->deleteTempFiles();

        return $content;
    }

    protected function loadImgContent( String $raw ) : Converter { 
        $this->imgFile = ImgFile::createFileFromString( $raw );
        return $this;
    }

    protected function getImgContent() : String {
        return (new ImgFile($this->tempFilename))->readContent();
    }

    protected function deleteTempFiles() : Converter {
        unlink($this->tempFilename);
        unlink($this->imgFile);
        return $this;
    }


    protected function isSupportedExtension ( String $extension ) : bool {
        return in_array( $extension, $this->supportedExtension() );
    }

    public abstract function transform() : Converter ;
    public abstract function supportedExtension() : Array;
    public abstract function finalExtension() : String ;

}