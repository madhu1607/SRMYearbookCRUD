<?php
    require_once 'include/pdo.php';
    require_once 'institution.php';

    define('SQL_UPDATE_EDUCATION',
        'UPDATE education SET institution_id = :new_instid, `year` = :yr
        WHERE profile_id = :profid AND institution_id = :instid');
    define('SQL_DELETE_EDUCATION_BY_PROFID_INSTID',
        'DELETE FROM education WHERE profile_id = :profid
        AND institution_id = :instid');
    define('SQL_INSERT_NEW_EDUCATION',
        'INSERT INTO education (profile_id, institution_id, year)
        VALUES (:profid, :instid, :yr)');
    define('SQL_SELECT_EDUCATION_BY_PROFID',
        'SELECT * FROM education WHERE profile_id = :id');

    function update_education($school, $yr, $profid, $instid) {
        if (!is_existing_inst($school)) {
            insert_institution($school);
        }

        pdo_query_s(SQL_UPDATE_EDUCATION,
            array(
                ':new_instid' => select_instid_by_instname($school),
                ':yr' => $yr,
                ':profid' => $profid,
                ':instid' => $instid
            )
        );
    }

    function delete_education($profid, $instid) {
        pdo_query_s(SQL_DELETE_EDUCATION_BY_PROFID_INSTID,
            array(
                ':profid' => $profid,
                ':instid' => $instid
            )
        );
    }

    function insert_education($profid, $school, $yr) {
        if (!is_existing_inst($school)) {
            insert_institution($school);
        }

        pdo_query_s(SQL_INSERT_NEW_EDUCATION,
            array(
                ':profid' => $profid,
                ':instid' => select_instid_by_instname($school),
                ':yr' => $yr
            )
        );
    }

    function select_education_by_profid($profid) {
        return pdo_query_s(SQL_SELECT_EDUCATION_BY_PROFID,
            array(':id' => $profid));
    }
?>
