<?php

session_start();
include 'config/database.php';





if (isset($_POST['submit'])) {


  $message = '';

  $sqlemail = sprintf('SELECT * FROM `admins` WHERE email = "%s"', $conn->real_escape_string($_POST['email']));

  $result = $conn->query($sqlemail);

  $user = $result->fetch_assoc();

  if ($user) {
    if ($_POST['password'] == $user['password']) {
      $_SESSION['email'] = $user['email'];
      header("Location: /portfolio/AdminDashboard/contents/index.php?id=" . $user['id']);
    } else {
      $message = "Invalid Login Details!";
    }
  } else {
    $message = "Invalid Login Details!";
  };
} ?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <title>Admin Login</title>

  <style>

  </style>
</head>

<body>

  <main class="form-signin w-100 m-auto">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method='post' class="form">

      <h1 class="h1 mb-3 fw-normal">Admin Dashboard Login</h1>
      <?php if (!empty($message)) : ?>
        <div style="font-size: 12px;" class="text-danger mb-3"><?php echo $message; ?></div>
      <?php endif; ?>

      <div class="form-floating">
        <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Email address</label>
      </div>
      <div class="form-floating">
        <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Password</label>
      </div>

      <div class="form-check text-start my-3">
        <input class="form-check-input" name="checkbox" type="checkbox" value="remember-me" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">
          Remember me
        </label>
      </div>
      <button class="btn btn-primary w-100 py-2" type="submit" name="submit">Sign in</button>
      <p class="mt-5 mb-3 text-body-secondary">&copy; 2023 chronicles Soft</p>
    </form>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <script>
    let bgSuccess = document.querySelector('.text-danger');

    setTimeout(() => {
      bgSuccess.remove();
    }, 5000);
  </script>
</body>

</html>