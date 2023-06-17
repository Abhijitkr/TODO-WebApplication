<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <title>MY TODO LIST</title>
</head>
<body>
  <div class="main">
    <div class="container">
      <div class="todo-header">
      <form method="POST" action="logout.php">
  <button type="submit" class="btn btn-danger">Logout</button>
</form>
        <h1 class="heading">MY AWESOME TODO</h1>
        <form>
          <input class="rounded insert" id="input" type="text" placeholder="Enter your todo">
          <button type="button" class="rounded btn btn-primary btn-block" id="add">Add TODO</button>
        </form>
      </div>
      <ul class="todo-list" id="todos">

      </ul>               
      <div class="todo-footer">
        <button type="button" class="rounded btn btn-danger btn-block" id="remove">Remove Done TODO</button>
        <button type="button" class="rounded btn btn-warning btn-block" id="removeAll">Remove All TODOS</button>
      </div>
    </div>
  </div>
  <script src="script.js"></script>
</body>
</html>
