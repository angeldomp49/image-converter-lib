<?php 
namespace MakechTec\ImageConverter\Converters;

use MakechTec\ImageConverter\ImgFile;

abstract class Converter{
    public String $imgFile;
    public String $tempFilename;

    public function convert(String $raw) : String {
        $content = $this->loadImgContent( $raw )
                        ->transform()
                        ->getImgContent();

        $this->deleteTempFiles();

        return $content;
    }

    public function loadImgContent( String $raw ) : Converter { 
        $this->imgFile = ImgFile::createFileFromString( $raw );
        return $this;
    }

    public function getImgContent() : String {
        return (new ImgFile($this->tempFilename))->readContent();
    }

    public function deleteTempFiles() : Converter {
        unlink($this->tempFilename);
        unlink($this->imgFile);
        return $this;
    }


    public function isSupportedExtension ( String $extension ) : bool {
        return in_array( $extension, $this->supportedExtension() );
    }

    public abstract function transform() : Converter ;
    public abstract function supportedExtension() : Array;
    public abstract function finalExtension() : String ;

}