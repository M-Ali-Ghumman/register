<?php
/*
Template Name: Registration Form
*/
?>

<?php get_header(); ?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

  <h2>User Registration</h2>
<form action="" method="post">
  <p>
    <label for="username">Username</label>
    <input type="text" name="username" id="username" required>
  </p>
  <p>
    <label for="email">Email</label>
    <input type="email" name="email" id="email" required>
  </p>
  <p>
    <label for="password">Password</label>
    <input type="password" name="password" id="password" required>
  </p>
  <p>
    <label for="confirm_password">Confirm Password</label>
    <input type="password" name="confirm_password" id="confirm_password" required>
  </p>
  <p>
    <input type="submit" name="submit" value="Register">
  </p>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
  $username = sanitize_text_field($_POST['username']);
  $email = sanitize_email($_POST['email']);
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  // Check if passwords match
  if ($password !== $confirm_password) {
    echo '<p>Passwords do not match.</p>';
  } else {
    // Check if username and email are available
    if (username_exists($username) || email_exists($email)) {
      echo '<p>Username or Email already exists.</p>';
    } else {
      // Register the user
      $user_id = wp_create_user($username, $password, $email);
      if (!is_wp_error($user_id)) {
        echo '<p>Registration successful!</p>';
      } else {
        echo '<p>Error: ' . $user_id->get_error_message() . '</p>';
      }
    }
  }
}
?>

<?php get_footer(); ?>