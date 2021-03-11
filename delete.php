<?php
    require_once 'include/common.php';
    require_once 'include/errors.php';
    require_once 'include/queries/profiles.php';

    session_start();

    if (isset($_POST['cancel'])) {
        header('Location: index.php');
        return;
    }

    if (!is_logged()) {
        die('ACCESS DENIED');
    }

    if (!($profile = select_profile($_REQUEST['profile_id']))) {
        $_SESSION['error'] = E_INVALID_PROFILE_ID;
        header('Location: index.php');
        return;
    }

    if ($_SESSION['user_id'] != $profile['user_id']) {
        $_SESSION['error'] = E_NO_PRIVILEGES_TO_DELETE;
        header('Location: index.php');
        return;
    }

    if (isset($_POST['delete'])) {
        delete_profile($_REQUEST['profile_id'] ?? '');
        $_SESSION['success'] = 'Profile deleted';
        header('Location: index.php');
        return;
    }
?>

<!DOCTYPE html>
<html>

<head>
  <title>SRM Yearbook 2021- delete</title>
  <?php require_once 'styles/inc_styles.php'; ?>
</head>

<body>
  <div class='container'>
    <h1>Deleteing Profile</h1>
    <p><b>First Name:</b> <?= htmlentities($profile['first_name']); ?></p>
    <p><b>Last Name:</b> <?= htmlentities($profile['last_name']); ?></p>
    <form method="POST">
      <input type="submit" name="delete" value="Delete">
      <input type="submit" name="cancel" value="Cancel">
    </form>
  </div>
</body>

</html>
