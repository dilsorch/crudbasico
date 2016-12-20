<?php

/**
 * Interface ConexaoInterface
 */
interface ConexaoInterface
{
    /**
     * @return \PDO
     */
    public function getConexao();
}