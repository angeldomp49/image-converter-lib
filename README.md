Convierte imágenes provienientes de formatos como png y jpg hacia el formato webp.

## Instalación ##

    composer require makechtec/image-converter

## Ejemplo de uso: ##

Para convertir un archivo en otro con terminacion de webp.

    <?php
    require_once('vendor/autoload.php');

    use MakechTec\ImageConverter\Converter\Webp;

    $webpConverter = new Webp();

    $imgFile = $webpConverter->convertFromToFile('original.png', 'destination.webp'); // devuelve ImgFile

    // Mostrar la imagen en el navegador
    $imgFile->displayInBrowser();

## Otras formas de conversión ##

Para convertir el contenido del archivo y colocar el resultado en un archivo recien creado.

    $webpConverter->convertFromFile($rawContentString, 'destination.webp'); // devuelve ImgFile

Para convertir una cadena y leer una cadena ya convertida

    $imgFile->convertRaw($rawContentString);  // devuelve String

## Mostrar el resultado en HTML ##

El convertidor devuelve una instancia de __MakechTec\ImageConverter\ImgFile__ que contiene métodos 
que ayudan a mostrar el contenido.

Para obtener el atributo src para un img de html use __srcForHTML()__.

    <img src = "<?php echo( $imgFile->srcForHTML() ); ?>" >

Para ver la imagen en el navegador use __displayInBrowser__ asegurese de no imprimir nada antes
de llamar a esta función ya que esta coloca los headers necesarios.

    $imgFile->displayInBrowser();

Para obtener el contenido en base64 por ejemplo para almacenarlo en una base de datos.

    $imgFile->base64Content();

Para obtener el contenido binario.

    $imgFile->readContent();



