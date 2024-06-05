<?php
      session_start();
      require 'config.php';
      
      // if (!isset($_SESSION['user_id'])) {
      //     header('Location: login.php');
      //     exit();
      // }
      
      $user_id = $_SESSION['user_id'];
      
      // Fetch user's balance
      $stmt = $pdo->prepare("SELECT `amount` FROM `balance_requests` WHERE user_id = ?");
      $stmt->execute([$user_id]);
      $user = $stmt->fetch();
      $user_balance = $user['amount'];
      // print_r($user_balance); // Assuming 'balance' is the column name for balance in your users table
      ?>

<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
  <div class="container">
      <nav class="nav justify-content-center">
        <a class="nav-link active" href="#">Active link</a>
        <a class="nav-link" href="#">Link</a>
        <a class="nav-link" href="#">
          <form action="logout.php" method="post">
    <button type="submit">Logout</button>
  </form></a>
      </nav>

  
  <div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
      <h2>Balance: $<?php echo $user_balance; ?></h2>
    <a href="#" class="card-link">Card link</a>
    <a href="#" class="card-link">Another link</a>
  </div>
</div>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>