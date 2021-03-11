<?php
    require_once 'include/pdo.php';

    define('SQL_UPDATE_POSITIONS',
        'UPDATE positions SET `year` = :yr, description = :desc
        WHERE position_id = :posid');
    define('SQL_DELETE_POSITION_BY_POSID',
        'DELETE FROM positions WHERE position_id = :posid');
    define('SQL_INSERT_NEW_POSITION',
        'INSERT INTO positions (profile_id, `year`, description)
        VALUES (:profid, :yr, :desc)');
    define('SQL_SELECT_POSITIONS_BY_PROFID',
        'SELECT * FROM positions WHERE profile_id = :id');

    function update_position($yr, $desc, $posid) {
        global $pdo;

        pdo_query_s(SQL_UPDATE_POSITIONS,
            array(
                ':yr' => $yr,
                ':desc' => $desc,
                ':posid' => $posid
            )
        );
    }

    function delete_position($posid) {
        pdo_query_s(SQL_DELETE_POSITION_BY_POSID,
            array(':posid' => $posid));
    }

    function insert_position($id, $yr, $desc) {
        pdo_query_s(SQL_INSERT_NEW_POSITION,
            array(
                ':profid' => $id,
                ':yr' => $yr,
                ':desc' => $desc
            )
        );
    }

    function select_positions_by_profid($profid) {
        return pdo_query_s(SQL_SELECT_POSITIONS_BY_PROFID,
            array(':id' => $profid));
    }
?>
