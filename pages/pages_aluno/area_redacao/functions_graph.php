<?php

function calcularMedias($conn, $id_matricula){

    $ano_atual = date('Y');

    for($mes=1; $mes <= 12 ; $mes++){

        $sql = "SELECT ROUND(AVG(nota_total), 2) AS media_mensal FROM redacao
                JOIN alunos ON redacao.aluno_id = alunos.id_matricula
                WHERE alunos.id_matricula = ? AND MONTH(redacao.data_envio) = ($mes) AND YEAR(redacao.data_envio) = ($ano_atual)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $id_matricula);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        if($data['media_mensal'] != null){
            $medias_mensais[$mes] = $data['media_mensal'];
        }
        else {$medias_mensais[$mes] = 0;}
        
    }

    $stmt->close();

    return $medias_mensais;
   
}

?>