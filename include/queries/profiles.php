<?php
    require_once('include/pdo.php');

    define ('SQL_UPDATE_PROFILE',
        'UPDATE profiles SET user_id = :uid, image_url = :img, first_name = :first,
        last_name = :last, email = :em, headline = :hl, summary = :sum
        WHERE profile_id = :id');
    define('SQL_DELETE_PROFILE_BY_PROFID',
        'DELETE FROM profiles WHERE profile_id = :id');
    define('SQL_INSERT_NEW_PROFILE',
        'INSERT INTO profiles (user_id, image_url, first_name, last_name,
        email, headline, summary) VALUES (:uid, :img, :first, :last, :em, :hl, :sum)');
    define('SQL_SELECT_PROFILE_BY_PROFID',
        'SELECT * FROM profiles WHERE profile_id = :id');
    define('SQL_SELECT_PROFILES',
        'SELECT first_name, last_name, headline, profile_id FROM profiles');

    function update_profile($uid, $img_url, $first_name, $last_name, $email, $headline, $sum, $profid) {
        pdo_query_s(SQL_UPDATE_PROFILE,
            array(
                ':uid' => $uid,
                ':img' => $img_url,
                ':first' => $first_name,
                ':last' => $last_name,
                ':em' => $email,
                ':hl' => $headline,
                ':sum' => $sum,
                ':id' => $profid
            )
        );
    }

    function delete_profile($profid) {
        pdo_query_s(SQL_DELETE_PROFILE_BY_PROFID, array(':id' => $profid));
    }

    function insert_profile($uid, $img_url, $first_name, $last_name, $email, $headline, $sum) {
        pdo_query_s(SQL_INSERT_NEW_PROFILE,
            array(
                ':uid' => $uid,
                ':img' => $img_url,
                ':first' => $first_name,
                ':last' => $last_name,
                ':em' => $email,
                ':hl' => $headline,
                ':sum' => $sum
            )
        );
    }

    function select_profiles() {
        global $pdo;

        return $pdo->query(SQL_SELECT_PROFILES);
    }

    function select_profile($profid) {
        return pdo_query_s(SQL_SELECT_PROFILE_BY_PROFID,
            array(':id' => $profid))->fetch(PDO::FETCH_ASSOC);
    }
?>
