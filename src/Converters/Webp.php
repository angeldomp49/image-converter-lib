<?php 
namespace MakechTec\ImageConverter\Converters;

use MakechTec\ImageConverter\ImgFile;

class Webp extends Converter {
    public function transform() : Converter {
        $imgFile = new ImgFile($this->imgFile);
        $imageToTrueColor = $imgFile->getResource();
        $this->tempFilename = $imgFile->uniqueName( '', $this->finalExtension());

        imagepalettetotruecolor($imageToTrueColor);
        imagewebp( $imageToTrueColor, $this->tempFilename );
        
        return $this;
    }

    public function supportedExtension(): array {
        return [
            'jpeg',
            'jpg',
            'png',
            'JPEG',
            'JPG',
            'PNG'
        ];
    }

    public function finalExtension(): string {
        return 'webp';
    }
}