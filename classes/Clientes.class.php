<?php
/**
 * Responsable to manager all call from Clientes
 * @method function show() 
 * @method function showId($param)
 * @method function store()
 * @method function update($param)
 * @method fucntion delete($param)
 */
class Clientes
{
    /**
     * Show all list from Clientes
     * @return self::_mesageReturn()
     */
    public function show()
    {
        $db = DB::connect();
        $rs = $db->prepare("SELECT * FROM tb_clientes ORDER BY no_cliente");
        $rs->execute();
        $obj = $rs->fetchAll(PDO::FETCH_ASSOC);

        if ($obj) {
            self::_mesageReturn(200, $obj);
        } else {
            self::_mesageReturn(404, "");
        }
    }

    /**
     * Show a specific cliente $param(id)
     * @return self::_mesageReturn()
     */
    public function showId($param)
    {
        $db = DB::connect();
        $rs = $db->prepare("SELECT * FROM tb_clientes WHERE co_seq_clientes = {$param}");
        $rs->execute();
        $obj = $rs->fetchObject();

        if ($obj) {
            self::_mesageReturn(200, $obj);
        } else {
            self::_mesageReturn(404, "Nada encontrado");
        }
    }

    /**
     * Create a new Cliente
     * @return self::_mesageReturn()
     */
    public function store()
    {
        $sql = self::_sqlInsert();
        $db = DB::connect();
        $rs = $db->prepare($sql);
        $exec = $rs->execute();

        if ($exec) {
            self::_mesageReturn(201, "Registro criado com sucesso");
        } else {
            self::_mesageReturn(500, "Erro ao criar registro");
        }

    }

    /**
     * Update a especific Cliente $param(id)
     * @return self::_mesageReturn()
     */
    public function update($param)
    {
        array_shift($_POST);
        $sql = self::_sqlUpdate($param);
        $db = DB::connect();
        $rs = $db->prepare($sql);
        $exec = $rs->execute();

        if ($exec) {
            self::_mesageReturn(200, "Registro atualizado com sucesso");
        } else {
            self::_mesageReturn(500, "Erro ao atualziar registro");
        }
    }


    /**
     * Delete a especific Cliente $param(id)
     * @return self::_mesageReturn()
     */
    public function delete($param)
    {
        array_shift($_POST);

        $sql = self::_sqlDelete($param);
        $db = DB::connect();
        $rs = $db->prepare($sql);
        $exec = $rs->execute();

        if ($exec) {
            self::_mesageReturn(200, "Registro deletado com sucesso");
        } else {
            self::_mesageReturn(500, "Erro ao deletar registro");
        }
    }

    /**
     * Create a sql to insert new row in "tb_clientes", get all values inside $_POST
     * @return string
     */
    private function _sqlInsert()
    {
        $sql = "INSERT INTO tb_clientes (";

        $count = 1;
        foreach (array_keys($_POST) as $index) {
            if (count($_POST) > $count) {
                $sql .= "{$index},";

            } else {
                $sql .= "{$index}";
            }
            $count++;
        }
        $sql .= ") VALUES (";

        $count = 1;
        foreach (array_values($_POST) as $value) {
            if (count($_POST) > $count) {
                $sql .= "'{$value}',";

            } else {
                $sql .= "'{$value}'";
            }
            $count++;
        }

        $sql .= ")";

        return $sql;
    }

    /**
     * Create a sql to update row in "tb_clientes", get all values inside $_POST and recibe a $param(id)
     * @return string
     */
    private function _sqlUpdate($param)
    {
        $sql = "UPDATE tb_clientes SET ";

        $count = 1;
        foreach (array_keys($_POST) as $index) {
            if (count($_POST) > $count) {
                $sql .= "{$index} = '{$_POST[$index]}', ";

            } else {
                $sql .= "{$index} = '$_POST[$index]' ";
            }
            $count++;

        }
        $sql .= "WHERE co_seq_clientes = {$param}";
        return $sql;
    }


    /**
     * Delete a sql to deletew row in "tb_clientes", recibe $param(id)
     * @return string
     */
    private function _sqlDelete($param)
    {
        $sql = "DELETE FROM tb_clientes where co_seq_clientes = {$param}";
        return $sql;
    }

    /**
     * Create and return mesage, recibe http code $code and $message
     * @return 
     */
    private function _mesageReturn(int $code, $message)
    {
        http_response_code($code);
        echo json_encode(["data" => $message]);

    }

}