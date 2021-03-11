<?php
    require_once 'include/pdo.php';

    define('SELECT_USER_BY_EMAIL_PASS',
        'SELECT user_id, name FROM users WHERE email = :em AND password = :pw');

    function select_user($email, $password) {
        return pdo_query_s(SELECT_USER_BY_EMAIL_PASS,
            array(
                ':em' => $email,
                ':pw' => $password
            )
        )->fetch(PDO::FETCH_ASSOC);
    }
?>
