<?php
class Login {
    
    // Función para insertar un nuevo registro de login
    public static function insertarLogin($pdo, $ip) {
        $tiempoUnix = time();
        $sql = "INSERT INTO Login (IP, Tiempo) VALUES (:IP, :Tiempo)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':IP', $ip, PDO::PARAM_STR);
        $stmt->bindParam(':Tiempo', $tiempoUnix, PDO::PARAM_INT);
        $stmt->execute();
    }

    // Función para verificar si ha habido tres o más intentos de login en los últimos treinta segundos desde una IP
    public static function verificarIntentos($pdo, $ip) {
        $tiempoActual = time();
        $tiempoLimite = $tiempoActual - 30; // Treinta segundos atrás

        $sql = "SELECT COUNT(*) AS contador FROM Login WHERE IP = :IP AND Tiempo >= :TiempoLimite";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':IP', $ip, PDO::PARAM_STR);
        $stmt->bindParam(':TiempoLimite', $tiempoLimite, PDO::PARAM_INT);
        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        $contador = (int)$resultado['contador'];

        return $contador >= 3;
    }
}

?>