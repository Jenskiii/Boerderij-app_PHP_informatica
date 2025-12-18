<?php
// get image path + change name if duplicate
function getImagePath($uploadedImage)
{
  // get image path
  $pathinfo = pathinfo($uploadedImage["name"]);
  // remove special characters from filename
  $base = $pathinfo["filename"];
  $base = preg_replace("/[^\w-]/", "_", $base);
  $filename = $base . "." . $pathinfo["extension"];

  // File destination
  $destination = 'assets/images/uploaded/' . $filename;

  // check if filename already excists inside the folder
  // if true, rename with ($i)filename
  $i = 1;
  while (file_exists($destination)) {
    $filename = $base . "($i)." . $pathinfo["extension"];
    $destination = 'assets/images/uploaded/' . $filename;
    $i++;
  }

  return $destination;
}

// handle upload image
function handleImageUpload($uploadedImage)
{
  // if no image uploaded return + send message
  if ($uploadedImage["error"] !== UPLOAD_ERR_OK) {

    switch ($uploadedImage["error"]) {
      case UPLOAD_ERR_PARTIAL:
        header("Location: /product?error=incomplete_file");
        exit;
      case UPLOAD_ERR_NO_FILE:
        header("Location: /product?error=no_file");
        exit;
      case UPLOAD_ERR_EXTENSION:
        header("Location: /product?error=upload_stopped");
        exit;
      case UPLOAD_ERR_INI_SIZE:
        header("Location: /product?error=file_too_large");
        exit;
      case UPLOAD_ERR_NO_TMP_DIR:
        header("Location: /product?error=no_tempfolder");
        exit;
      case UPLOAD_ERR_CANT_WRITE:
        header("Location: /product?error=no_save");
        exit;
      default:
        header("Location: /product?error=unknown_error");
        exit;
    }
  }

  // check file size
  if ($uploadedImage['size'] > 1048576) {
    header("Location: /product?error=file_too_large");
    exit;
  }

  // check file type
  $mime_types = ['image/jpeg', 'image/png'];
  if (!in_array($uploadedImage["type"], $mime_types)) {
    header("Location: /product?error=invalid_type");
    exit;
  }

  // get file path / name
  getImagePath($uploadedImage);

  // upload image to assets/images/uploaded/
  if (!move_uploaded_file($uploadedImage['tmp_name'], getImagePath($uploadedImage))) {
    header("Location: /product?error=move_upload");
    exit;
  }
}