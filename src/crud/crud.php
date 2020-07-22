<?php

namespace conn;

class Crud
{
    private $pdo = null;
    private $tabela = null;
    private static $crud = null;

    //* Método Contrutor
    private function __construct($conexao, $tabela = NULL)
    {

        if (!empty($conexao)) :
            $this->pdo = $conexao;
        else :
            echo "<h3>Conexão inexistente!</h3>";
            exit();
        endif;

        if (!empty($tabela)) $this->tabela = $tabela;
    }

    //* Obter a instancia de conexão e da classe do CRUD
    public static function getInstance($conexao, $tabela = NULL)
    {

        // Verifica se existe uma instância da classe   
        if (!isset(self::$crud)) :
            try {
                self::$crud = new Crud($conexao, $tabela);
            } catch (\Exception $e) {
                echo "Erro " . $e->getMessage();
            }
        endif;

        return self::$crud;
    }

    //? Construindo as instruções do Crud

    private function buildInsert($arrayDados)
    {
        // Inicializa variáveis   
        $sql = "";
        $campos = "";
        $valores = "";

        // Loop para montar a instrução com os campos e valores   
        foreach ($arrayDados as $chave => $valor) :
            $campos .= $chave . ', ';
            $valores .= '?, ';
        endforeach;

        // Retira vírgula do final da string   
        $campos = (substr($campos, -2) == ', ') ? trim(substr($campos, 0, (strlen($campos) - 2))) : $campos;

        // Retira vírgula do final da string   
        $valores = (substr($valores, -2) == ', ') ? trim(substr($valores, 0, (strlen($valores) - 2))) : $valores;

        // Concatena todas as variáveis e finaliza a instrução   
        $sql .= "INSERT INTO {$this->tabela} (" . $campos . ") VALUES (" . $valores . ")";

        // Retorna string com instrução SQL   
        return trim($sql);
    }

    private function buildUpdate($arrayDados, $arrayCondicao)
    {
        // Inicializa variáveis   
        $sql = "";
        $valCampos = "";
        $valCondicao = "";

        // Loop para montar a instrução com os campos e valores   
        foreach ($arrayDados as $chave => $valor) :
            $valCampos .= $chave . '=?, ';
        endforeach;

        // Loop para montar a condição WHERE   
        foreach ($arrayCondicao as $chave) :
            $valCondicao .= $chave . '? AND ';
        endforeach;

        // Retira vírgula do final da string   
        $valCampos = (substr($valCampos, -2) == ', ') ? trim(substr($valCampos, 0, (strlen($valCampos) - 2))) : $valCampos;

        // Retira vírgula do final da string   
        $valCondicao = (substr($valCondicao, -4) == 'AND ') ? trim(substr($valCondicao, 0, (strlen($valCondicao) - 4))) : $valCondicao;

        // Ajeita o final da string
        $valCondicao = substr($valCondicao, 0, -1);

        // Concatena todas as variáveis e finaliza a instrução   
        $sql .= "UPDATE {$this->tabela} SET " . $valCampos . " WHERE " . $valCondicao;

        // Retorna string com instrução SQL   
        return trim($sql);
    }

    private function buildDelete($arrayCondicao)
    {
        // Inicializa variáveis   
        $sql = "";
        $valCampos = "";

        // Loop para montar a instrução com os campos e valores   
        foreach ($arrayCondicao as $chave => $valor) :
            $valCampos .= $chave . '? AND ';
        endforeach;

        // Retira a palavra AND do final da string   
        $valCampos = (substr($valCampos, -4) == 'AND ') ? trim(substr($valCampos, 0, (strlen($valCampos) - 4))) : $valCampos;

        // Concatena todas as variáveis e finaliza a instrução   
        $sql .= "DELETE FROM {$this->tabela} WHERE " . $valCampos;

        // Retorna string com instrução SQL   
        return trim($sql);
    }

    //? Executando as instruções do CRUD

