<?php
namespace MakechTec\ImageConverter;

trait GFile {

    public function readContent() : String {
        return $this->fread($this->getSize());
    }

    public function base64Content(){
        return base64_encode( $this->readContent() );
    }

    public abstract function fread(int $size);
    public abstract function getSize();

}