<?php
    require_once 'include/pdo.php';
    require_once 'include/common.php';
    require_once 'include/errors.php';
    require_once 'include/queries/profiles.php';
    require_once 'include/queries/positions.php';
    require_once 'include/queries/education.php';

    function get_profile_image_url($profile) {
        return $profile['image_url'] ? htmlentities($profile['image_url']) : NO_IMG_AVA;
    }

    function show_positions($profile_id) {
        $positions = select_positions_by_profid($profile_id);

        $position = $positions->fetch(PDO::FETCH_ASSOC);
        if ($position) {
            echo '<label>Positions:</label>';
            echo '<ul>';
            do {
                echo '<li>' . htmlentities($position['year']) . ': ' .
                    htmlentities($position['description']) . '</li>';
            } while ($position = $positions->fetch(PDO::FETCH_ASSOC));
            echo '</ul>';
        }
    }

    function show_education($profile_id) {
        $education_full = select_education_by_profid($profile_id);

        $education = $education_full->fetch(PDO::FETCH_ASSOC);
        if ($education) {
            echo '<label>Education:</label>';
            echo '<ul>';
            do {
                echo '<li>' . htmlentities($education['year']) . ': ' .
                    htmlentities(select_instname_by_instid($education['institution_id'])) .
                    '</li>';
            } while ($education = $education_full->fetch(PDO::FETCH_ASSOC));
            echo '</ul>';
        }
    }

    session_start();

    if (!($profile = select_profile($_REQUEST['profile_id'] ?? ''))) {
        $_SESSION['error'] = E_INVALID_PROFILE_ID;
        header('Location: index.php');
        return;
    }
?>

<!DOCTYPE html>
<html>

<head>
  <title>SRM Yearbook 2021, View Profile</title>
  <?php require_once 'styles/inc_styles.php'; ?>
</head>

<body>
  <div class='container'>
    <h1>Profile Information</h1>
    <p><?= '<img src="' . get_profile_image_url($profile) . '" class="img-rounded" width="150">' ?></p>
    <p><b>First Name:</b> <?= htmlentities($profile['first_name']); ?></p>
    <p><b>Last Name:</b> <?= htmlentities($profile['last_name']); ?></p>
    <p><b>Email:</b> <?= htmlentities($profile['email']); ?></p>
    <p><b>Headline:</b></p>
    <p><?= htmlentities($profile['headline']); ?></p>
    <p><b>Summary:</b></p>
    <p><?= htmlentities($profile['summary']); ?></p>
    <?php show_education($profile['profile_id']); ?>
    <?php show_positions($profile['profile_id']); ?>
    <p><a href="index.php">Done</a></p>
  </div>
</body>

</html>
