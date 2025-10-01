<?php

function calcularMedias($conn, $id_matricula){

    for($mes=1; $mes <= 12 ; $mes++){
        $sql = "SELECT ROUND(AVG(nota_total), 2) AS media_mensal FROM redacao WHERE id_matricula = ? AND MONTH(redacao.data_envio) = ($i+1)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $id_matricula);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        $medias_mensais[$mes] = $data['media_mensal'];

    }
   
}

?>