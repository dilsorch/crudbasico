<?php

/**
 * Class MySqlConexao
 */
class MySqlConexao implements ConexaoInterface
{

    /**
     * @var
     */
    protected $host;

    /**
     * @var
     */
    protected $port;

    /**
     * @var
     */
    protected $dbname;

    /**
     * @var
     */
    protected $username;

    /**
     * @var
     */
    protected $password;

    /**
     * @var
     */
    protected static $connexao;

    /**
     * MySqlConexao constructor.
     * @param $host
     * @param $dbname
     * @param $username
     * @param $password
     */
    public function __construct($host, $dbname, $username, $password)
    {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
    }


    /**
     * @return PDO
     */
    public function getConexao()
    {
        if (!self::$connexao) {
            try {
                self::$connexao = new \PDO(
                    'mysql:host=' . $this->host . ';dbname=' . $this->dbname,
                    $this->username, $this->password);
            } catch (\Exception $e) {

            }
        }
        return self::$connexao;
    }


}