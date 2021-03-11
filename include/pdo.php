<?php
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=resume_registry',
        'madhuri', 'srm');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    function pdo_query_s($query, $substitutions) {
        global $pdo;

        $stmt = $pdo->prepare($query);
        $stmt->execute($substitutions);

        return $stmt;
    }
?>
