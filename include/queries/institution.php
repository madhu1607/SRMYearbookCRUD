<?php
    require_once 'include/pdo.php';

    define('SQL_INSERT_NEW_INSTITUTION',
        'INSERT INTO institution (name) VALUES (:name)');
    define('SQL_SELECT_INSTID_BY_INSTNAME',
        'SELECT institution_id FROM institution WHERE name = :name');
    define('SQL_SELECT_INSTNAME_BY_INSTID',
        'SELECT name FROM institution WHERE institution_id = :id');
    define('SQL_SELECT_INSTNAMES_BY_PREFIX',
        'SELECT name FROM Institution WHERE name LIKE :prefix');

    function insert_institution($name) {
        pdo_query_s(SQL_INSERT_NEW_INSTITUTION, array(':name' => $name));
    }

    function select_instid_by_instname($name) {
        $result = pdo_query_s(SQL_SELECT_INSTID_BY_INSTNAME,
            array(':name' => $name))->fetch(PDO::FETCH_ASSOC);

        return $result ? $result['institution_id'] : NULL;
    }

    function select_instname_by_instid($id) {
        return pdo_query_s(SQL_SELECT_INSTNAME_BY_INSTID,
            array(':id' => $id))->fetch(PDO::FETCH_ASSOC)['name'];
    }

    function select_instnames_by_prefix($prefix) {
        return pdo_query_s(SQL_SELECT_INSTNAMES_BY_PREFIX,
            array(':prefix' => $prefix . '%'));
    }

    function is_existing_inst($name) {
        global $pdo;

        return pdo_query_s(SQL_SELECT_INSTID_BY_INSTNAME,
            array(':name' => $name))->fetch(PDO::FETCH_ASSOC) ? true : false;
    }
?>
