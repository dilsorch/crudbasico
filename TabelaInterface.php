<?php

/**
 * Interface TabelaInterface
 */
interface TabelaInterface
{

    /**
     * @param array $data
     * @return mixed
     */
    public function inserir(array $data);

    /**
     * @param array $where
     * @return mixed
     */
    public function selecionarTudo(array $where = []);

    /**
     * @param array $where
     * @return mixed
     */
    public function selecionar(array $where = []);

    /**
     * @param array $data
     * @param array $where
     * @return mixed
     */
    public function atualizar(array $data, array $where = []);

    /**
     * @param array $where
     * @return mixed
     */
    public function deletar(array $where = []);

    /**
     * @return mixed
     */
    public function getConexao();

    /**
     * @return mixed
     */
    public function getNome();

}