<?php
include_once 'header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script>
    const myModal = document.getElementById('myModal')
    const myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', () => {
      myInput.focus()
    })
  </script>
  <title>Search</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');

    body {
      font-family: "Poppins";
    }

    input {
      padding: 8px 10px;
    }
  </style>
</head>

<body>
  <div class="container d-flex justify-content-between my-4">
    <h1>Search</h1>
    <div>
      <label>Search</label>
      <input type="search" id="values">
      <a href="create.php" class="btn btn-primary">Filter</a>
      <a href="index.php" class="btn btn-primary">Back</a>
    </div>
  </div>
  <div class="search">



  </div>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>#</th>
        <th>Title</th>
        <th>Subtitle</th>
        <th>Synopsis</th>
        <th>Genre</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>

      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Launch static backdrop modal
      </button>

      <!-- Modal -->
      <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              ...
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Understood</button>
            </div>
          </div>
        </div>
      </div>
      <?php require_once('footer.php') ?>