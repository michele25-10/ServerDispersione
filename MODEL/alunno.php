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
        $sql = "SELECT  a.SIDI, a.CF, a.nome, a.cognome, a.telefono,  if(a.id_menu is null or a.id_menu = '-1', 'Classico', m.tipologia) as 'menu', a.rischio
        from alunno a
        left join menu m on m.id = a.id_menu;";
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

    function getStudentByCF($CF)
    {
        $sql = "SELECT a.nome, a.cognome, a.SIDI, a.telefono, if(a.id_menu is null or a.id_menu = '-1', 'Classico', a.id_menu) as 'menu' ,  a.rischio
                FROM alunno a
                left join menu m on m.id = a.id_menu
                WHERE CF = '" . $CF . "';";
        return $sql;
    }

    function updateAlunno($id, $nome, $cognome, $SIDI, $telefono, $menu, $rischio)
    {
        $sql = "UPDATE alunno
        SET nome = '" . $nome . "', cognome = '" . $cognome . "', SIDI = '" . $SIDI . "', telefono = '" . $telefono . "', id_menu = '" . $menu . "', rischio = '" . $rischio . "'
        WHERE CF='" . $id . "'; ";
        return $sql;
    }
}
