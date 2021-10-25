<?php
$ds = DIRECTORY_SEPARATOR;  //1

$storeFolder = 'uploads';   //2
$cvPath = "";

$email = $_POST['email'];

if (!empty($_FILES)) {

    $tempFile = $_FILES['file']['tmp_name'];          //3             

    $targetPath = dirname(__FILE__) . $ds . $storeFolder . $ds;  //4

    $targetFile =  $targetPath . $email . "_CV.pdf";  //5

    $cvPath = $email . "_CV.pdf";

    move_uploaded_file($tempFile, $targetFile); //6

    $link = mysqli_connect("5.2.84.96", "badiworks_bosch", "Ok?2021?.", "badiworks_bosch");

    // Check connection
    if ($link === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    $sql = "UPDATE uretim_muhendisi_1 SET cvPath='$cvPath' WHERE emailAddress='$email'";

    mysqli_set_charset($link, "utf8");
    if (mysqli_query($link, $sql)) {
        echo "Başvurunuz Kaydedildi";
    } else {
        echo "Hata: Başvuru başarısız!";
    }
    mysqli_close($link);
}
