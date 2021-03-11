<?php
    require_once 'include/errors.php';

    define('NO_IMG_AVA', 'img/no-image.png');
    define('MAX_POS_ENTRIES', 9);
    define('MAX_EDU_ENTRIES', 9);

    function is_logged() {
        return isset($_SESSION['name']) && isset($_SESSION['user_id']);
    }

    function is_valid_email($email) {
        return strchr($email, '@') !== false;
    }

    function url_exists($url) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, true);

        curl_exec($ch);
        $retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $retcode == 200;
    }

    function is_ok_field_size() {
        return (strlen($_POST['first_name']) > 1 && strlen($_POST['last_name']) > 1 &&
            strlen($_POST['email']) > 1 && strlen($_POST['headline']) > 1 &&
            strlen($_POST['summary']) > 1);
    }

    function is_profiles_request() {
        return isset($_POST['first_name']) && isset($_POST['last_name']) &&
            isset($_POST['email']) && isset($_POST['headline']) && isset($_POST['summary']);
    }

    function validate_positions() {
        for ($pos = 1; $pos <= MAX_POS_ENTRIES; $pos++) {
            if (isset($_POST['pos_year' . $pos]) && isset($_POST['pos_desc' . $pos])) {
                if (strlen($_POST['pos_year' . $pos]) < 1 || strlen($_POST['pos_desc' . $pos]) < 1) {
                    $_SESSION['error'] = E_PROFILE_BLANK_FIELD;
                    return false;
                }
                if (!is_numeric($_POST['pos_year' . $pos])) {
                    $_SESSION['error'] = E_NON_NUMERIC_POSITION;
                    return false;
                }
            }
        }
        return true;
    }

    function validate_education() {
        for ($edu = 1; $edu <= MAX_EDU_ENTRIES; $edu++) {
            if (isset($_POST['edu_year' . $edu]) && isset($_POST['edu_school' . $edu])) {
                if (strlen($_POST['edu_year' . $edu]) < 1 || strlen($_POST['edu_school' . $edu]) < 1) {
                    $_SESSION['error'] = E_PROFILE_BLANK_FIELD;
                    return false;
                }
                if (!is_numeric($_POST['edu_year' . $edu])) {
                    $_SESSION['error'] = E_NON_NUMERIC_EDUCATION;
                    return false;
                }
            }
        }
        return true;
    }
?>
