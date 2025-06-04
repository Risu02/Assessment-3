<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Add New Record</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

  <style>
    body.container {
      background-image: url(image/home.jpg);
      background-repeat: no-repeat;
      background-size: cover;
      background-attachment: fixed;
      background-position: center;
      color: #fff;
      font-family: 'Courier New', Courier, monospace;
      min-height: 100vh;
      padding: 60px 15px 40px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    h1 {
      color: #fff;
      text-shadow: 1px 1px 3px #000;
      margin-bottom: 2rem;
      font-weight: 700;
    }

    a.btn-primary {
      background-color: #222;
      border-color: #222;
      color: #fff;
      font-weight: 600;
      transition: background-color 0.3s ease, color 0.3s ease;
      box-shadow: 0 0 6px rgba(255,255,255,0.1);
    }

    a.btn-primary:hover, a.btn-primary:focus {
      background-color: #555;
      border-color: #555;
      color: #fff;
      box-shadow: 0 0 12px rgba(255,255,255,0.3);
      text-decoration: none;
    }

    form.form-group {
      background: rgba(20, 20, 20, 0.85);
      padding: 30px 35px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(255,255,255,0.1);
      width: 100%;
      max-width: 600px;
      color: #fff;
    }

    label {
      font-weight: 600;
      color: #fff;
      margin-top: 1rem;
      display: block;
      text-shadow: 0 0 3px #000;
    }

    input.form-control, textarea.form-control {
      background-color: #333;
      border: 1px solid #555;
      color: #fff;
      font-family: 'Courier New', Courier, monospace;
      box-shadow: inset 0 0 5px #111;
      transition: background-color 0.3s ease, border-color 0.3s ease;
      border-radius: 4px;
      font-size: 1rem;
      padding: 8px 12px;
    }

    input.form-control:focus, textarea.form-control:focus {
      background-color: #222;
      border-color: #888;
      box-shadow: 0 0 8px #aaa;
      outline: none;
      color: #fff;
    }

    textarea.form-control {
      min-height: 100px;
      resize: vertical;
    }

    input[type="submit"].btn-info {
      background-color: #111;
      border: 1px solid #eee;
      color: #fff;
      font-weight: 700;
      width: 100%;
      margin-top: 2rem;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(255,255,255,0.15);
      transition: background-color 0.3s ease, color 0.3s ease;
    }

    input[type="submit"].btn-info:hover,
    input[type="submit"].btn-info:focus {
      background-color: #555;
      border-color: #eee;
      color: #fff;
      box-shadow: 0 0 15px rgba(255,255,255,0.3);
      outline: none;
      cursor: pointer;
    }

    @media (max-width: 576px) {
      form.form-group {
        padding: 20px;
      }
    }
  </style>
</head>
<body class="container mt-4">

    <?php
    include "connection.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create'])) {
    
    $item = trim($_POST['Item'] ?? '');
    $class = trim($_POST['Class'] ?? '');
    $name = trim($_POST['Name'] ?? '');
    $desc = trim($_POST['Description'] ?? '');
    $containment = trim($_POST['Containment'] ?? '');
    $image = trim($_POST['Image'] ?? '');

    $insert = $connection->prepare("INSERT INTO SCP (Item, Class, Name, Description, Containment, Image) VALUES (?, ?, ?, ?, ?, ?)");
    if ($insert === false) {
        echo "<p class='alert alert-danger'>Prepare failed: " . $connection->error . "</p>";
    } else {
        $insert->bind_param("ssssss", $item, $class, $name, $desc, $containment, $image);

        if ($insert->execute()) {
            echo "<p class='alert alert-success'> Record successfully created</p>";
        } else {
            echo "<p class='alert alert-danger'> Error: {$insert->error}</p>";
            }
        }
    }
    ?>

    <h1>Add New Record</h1>
    <p><a class="btn btn-primary" href="index.php">Back to index page</a></p>

    <form method="post" action="create.php" class="form-group">
    <label for="Item">SCP #</label>
    <input type="text" id="Item" name="Item" class="form-control" required>

    <label for="Name">Name</label>
    <input type="text" id="Name" name="Name" class="form-control" required>
    
    <label for="Class">Class</label>
    <input type="text" id="Class" name="Class" class="form-control" required>

    <label for="Description">Description</label>
    <textarea id="Description" name="Description" class="form-control" required></textarea>

    <label for="Containment">Special Containment Procedure</label>
    <textarea id="Containment" name="Containment" class="form-control" required></textarea>

    <label for="Image">Image</label>
    <input type="text" id="Image" name="Image" class="form-control">

    <input type="submit" name="create" value="Create New Record" class="btn btn-info">
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>
