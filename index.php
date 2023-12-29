<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Awesome Page</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <style>
    body, html {
      height: 100%;
    }
    
    .full-screen {
      background-color: #f5f5f5;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100%;
    }
    
    .jumbotron {
      background-color: #333;
      color: #fff;
      padding: 50px;
      text-align: center;
    }
    
    .display-4 {
      font-size: 3rem;
      margin-bottom: 30px;
    }
    
    .buttons {
      margin-top: 30px;
    }
  </style>
</head>
<body>
  <div class="full-screen">
    <div class="jumbotron">
      <h1 class="display-4">Welcome to the Awesome Page</h1>
      <div class="buttons">
        <a href="register.php" class="btn btn-primary btn-lg mr-3">Sign Up</a>
        <a href="signin.php" class="btn btn-secondary btn-lg">Log In</a>
      </div>
    </div>
  </div>
</body>
</html>
