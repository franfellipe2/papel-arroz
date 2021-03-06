<?php

namespace app\models;

use app\DB;

/**
 * Description of Model
 *
 * @author franf
 */
class Model {

    private $errors = array();
    private $errorExistis = false;
    private $msgError;
    private $sqlForPaginate;
    private $paramsForPaginate;

    public function getAll()
    {
        $DB = new DB();
        $r = $DB->select('SELECT * FROM `' . $this->getTable() . '`');

        if (!empty($r)) {
            $produtos = array();
            foreach ($r as $row) {
                $p = new Produto();
                $p->setData($row);
                $produtos[] = $p;
            }
            return $produtos;
        } else {
            return false;
        }
    }

    public function setSlug($string)
    {
        if ($string) {
            $this->data['slug'] = appStrSlug($string);
        }
    }

    public function getSlug()
    {
        return $this->data['slug'];
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function addError($campo, $msg)
    {
        $this->errors[$campo] = $msg;
        $this->errorExistis = true;
    }

    public function removeError($campo)
    {
        unset($this->errors[$campo]);
        if (empty($this->errors)) {
            $this->errorExistis = false;
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getError($erro)
    {
        if (isset($this->errors[$erro])) {
            return $this->errors[$erro];
        }
    }

    public function errorExistis()
    {
        return $this->errorExistis;
    }

    function getMsgError()
    {
        return $this->msgError;
    }

    function setMsgError($msgError)
    {
        $this->msgError = $msgError;
    }

    public function save($excludeFields = array())
    {
        $result = false;
        if ($this->errorExistis()) {
            $this->setMsgError('Não foi possível salvar, existem erros que devem ser corrigidos!');

            // Cadastra
        } elseif (empty($this->getId())) {
            /*
             * INSERT INTO `categorias` (`id`, `nome`, `descricao`, `cat_pai`) VALUES (NULL, 'teste3', 'descriccao 3', NULL);
             */
            $con = new DB();
            $data = $this->getData();
            unset($data['id']);
            $keys = array_keys($data);
            $fields = '`' . implode('`, `', $keys) . '`';
            $params = $this->getBidParams();
            unset($params[':id']);

            $result = $con->query('INSERT INTO `' . $this->getTable() . '` (' . $fields . ') VALUES (' . implode(', ', array_keys($params)) . ') ', $params);

            $this->setId($con->lastInsertId());
        } else {
            $result = $this->update($excludeFields);
        }

        return $result;
    }

    public function getId()
    {
        return $this->data['id'];
    }

    public function getTable()
    {
        return $this->table;
    }

    public function delete()
    {
        /*
         * DELETE FROM `categorias` WHERE `categorias`.`id` = 1
         */
        $db = new DB();
        $db->query('DELETE FROM `' . $this->getTable() . '` WHERE `' . $this->getTable() . '`.`id` = :id', array(':id' => $this->getId()));
    }

    public function getById($id)
    {
        $sql = new DB();
        $r = $sql->select('SELECT * FROM `' . $this->getTable() . '` WHERE `' . $this->getTable() . '`.`id` = \'' . $id . '\'');
        if (empty($r)) {
            return false;
        }
        $this->setData($r[0]);
        return $this;
    }

    public function getBySlug($slug)
    {
        $sql = new DB();
        $r = $sql->select('SELECT * FROM `' . $this->getTable() . '` WHERE `' . $this->getTable() . '`.`slug` = \'' . $slug . '\'');
        if (empty($r)) {
            return false;
        }
        $this->setData($r[0]);
        return $this;
    }

    public function update($excludeFields = array())
    {
        /*
         * UPDATE `categorias` SET `nome` = 'teste1 edit' WHERE `categorias`.`id` = 1;
         */
        array_push($excludeFields, 'id');
        $con = new DB();
        $fields = [];
        $params = $this->getBidParams();
        foreach ($this->getData() as $k => $v) {

            if (!in_array($k, $excludeFields)) {
                $fields[] = "`$k` = :$k";
            } else {
                unset($params[':' . $k]);
            }
        }
        $params[':id'] = $this->getId();
        $fields = implode(', ', $fields);

        /*
          UPDATE `categorias` SET `nome` = 'teste4 fdgdfg', `descricao` = 'descricao4 fdgdfgdf' WHERE `categorias`.`id` = 4;
         */
        return $con->query('UPDATE `' . $this->getTable() . '` SET  ' . $fields . ' WHERE `' . $this->getTable() . '`.`id` = :id', $params);
    }

    /**
     * Gera os bindParams que serão utilizados na instrução esql: [':title' => 'titulo aqui', ':desc' => 'descricao aqui']
     */
    public function getBidParams()
    {
        $bindPrams = [];
        foreach ($this->getData() as $k => $v) {
            $bindPrams[":$k"] = $v;
        }
        return $bindPrams;
    }

    public function listAll($returnObjts = true, $limit = array(), $orderBy = array(), $groupBy = null)
    {
        $db = new DB();

        $params = array();
        $args = '';
        if (!empty($orderBy) && in_array($orderBy[1], ['asc', 'desc']) && in_array($orderBy[0], array_keys($this->data))) {
            $args .= ' ORDER BY ' . $orderBy[0] . ' ' . $orderBy[1];
        }
        if (!empty($groupBy)) {
            $args .= ' GORUP BY :groupby ';
            $params[':groupby'] = $groupBy;
        }

        $sql = 'SELECT * FROM `' . $this->getTable() . '` ' . $args;
        $sqlPaginate = 'SELECT count(*) as total FROM `' . $this->getTable() . '` ' . $args;       
        $this->setSqlForPaginate($sqlPaginate);
        $this->setParamsForPaginate($params);

        $strLimit = '';
        if (!empty($limit)) {
            $strLimit .= ' LIMIT :start, :offset';
            $params[':start'] = $limit[0];
            $params[':offset'] = $limit[1];
        }

        $r = $db->select($sql . ' ' . $strLimit, $params);

        if (empty($r)) {
            return false;
        } elseif ($returnObjts) {
            $objts = array();
            foreach ($r as $data) {
                $p = new $this;
                $p->setData($data);
                $objts[] = $p;
            }
            return $objts;
        }
        return $r;
    }

    /**
     * Passar sql para calcular o total de registros e fazer a paginação
     * @param type $sql
     * @param type $params
     */
    public function setSqlForPaginate($sql)
    {        
        $this->sqlForPaginate = $sql;
    }

    /**
     * Sql utilizado para calcular o total de registors
     * @return type
     */
    public function getSqlForPaginate()
    {
        return $this->sqlForPaginate;
    }

    /**
     * Passar os parametros do sql para calcular o total de registros e fazer a paginação
     * @param type $sql
     * @param type $params
     */
    public function setParamsForPaginate(array $params)
    {
        $this->paramsForPaginate = $params;
    }

    /**
     * Pegar os parametros do sql para calcular o total de registros e fazer a paginação
     * @param type $sql
     * @param type $params
     */
    public function getParamsForPaginate()
    {
        return $this->paramsForPaginate;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setId($id)
    {
        $this->data['id'] = $id;
    }
}
