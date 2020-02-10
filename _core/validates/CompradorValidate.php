<?php

use app\models\Comprador;

/**
 * Description of CompradorValidate
 *
 * @author franf
 */
class CompradorValidate {

    private $comprador;

    public function __construct(Comprador $comprador)
    {
        $this->comprador = $comprador;
    }
    /*
     *
     * id
      nome
      numero
      senha
      bairro
      cidade
      contatos
      endereco
      estado
      uf
     */

    public function nome()
    {
           
    }    
}