    public function insert($arrayDados)
    {
        try {
            // Atribui a instrução SQL construida no método   
            $sql = $this->buildInsert($arrayDados);

            // Passa a instrução para o PDO   
            $stmt = $this->pdo->prepare($sql);

            // Loop para passar os dados como parâmetro   
            $cont = 1;
            foreach ($arrayDados as $valor) :
                $stmt->bindValue($cont, $valor);
                $cont++;
            endforeach;

            // Executa a instrução SQL e captura o retorno   
            $retorno = $stmt->execute();

            return $retorno;
        } catch (\PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    public function update($arrayDados, $arrayCondicao)
    {
        try {
            // Atribui a instrução SQL construida no método   
            $sql = $this->buildUpdate($arrayDados, $arrayCondicao);

            // Passa a instrução para o PDO   
            $stmt = $this->pdo->prepare($sql);

            // Loop para passar os dados como parâmetro   
            $cont = 1;
            foreach ($arrayDados as $valor) :
                $stmt->bindValue($cont, $valor);
                $cont++;
            endforeach;

            // Loop para passar os dados como parâmetro cláusula WHERE   
            foreach ($arrayCondicao as $valor) :
                $stmt->bindValue($cont, $valor);
                $cont++;
            endforeach;

            // Executa a instrução SQL e captura o retorno   
            $retorno = $stmt->execute();

            return $retorno;
        } catch (\PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    public function delete($arrayCondicao)
    {
        try {
            // Atribui a instrução SQL construida no método   
            $sql = $this->buildDelete($arrayCondicao);

            // Passa a instrução para o PDO   
            $stmt = $this->pdo->prepare($sql);

            // Loop para passar os dados como parâmetro cláusula WHERE   
            $cont = 1;
            foreach ($arrayCondicao as $valor) :
                $stmt->bindValue($cont, $valor);
                $cont++;
            endforeach;

            // Executa a instrução SQL e captura o retorno   
            $retorno = $stmt->execute();

            return $retorno;
        } catch (\PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    public function getSQLGeneric($sql, $arrayParams = null, $fetchAll = TRUE)
    {
        try {
            // Passa a instrução para o PDO   
            $stmt = $this->pdo->prepare($sql);

            // Verifica se existem condições para carregar os parâmetros    
            if (!empty($arrayParams)) :
                // Loop para passar os dados como parâmetro cláusula WHERE   
                $cont = 1;
                foreach ($arrayParams as $valor) :
                    $stmt->bindValue($cont, $valor);
                    $cont++;
                endforeach;
            endif;

            // Executa a instrução SQL    
            $stmt->execute();

            // Verifica se é necessário retornar várias linhas  
            if ($fetchAll) :
                $dados = $stmt->fetchAll(\PDO::FETCH_OBJ);
            else :
                $dados = $stmt->fetch(\PDO::FETCH_OBJ);
            endif;

            return $dados;
        } catch (\PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    public function getSQLDataTable($requestData, $arrayFilterParams = null, $genericSql = null)
    {
        // Inicializa variáveis   
        (!empty($genericSql)) ? $sql = $genericSql : $sql = "";
        $campos = "";
        $valores = "";

        $columnData = $requestData['columns'];

        // Loop para montar a instrução com os campos e valores   
        foreach ($requestData as $chave => $valor) :
            $campos .= $chave . ', ';
            $valores .= '?, ';
        endforeach;

        // Retira vírgula do final da string   
        $campos = (substr($campos, -2) == ', ') ? trim(substr($campos, 0, (strlen($campos) - 2))) : $campos;

        // Retira vírgula do final da string   
        $valores = (substr($valores, -2) == ', ') ? trim(substr($valores, 0, (strlen($valores) - 2))) : $valores;

        // Concatena todas as variáveis e finaliza a instrução   
        if (empty($genericSql)) $sql .= "SELECT * FROM {$this->tabela} WHERE 1 = 1";

        // Passa a instrução para o PDO
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $registerCount = $stmt->fetchColumn();

        $filter = $requestData['search']['value'];

        if (!empty($filter) && !empty($arrayFilterParams)) {
            $arraySize = count($arrayFilterParams);
            $cont = 1;
            if ($arraySize > 1) {
                foreach ($arrayFilterParams as $valor) :
                    if ($cont > 1 && $cont < $arraySize) {
                        $sql .= "OR $valor LIKE '$filter%' ";
                    } else if ($cont == $arraySize) {
                        $sql .= "OR $valor LIKE '$filter%') ";
                    } else {
                        $sql .= " AND ($valor LIKE '$filter%' ";
                    }
                    $cont++;
                endforeach;
            } else if ($arraySize == 1) {
                $sql .= " AND ($arrayFilterParams[0] LIKE '$filter%') ";
            }
        }

        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->execute();

        $totalFiltred = $stmt->rowCount();

        $columnOrder = $requestData['order'][0]['column'];
        $order = $columnData[$columnOrder]['data'];
        $direction = $requestData['order'][0]['dir'];

        $limitStart = $requestData['start'];
        $limitLenght = $requestData['length'];

        $sql .= " ORDER BY $order $direction LIMIT $limitStart, $limitLenght ";

        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $json_data = array(
            "draw" => intval($requestData['draw']),
            "recordsTotal" => intval($registerCount),
            "recordsFiltered" => intval($totalFiltred),
            "data" => $result
        );

        echo json_encode($json_data);
    }
}
