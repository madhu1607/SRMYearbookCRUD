<?php
    require_once 'include/pdo.php';
    require_once 'include/queries/profiles.php';
    require_once 'include/common.php';

    function show_profile() {
        global $pdo;

        $selection = select_profiles();

        if ($profile = $selection->fetch(PDO::FETCH_ASSOC)) {
            echo '<table border="1">';
            echo '<tr><th>Name</th><th>Headline</th>' .
                (is_logged() ? '<th>Action</th>' : '') . '</tr>';
            do {
                echo '<tr>';

                # Name
                echo '<td><a href="view.php?profile_id=' . $profile['profile_id'] . '">' .
                    htmlentities($profile['first_name']) . ' ' . htmlentities($profile['last_name']) . '</a></td>';
                # Headline
                echo '<td>' . htmlentities($profile['headline']) . '</td>';
                # Action
                echo (is_logged() ? '<td><a href="edit.php?profile_id=' . $profile['profile_id'] .
                    '">Edit</a> <a href="delete.php?profile_id=' . $profile['profile_id'] .
                    '">Delete</a></td>' : '');

                echo '</tr>';
            } while ($profile = $selection->fetch(PDO::FETCH_ASSOC));
            echo '</table>';
        }
        if (is_logged()) {
            echo '<br><br><p><a href="add.php">Add New Entry</a></p>';
        }
    }

    session_start();
?>

<!DOCTYPE html>
<html>

<head>
  <title>SRM Yearbook 2021- Home</title>
  <?php require_once 'styles/inc_styles.php'; ?>
</head>

<body>
  <div class='container'>
    <h1>SRM Yearbook 2021</h1>
    <div><h4>Congratulations to the batch of 2021 &#11088</h4>
    <img src="img/graduation.jpg" alt="graduation pic" height="500px">
<p>This is a collection of all the memories, achievements and any random stuff you would like to add about your college life.<br><b>Log in </b> to add your entry.</p>
</div>
    <?php
        if (isset($_SESSION['success'])) {
            echo '<p style="color: green;">' . $_SESSION['success'] . '</p>';
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['error'])) {
            echo '<p style="color: red;">' . $_SESSION['error'] . '</p>';
            unset($_SESSION['error']);
        }

        echo is_logged() ? '<p><a href="logout.php">Logout</a></p><br>' :
            '<p><a href="login.php">Please log in</a></p><br><h3>Some Existing Profiles</h3>';
        show_profile();
    ?>
  </div>
</body>

</html>
