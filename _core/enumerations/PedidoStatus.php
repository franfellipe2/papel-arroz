<?php

namespace app\enumerations;

/**
 * Description of PedidoStatus
 *
 * @author franf
 */
class PedidoStatus {

    const RECEBIDO = 'recebido';
    const EM_PRODUCAO = 'em_producao';
    const PRONTO_ENTREGA = 'pronto_entrega';
    const ENVIADO = 'enviado';
    const ENTREGUE = 'entregue';

    static public function getLabel($index)
    {
        $labels = [
            self::RECEBIDO       => 'Recebido',
            self::EM_PRODUCAO    => 'Em produção',
            self::PRONTO_ENTREGA => 'Pronto para entrega',
            self::ENVIADO        => 'Enviado para o destinatário',
            self::ENTREGUE       => 'Pedido Entregue',
        ];
        return $labels[$index];
    }

    static function getConstants()
    {
        $oClass = new \ReflectionClass(__CLASS__);
        return $oClass->getConstants();
    }
}
