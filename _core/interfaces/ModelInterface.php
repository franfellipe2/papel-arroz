<?php
namespace app\interfaces;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author franf
 */
interface ModelInterface {

    public function getData(): array;

    public function getId();

    public function getTable(): string;
}
