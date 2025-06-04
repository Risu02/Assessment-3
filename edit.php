<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Edit Record</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

  <style>
    /* Ensure all text inside the body is white */
    body.container {
      background-image: url(image/home.jpg);
      background-repeat: no-repeat;
      background-size: cover;
      background-attachment: fixed;
      background-position: center;
      color: #fff !important; /* force white text */
      font-family: 'Courier New', Courier, monospace;
      min-height: 100vh;
      padding: 60px 15px 40px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    /* Headers */
    h1 {
      color: #fff !important;
      text-shadow: 1px 1px 3px #000;
      margin-bottom: 2rem;
      font-weight: 700;
    }

    /* Back button */
    a.btn-primary {
      background-color: #222;
      border-color: #222;
      color: #fff !important;
      font-weight: 600;
      transition: background-color 0.3s ease, color 0.3s ease;
      box-shadow: 0 0 6px rgba(255,255,255,0.1);
    }

    a.btn-primary:hover, a.btn-primary:focus {
      background-color: #555;
      border-color: #555;
      color: #fff !important;
      box-shadow: 0 0 12px rgba(255,255,255,0.3);
      text-decoration: none;
    }

    /* Form styling */
    form.form-group {
      background: rgba(20, 20, 20, 0.85);
      padding: 30px 35px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(255,255,255,0.1);
      width: 100%;
      max-width: 600px;
      color: #fff !important;
    }

    /* Labels */
    label {
      font-weight: 600;
      color: #fff !important;
      margin-top: 1rem;
      display: block;
      text-shadow: 0 0 3px #000;
    }

    /* Inputs */
    input.form-control {
      background-color: #333;
      border: 1px solid #555;
      color: #fff !important;
      font-family: 'Courier New', Courier, monospace;
      box-shadow: inset 0 0 5px #111;
      transition: background-color 0.3s ease, border-color 0.3s ease;
      border-radius: 4px;
      height: 38px;
    }

    input.form-control::placeholder {
      color: #bbb;
      opacity: 1;
    }

    input.form-control:focus {
      background-color: #222;
      border-color: #888;
      box-shadow: 0 0 8px #aaa;
      outline: none;
      color: #fff !important;
    }

    /* Submit button */
    input[type="submit"].btn-warning {
      background-color: #111;
      border: 1px solid #eee;
      color: #fff !important;
      font-weight: 700;
      width: 100%;
      margin-top: 2rem;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(255,255,255,0.15);
      transition: background-color 0.3s ease, color 0.3s ease;
      cursor: pointer;
    }

    input[type="submit"].btn-warning:hover,
    input[type="submit"].btn-warning:focus {
      background-color: #555;
      border-color: #eee;
      color: #fff !important;
      box-shadow: 0 0 15px rgba(255,255,255,0.3);
      outline: none;
    }

    /* Responsive */
    @media (max-width: 576px) {
      form.form-group {
        padding: 20px;
      }
    }
  </style>
</head>
<body class="container">

  <?php 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    include "connection.php";
    $row = [];

    if(isset($_GET['edit'])) {
      $id = $_GET['edit'];
      $recordID = $connection->prepare("select * from SCP where id = ?");
      if(!$recordID) {
        echo "<p class='alert alert-danger'>Error retrieving record</p>";
        exit;
      }
      $recordID->bind_param("i", $id);
      if($recordID->execute()) {
        $temp = $recordID->get_result();
        $row = $temp->fetch_assoc();
      } else {
        echo "<p class='alert alert-danger'>Error: {$recordID->error}</p>";
      }
    }
  ?>

  <h1>Edit Record</h1>
  <p><a href="index.php" class="btn btn-primary">Back to index page</a></p>

  <form method="post" action="update.php" class="form-group">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>" class="form-control">

    <label for="Item">SCP #</label>
    <input type="text" id="Item" name="Item" value="<?php echo htmlspecialchars($row['Item']); ?>" class="form-control" required>

    <label for="Name">Name</label>
    <input type="text" id="Name" name="Name" value="<?php echo htmlspecialchars($row['Name']); ?>" class="form-control" required>

    <label for="Class">Class</label>
    <input type="text" id="Class" name="Class" value="<?php echo htmlspecialchars($row['Class']); ?>" class="form-control" required>

    <label for="Image">Image</label>
    <input type="text" id="Image" name="Image" value="<?php echo htmlspecialchars($row['Image']); ?>" class="form-control" required>

    <label for="Description">Description</label>
    <input type="text" id="Description" name="Description" value="<?php echo htmlspecialchars($row['Description']); ?>" class="form-control" required>

    <label for="Containment">Special Containment Procedure</label>
    <input type="text" id="Containment" name="Containment" value="<?php echo htmlspecialchars($row['Containment']); ?>" class="form-control" required>

    <input type="submit" name="update" value="Update Record" class="btn btn-warning">
  </form>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>
