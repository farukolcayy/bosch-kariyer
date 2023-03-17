<?php

$nameSurname = $_POST['nameSurname'];
$phoneNumber = $_POST['phoneNumber'];
$emailAddress = $_POST['emailAddress'];
$university = $_POST['university'];
$department = $_POST['department'];
// $class = $_POST['selectClass'];
$graduatedYear = $_POST['graduatedYear'];
// $studentType = $_POST['studentType'];


$data = array();

// $data['status'] = 'err';
// $data['result'] = 'Başvuru sürecimiz dolmuştur. İlginiz için teşekkürler';
// echo json_encode($data);

try {

    if (!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
        $data['status'] = 'err';
        $data['result'] = 'Geçersiz Email adresi girdiniz!';
        echo json_encode($data);
        return;
    }

    if (!empty($nameSurname) && strlen($phoneNumber) > 15 && !empty($university) && !empty($department) && $university != "Üniversite Seçiniz...") {
        $conn = new PDO(-);
        $query = $conn->prepare("INSERT INTO tedarik_zinciri_muhendisi SET
        nameSurname = ?,
        phoneNumber = ?,
        emailAddress = ?,
        university = ?,
        department = ?,
        graduationYear = ?");

        $insert = $query->execute(array($nameSurname, $phoneNumber, $emailAddress, $university, $department, $graduatedYear));

        if ($insert) {
            $last_id = $conn->lastInsertId();
            $data['status'] = 'ok';
            $data['result'] = $last_id;
            echo json_encode($data);
        } else {
            $data['status'] = 'err';
            $data['result'] = 'Başvuru Başarısız!';
            echo json_encode($data);
        }
    } else {
        $data['status'] = 'err';
        $data['result'] = 'Tüm alanlar doldurulmalı!';
        echo json_encode($data);
        return;
    }
} catch (PDOexception $exe) {

    $data['status'] = 'err';
    $data['result'] = $exe->getMessage();
    echo json_encode($data);
}
