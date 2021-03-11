<?php
    require_once 'include/pdo.php';
    require_once 'include/queries/users.php';
    require_once 'include/common.php';
    require_once 'include/errors.php';

    function login() {
        if (strlen($_POST['email']) < 1 || strlen($_POST['pass']) < 1) {
            $_SESSION['error'] = E_SIGNIN_BLANK_FIELD;
            return;
        } else if (!is_valid_email($_POST['email'])) {
            $_SESSION['error'] = E_INVALID_EMAIL;
            return;
        }

        $userdata = select_user($_POST['email'], get_hash($_POST['pass']));
        if (!$userdata) {
            $_SESSION['error'] = 'Incorrect password';
            error_log('Login fail ' . htmlentities($_POST['email']) . ' ' . get_hash($_POST['pass']));
        } else {
            $_SESSION['name'] = $userdata['name'];
            $_SESSION['user_id'] = $userdata['user_id'];
            error_log('Login success ' . htmlentities($_POST['email']));
        }
    }

    function get_hash($password) {
        $salt = 'XyZzy12*_';
        return hash('md5', $salt . $password);
    }

    session_start();

    if (isset($_POST['cancel'])) {
        header('Location: index.php');
        return;
    }

    if (isset($_POST['email']) && isset($_POST['pass'])) {
        unset($_SESSION['name']);
        unset($_SESSION['user_id']);
        login();
        if (is_logged()) {
            header('Location: index.php');
        } else {
            header('Location: login.php');
        }
        return;
    }
?>

<!DOCTYPE html>
<html>

<head>
  <title>SRM Yearbook 2021 , Log In</title>
  <?php require_once 'styles/inc_styles.php'; ?>
  <script src="js/validation.js"></script>
</head>

<body>
  <div class="container">
    <h1>Please Log In</h1>
    <?php
        if (isset($_SESSION['error'])) {
            echo '<p style="color: red;">' . $_SESSION['error'] . '</p>';
            unset($_SESSION['error']);
        }
    ?>
    <form method="POST">
      <p>
        <label for="edt_username">User Name</label>
        <input type="text" name="email" id="edt_username" width="60">
      </p>
      <p>
        <label for="edt_password">Password</label>
        <input type="password" name="pass" id="edt_password" width="60">
      </p>
      <p>
        <input type="submit" onclick="return validateUserData();" value="Log In">
        <input type="submit" name="cancel" value="Cancel">
      </p>
    </form>
    
  </div>
</body>

</html>
