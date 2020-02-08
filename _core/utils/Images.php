<?php

namespace app\utils;

use app\appConfig;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Fazer upload de imagens com redimensionamentos
 *
 * @author franf
 */
class Images {

    private $dirUplaod = 'uploads/images';
    private $imagesPermitidas = ['image/png', 'image/jpeg'];
    private static $sizes = [
        'full'   => null,
        'thumb'  => [150, 105],
        'media'  => [350, 245],
        'grande' => [1024, 716]
    ];
    private $error = [];

    const COD_ERROR_FORMT_INVALID = 1;
    const COD_ERROR_BIG_ZIZE = 2;

    public function __construct()
    {
        
    }

    public function setDirUpload($dir)
    {
        $this->dirUplaod = $dir;
    }

    public function getError()
    {
        return $this->error;
    }

    private function setError($msg, $codigo)
    {
        $this->error = ['msg' => $msg, 'codigo' => $codigo];
    }

    /**
     * Faz o upload e gera os tamanhos das imagens
     *
     * @param type $siteSizes defaults ['thumb' => [150, 105], 'media' => [350,245], 'grande' => ['1024','716']]
     */
    public function upload($fileUpload, $name = '')
    {
        $ftmp = $fileUpload['tmp_name']; // arquivo temporario do arquivo na memória
        $type = mime_content_type($ftmp);

        if (!$this->validFile($type)) {
            $this->setError('Aquivo inválido! Permitido somente imagens png e jpg', self::COD_ERROR_FORMT_INVALID);
            return false;
        }

        switch ($type) {
            case 'image/jpeg':
                $oldImage = imagecreatefromjpeg($ftmp);
                $ext = '.jpg';
                break;
            case 'image/png':
                $oldImage = imagecreatefrompng($ftmp);
                $ext = '.png';
        }


        $w = imagesx($oldImage);
        $h = imagesy($oldImage);
        $newName = $this->fileNameGenerate($name);
        foreach (self::$sizes as $k => $sizes) {

            if ($k == 'full') {
                $nw = $w;
                $nh = $h;
                $srcName = $newName;
            } else {
                $proporcao = $w / $h;
                $nw = $sizes[1] * $proporcao;
                $nh = $sizes[1];
                $srcName = $this->fileNameGenerate($name, $k);
            }


            $newImage = imagecreatetruecolor($nw, $nh);

            imagecopyresampled($newImage, $oldImage, 0, 0, 0, 0, $nw, $nh, $w, $h);

            imagepng($newImage, appConfig('baseDir') . $srcName);

            imagedestroy($newImage);
        }
        imagedestroy($oldImage);

        return $newName;
    }

    static function getUrl($fileName, $size = 'full')
    {
        return appConfig('baseUrl') .'/'. self::getPath($fileName, $size);
    }

    static function getPath($fileName, $size = 'full')
    {
        if ($size == 'full') {
            return $fileName;
        } else {
            return substr($fileName, 0, strrpos($fileName, '.')) . '-size(' . $size . ')' . '.jpg';
        }
    }

    static function remove($fileName)
    {
        
        foreach (self::$sizes as $k => $sizes) {
            if ($k == 'full') {
                @unlink(appConfig('baseDir') . self::getPath($fileName));
            } else {
                @unlink(appConfig('baseDir') . self::getPath($fileName, $k));
            }
        }
    }

    /**
     * Gera nome do arqquivo com o caminho
     */
    public function fileNameGenerate($name, $size = null)
    {
        if ($size == null) {
            return $nName = $this->dirUplaod . '/' . $name . '.jpg';
        } else {
            return $nName = $this->dirUplaod . '/' . $name . '-size(' . $size . ')' . '.jpg';
        }
    }

    /**
     * Verifica se o arquivo é uma imagem é se é no formato permitodo
     */
    private function validFile($mimeType)
    {
        var_dump($mimeType);
        return in_array($mimeType, $this->imagesPermitidas);
    }
}
