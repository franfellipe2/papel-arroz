<?php

namespace app;

/**
 * Faz conexão com o banco de dados
 *
 * @author franf
 */
class DB {

    /** @var \PDO */
    private static $conn;
    private $statement;

    public function __construct()
    {

        if (!self::$conn):

            try {
                $c = appConfig();
                self::$conn = new \PDO(
                        "mysql:dbname=" . $c['dbname'] . ";host=" . $c['dbhost'], $c['dbuser'], $c['dbpass']
                );
                self::$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $ex) {

                echo "<p>PDO_ERROR: {$ex->getMessage()}</p>";
                die();
            }

        endif;
    }

    function lastInsertId()
    {
        return self::$conn->lastInsertId();
    }

    private function setParams($statement, $parameters = array())
    {
        foreach ($parameters as $key => $value) {

            $this->bindParam($statement, $key, $value);
        }
    }

    private function bindParam($statement, $key, $value)
    {

        if (is_int($value)):
            $statement->bindParam($key, $value, \PDO::PARAM_INT);
        else:
            $statement->bindParam($key, $value);
        endif;
    }

    /**
     * Executa uma instrucao sql, ex: INSERT INTO...
     * 
     * @param string $rawQuery passar aqui a sua instrução sql
     * @param array $params passe aqui os bindParams
     */
    public function query($rawQuery, $params = array())
    {

        $stmt = self::$conn->prepare($rawQuery);

        $this->setParams($stmt, $params);

        $this->execute($stmt);
    }

    /**
     * Retorna os dados de uma instrução sql, ex: SELECT * FROM...
     * 
     * @param string $rawQuery passar aqui a sua instrução sql
     * @param array $params passe aqui os bindParams
     * @return array
     */
    public function select($rawQuery, $params = array()): array
    {

        $stmt = self::$conn->prepare($rawQuery);

        $this->setParams($stmt, $params);

        $this->execute($stmt);


        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    private function execute($statement)
    {
        $statement->execute();
        $this->statement = $statement;
    }

    public function getStatement(): \PDOStatement
    {
        return $this->statement;
    }

    /**
     * Retorna a instancia do PDO
     */
    public function getPDO(): \PDO
    {
        return self::$conn;
    }
}
