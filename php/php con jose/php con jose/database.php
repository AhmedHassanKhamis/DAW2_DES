<?php

function consulta(string $query, array $config){
    $dns = "mysql:host={$config['host']}; dbname={$config['dbname']}";
    try {
        $ops = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        $pdo = new PDO($dns, $config['username'], $config['password'],$ops);
        return $pdo->query($query);

    } catch (PDOException $e) {
        echo "Conexion fallida: " . $e->getMessage();
    }
}


function consultaSegura(string $query, array $param , array $config){
    $dns = "mysql:host={$config['host']}; dbname={$config['dbname']}";
    try {
        $ops = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        $pdo = new PDO($dns, $config['username'], $config['password'],$ops);
        $sqli = $pdo->prepare($query);
        $sqli->execute($param);
        return $sqli;

    } catch (PDOException $e) {
        echo "Conexion fallida: " . $e->getMessage();
    }
}
