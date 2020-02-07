<?php

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

    public function setDirUpload()
    {
        
    }

    /**
     * Faz o upload e gera os tamanhos das imagens
     *
     * @param type $siteSizes defaults ['thumb' => [150, 105], 'media' => [350,245], 'grande' => ['1024','716']]
     */
    public function uploadSizes($siteSizes = array())
    {
        $defaultsSize = [
            'thumb'  => [150, 105],
            'media'  => [350, 245],
            'grande' => ['1024', '716']
        ];
    }

    public function upload($size = array())
    {
        
    }
}
