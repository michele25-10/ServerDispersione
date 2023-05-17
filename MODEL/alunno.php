<?php
class Alunno
{
    protected $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }
    function getArchieveAlunni()
    {
        $sql = "SELECT * from alunno order by cognome, nome asc";
        return $sql;
    }
    function getStudentByCorsoName($nome_corso)
    {
        $sql = "SELECT a.CF, a.nome, a.cognome, c.tipologia
        from alunno a
        inner join iscrizione i on i.id_alunno = a.CF
        inner join corso c on c.id = i.id_corso
        where c.nome_corso = '" . $nome_corso . "' AND c.status!='2';";
        return $sql;
    }

    function addAlunno($SIDI, $CF, $nome, $cognome, $telefono)
    {
        $sql = "INSERT INTO alunno(SIDI, CF, nome, cognome, telefono)
        VALUES ('" . $SIDI . "', '" . $CF . "', '" . $nome . "', '" . $cognome . "', " . $telefono . ");";
        return $sql;
    }
}
