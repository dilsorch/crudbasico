<?php


/**
 * Class Tabela
 */
class Tabela implements TabelaInterface
{

    /**
     * @var ConexaoInterface
     */
    protected $conexao;

    /**
     * @var string
     */
    protected $nome;

    /**
     * Tabela constructor.
     * @param string $nome
     * @param ConexaoInterface $conexao
     */
    public function __construct(string $nome, ConexaoInterface $conexao)
    {
        $this->conexao = $conexao;
        $this->nome = $nome;
    }


    /**
     * @param array $data
     */
    public function inserir(array $data)
    {

        $campos = array_keys($data);
        $parametros = implode(', :', $campos);
        $campos = implode(', ', $campos);

        $sql = sprintf('INSERT INTO %s (%s) VALUES (:%s)', $this->nome, $campos, $parametros);

        $prepare = $this->conexao->getConexao()->prepare($sql);
        $prepare->execute($data);

    }

    /**
     * @param array $where
     * @return array
     */
    public function selecionarTudo(array $where = [])
    {
        $campos = array_keys($where);
        $parametros = implode(' AND ', $this->concatIgual($campos));

        $sql = sprintf('SELECT * FROM %s WHERE %s', $this->nome, $parametros);

        $prepare = $this->conexao->getConexao()->prepare($sql);
        $prepare->execute($where);

        return $prepare->fetchAll(\PDO::FETCH_OBJ);
    }

    /**
     * @param array $where
     * @return mixed
     */
    public function selecionar(array $where = [])
    {
        // SELECT * FROM agenda WHERE id = :id LIMI 1
        $campos = array_keys($where);
        $parametros = implode(' AND ', $this->concatIgual($campos));

        $sql = sprintf('SELECT * FROM %s WHERE %s LIMIT 1', $this->nome, $parametros);

        $prepare = $this->conexao->getConexao()->prepare($sql);
        $prepare->execute($where);

        return $prepare->fetch(\PDO::FETCH_OBJ);

    }

    /**
     * @param array $data
     * @param array $where
     */
    public function atualizar(array $data, array $where = [])
    {

        $parametros = implode(', ', $this->concatIgual(array_keys($data)));

        $whereParametros = implode(' AND ', $this->concatIgual(array_keys($where)));

        $sql = sprintf('UPDATE %s SET %s WHERE %s LIMIT 1',
            $this->nome, $parametros, $whereParametros);

        $data = array_merge($data, $where);

        $prepare = $this->conexao->getConexao()->prepare($sql);
        $prepare->execute($data);

    }

    /**
     * @param array $where
     */
    public function deletar(array $where = [])
    {
        $campos = array_keys($where);
        $parametros = implode(' AND ', $this->concatIgual($campos));

        $sql = sprintf('DELETE FROM %s WHERE %s LIMIT 1',
            $this->nome, $parametros);

        $prepare = $this->conexao->getConexao()->prepare($sql);
        $prepare->execute($where);

    }

    /**
     * @return ConexaoInterface
     */
    public function getConexao()
    {
        return $this->conexao;
    }

    /**
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param array $campos
     * @return array
     */
    protected function concatIgual(array $campos)
    {
        return array_map(function ($key) {
            return sprintf('%s = :%s', $key, $key);
        }, $campos);
    }

}