<?php
namespace MakechTec\ImageConverter;

trait GFile {

    public function readContent() : String {
        $raw = $this->fread($this->getSize());
        $this->rewind();
        return $raw;
    }

    public function base64Content(){
        return base64_encode( $this->readContent() );
    }

    public abstract function fread(int $size);
    public abstract function getSize();
    public abstract function rewind();

}