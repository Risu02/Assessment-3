<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Update Record</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous" />

  <style>
    body.container {
      filter: grayscale(100%);
      background-image: url('image/home.jpg');
      background-repeat: no-repeat;
      background-size: cover;
      background-attachment: fixed;
      background-position: center;
      color: #fff;
      font-family: 'Courier New', Courier, monospace;
      min-height: 100vh;
      padding-top: 70px;
    }

    ul.custom-nav {
      list-style: none;
      margin: 0;
      padding: 0;
      background-color: #000; /* pure black */
      font-size: 1.1rem;
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      display: flex;
      align-items: center;
      z-index: 1050;
      height: 56px;
      overflow-x: auto;
      white-space: nowrap;
    }

    ul.custom-nav li a {
      color: #fff;
      padding: 14px 16px;
      text-decoration: none;
      font-weight: 600;
      white-space: nowrap;
      transition: background-color 0.3s ease;
    }

    ul.custom-nav li a:hover,
    ul.custom-nav li a:focus {
      background-color: #444;
      color: #fff;
      outline: none;
    }

    ul.custom-nav li.right-nav {
      margin-left: auto;
    }

    .content-wrapper {
      background-color: rgba(0, 0, 0, 0.85);
      padding: 30px 25px;
      border-radius: 12px;
      max-width: 700px;
      margin: 1rem auto 3rem auto;
      color: #fff;
      box-shadow: 0 0 15px #000;
    }

    label {
      font-weight: 600;
      margin-top: 1rem;
      color: #fff;
      text-shadow: 1px 1px 3px #000;
    }

    input[type="text"],
    textarea {
      background-color: #222;
      border: 1px solid #444;
      color: #fff !important;
      font-family: monospace;
    }

    textarea {
      resize: vertical;
    }

    .btn-primary {
      background-color: #555;
      border-color: #555;
      color: #fff;
      font-weight: 600;
    }

    .btn-primary:hover,
    .btn-primary:focus {
      background-color: #777;
      border-color: #777;
      color: #fff;
    }

    .alert {
      color: #fff;
    }
    .alert-danger {
      background-color: #a00;
      border-color: #700;
    }
    .alert-success {
      background-color: #0a0;
      border-color: #070;
    }
  </style>
</head>
<body class="container">

  <ul class="custom-nav">
    <li><a href="index.php"><b>Index Page</b></a></li>
    <li><a><b>Entities:</b></a></li>
    <?php 
      include "connection.php";
      $result = $connection->query("SELECT Item FROM SCP");
      if($result && $result->num_rows > 0){
        while($link = $result->fetch_assoc()){
          echo "<li><a href='index.php?link=" . urlencode($link['Item']) . "'><b>" . htmlspecialchars($link['Item']) . "</b></a></li>";
        }
      }
    ?>
    <li class="right-nav"><a href="create.php"><b>Add New Record</b></a></li>
  </ul>

  <div class="content-wrapper">
    <?php
    include "connection.php";

    if (isset($_POST['update'])) {

        $update = $connection->prepare("UPDATE SCP SET Item=?, Name=?, Class=?, Image=?, Description=?, Containment=? WHERE id=?");

        if (!$update) {
            echo "<p class='alert alert-danger mt-3'> Error preparing statement: " . $connection->error . "</p>";
        } else {
            $update->bind_param(
                'ssssssi',
                $_POST['Item'],
                $_POST['Name'],
                $_POST['Class'],
                $_POST['Image'],
                $_POST['Description'],
                $_POST['Containment'],
                $_POST['id']
            );

            if ($update->execute()) {
                echo "<p class='alert alert-success mt-3'> Record successfully updated.</p>";
            } else {
                echo "<p class='alert alert-danger mt-3'> Error executing update: " . $update->error . "</p>";
            }

            $update->close();
        }
    }

    ?>
    
    <p class="mt-3">
      <a href="index.php" class="btn btn-primary">Back to index page</a>
    </p>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>
