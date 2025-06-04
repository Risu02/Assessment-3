<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>SCP Application</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

  <style>
    body {
      filter: grayscale(100%);
      background-image: url(image/home.jpg);
      background-repeat: no-repeat;
      background-size: cover;
      background-attachment: fixed;
      background-position: center;
      color: #fff;
      font-family: 'Courier New', Courier, monospace;
      min-height: 100vh;
      padding-top: 70px;
    }

    .content-wrapper {
      background-color: rgba(0, 0, 0, 0.85);
      padding: 30px 25px;
      border-radius: 12px;
      max-width: 900px;
      margin: 1rem auto 3rem auto;
    }

    .scp-img {
      max-width: 100%;
      height: auto;
      border-radius: 8px;
      display: block;
      margin: 0 auto 1.25rem auto;
      filter: grayscale(100%);
    }

    h2, h3 {
      text-align: center;
      color: #fff;
      text-shadow: 2px 2px 6px #000;
    }

    p {
      text-align: justify;
      color: #fff;
      text-shadow: 1px 1px 3px #000;
    }

    .btn {
      margin-top: 1rem;
    }

    .btn-warning {
      background-color: #555;
      border-color: #555;
      color: #fff;
    }

    .btn-danger {
      background-color: #800000;
      border-color: #800000;
      color: #fff;
    }

    .navbar-dark .navbar-nav .nav-link {
      color: #fff;
      font-weight: bold;
    }

    .dropdown-menu {
      background-color: #000;
    }

    .dropdown-menu a {
      color: #fff;
    }

    .dropdown-menu a:hover {
      background-color: #202020;
    }
    
    .btn-scp {
      background-color: #000;
      color: #fff;
      border: none;
      font-weight: bold;
    }
    .btn-scp:hover {
      background-color: #444;
      color: #fff;
    }

    .nav-link.text-white:hover,
    .nav-link.text-white:focus {
      background-color: #444;
      color: #fff;
      border-radius: 4px;
      text-decoration: none;
      transition: background-color 0.5s ease;
      box-shadow: 0 0 10px #444;
    }

    .navbar .d-flex.align-items-center {
      flex-grow: 1;
    }

    .navbar .ms-auto {
      margin-left: auto;
    }

    #about-scp {
      margin-bottom: 3rem;
      color: #fff;
      text-shadow: 1px 1px 3px #000;
    }
    #about-scp h2 {
      text-align: center;
      color: #fff;
      margin-bottom: 1rem;
      text-shadow: 2px 2px 6px #000;
    }
    #about-scp p {
      text-align: justify;
      color: #fff;
      margin-bottom: 1rem;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-black fixed-top" style="font-family: 'Courier New', Courier, monospace; font-size: 1.1rem;">
  <div class="container">

    <div class="d-flex align-items-center">
      <a class="nav-link text-white me-3" href="index.php"><b>Home</b></a>

      <div class="dropdown">
        <a class="nav-link dropdown-toggle text-white" href="#" id="entitiesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <b>Entities</b>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="entitiesDropdown">
          <?php
            include "connection.php";
            $result = $connection->query("SELECT Item FROM SCP");
            if ($result && $result->num_rows > 0) {
              while ($link = $result->fetch_assoc()) {
                echo "<li><a class='dropdown-item' href='index.php?link=" . urlencode($link['Item']) . "'>" . htmlspecialchars($link['Item']) . "</a></li>";
              }
            }
          ?>
        </ul>
      </div>
    </div>

    <div class="ms-auto">
      <a class="btn btn-scp" href="create.php">Add New Record</a>
    </div>
    
  </div>
</nav>

<div class="content-wrapper">
  <?php
    error_reporting(E_ALL);

    if (isset($_GET['link'])) {
      $model = $connection->real_escape_string($_GET['link']);
      $query = $connection->query("SELECT * FROM SCP WHERE Item='$model'");

      if ($query && $query->num_rows > 0) {
        $array = $query->fetch_assoc();
        $edit = "edit.php?edit=" . $array['id'];
        $delete = "index.php?del=" . $array['id'];

        echo "
          <h2><b>ITEM # {$array['Item']}</b></h2>
          <h3><b>{$array['Name']}</b></h3>
          <h3><b>Object Class: {$array['Class']}</b></h3>
          <img class='scp-img' src='{$array['Image']}' alt='{$array['Item']}' />
          <h3><b>Description:</b></h3>
          <p>{$array['Description']}</p>
          <h3><b>Special Containment Procedures:</b></h3>
          <p>{$array['Containment']}</p>
          <div class='text-center'>
            <a href='{$edit}' class='btn btn-warning'>Edit Record</a>
            <a href='{$delete}' class='btn btn-danger' onclick=\"return confirm('Are you sure you want to delete this record?');\">Delete Record</a>
          </div>
        ";
      } else {
        echo "<p class='text-center text-danger'>No record found for {$model}.</p>";
      }
    } else {
      ?>
      <img src='https://risu02.github.io/Assessment-2/image/001.png' class='scp-img' alt='Default SCP' />
      <section id="about-scp">
        <h2><b>About The SCP Foundation</b></h2>
        <p>
          Mankind in its present state has been around for a quarter of a million years, yet only a small fraction of that has been of any significance.
        </p>
        <p>
          So, what did we do for nearly 250,000 years? We huddled in caves and around small fires, fearful of the things that we didn't understand. It was more than explaining why the sun came up, it was the mystery of enormous birds with heads of men and rocks that came to life. So we called them "gods" and "demons", begged them to spare us, and prayed for salvation.
        </p>
        <p>
          In time, their numbers dwindled and ours rose. The world began to make more sense when there were fewer things to fear, yet the unexplained can never truly go away, as if the universe demands the absurd and impossible.
        </p>
        <p>
          Mankind must not go back to hiding in fear. No one else will protect us, and we must stand up for ourselves.
        </p>
        <p>
          While the rest of mankind dwells in the light, we must stand in the darkness to fight it, contain it, and shield it from the eyes of the public, so that others may live in a sane and normal world.
        </p>
      </section>
      <?php

    }

    if (isset($_GET['del'])) {
      $ID = (int)$_GET['del'];
      $delete = $connection->prepare("DELETE FROM SCP WHERE id=?");
      $delete->bind_param("i", $ID);

      if ($delete->execute()) {
        echo "<p class='alert alert-success mt-3'>Record deleted</p>";
      } else {
        echo "<p class='alert alert-danger mt-3'>Error: {$delete->error}</p>";
      }
    }
  ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
