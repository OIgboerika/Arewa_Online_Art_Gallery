<?php
// Handle file upload and database insertion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $target_dir = 'uploads/';
  $target_file = $target_dir . basename($_FILES['artwork']['name']);
  $upload_ok = 1;
  $image_filetype = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

  // Check if image file is an actual image or fake image
  if (isset($_POST['submit'])) {
    $check = getimagesize($_FILES['artwork']['tmp_name']);
    if ($check !== false) {
      $upload_ok = 1;
    } else {
      echo 'File is not an image.';
      $upload_ok = 0;
    }
  }

  // Check if file already exists
  if (file_exists($target_file)) {
    echo 'Sorry, file already exists.';
    $upload_ok = 0;
  }

  // Check file size
  if ($_FILES['artwork']['size'] > 500000) { // Adjust maximum file size as needed
    echo 'Sorry, your file is too large.';
    $upload_ok = 0;
  }

  // Allow certain file formats
  if ($image_filetype != 'jpg' && $image_filetype != 'png' && $image_filetype != 'jpeg' && $image_filetype != 'gif') {
    echo 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
    $upload_ok = 0;
  }

  // Check if $upload_ok is set to 0 by an error
  if ($upload_ok == 0) {
    echo 'Sorry, your file was not uploaded.';
  } else {
    if (move_uploaded_file($_FILES['artwork']['tmp_name'], $target_file)) {
      // Insert artwork data into database (replace with your database logic)
      $artwork_description = $_POST['description'];
      // Database insertion code here...

      echo 'The file ' . htmlspecialchars(basename($_FILES['artwork']['name'])) . ' has been uploaded.';
    } else {
      echo 'Sorry, there was an error uploading your file.';
    }
  }
}
```