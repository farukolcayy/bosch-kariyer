<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tedarik Zinciri Mühendisi-Başvurular</title>

    <head>
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Poppins:300,400,500,600,700|PT+Serif:400,400i&display=swap" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
        <link rel="stylesheet" href="css/bs-datatable.css" type="text/css" />
        <link rel="stylesheet" href="css/style.css?=1.2" type="text/css" />
        <link rel="shortcut icon" type="image/png" href="images/favicon-png.png" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
    </head>
</head>

<body>
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
        </svg></div>
    <!-- Content
		============================================= -->
    <section id="content">
        <div class="content-wrap">
            <div class="container clearfix" style="padding-top: 100px;">
                <div class="row">
                    <div class="col-md-3">
                        <a id="exportButton" class="button button-3d button-rounded button-blue"><i class="icon-book3"></i>Dışa Aktar</a>
                    </div>
                    <div class="col-md-3">
                        <a id="totalApply" style="border: 2px solid red;padding:10px;"></a>
                    </div>
                    <div class="col-md-3" style="float: right;">
                        <a id="exportCv" class="button button-3d button-rounded button-blue"><i class="icon-book3"></i>Tüm CV'leri indir</a>
                    </div>
                </div>
                <div class="table-responsive" style="margin-top: 100px;">
                    <table style="display:none;" id="datatable2">
                        <thead>
                            <tr>
                                <!-- <th>Id</th> -->
                                <th>Ad-Soyad</th>
                                <th>Telefon</th>
                                <th>E-mail</th>
                                <th>Üniversite</th>
                                <th>Bölüm</th>
                                <th>Mezuniyet Yılı</th>
                                <th>Başvuru Tarihi</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            //database details
                            $dbHost     = '5.2.84.96';
                            $dbUsername = 'badiworks_bosch';
                            $dbPassword = 'Ok?2021?.';
                            $dbName     = 'badiworks_bosch';

                            //create connection and select DB
                            $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
                            $db->set_charset("utf8");
                            if ($db->connect_error) {
                                die("Bağlantı hatası: " . $db->connect_error);
                            }

                            //get user data from the database
                            $query = $db->query("SELECT * FROM tedarik_zinciri_muhendisi group by emailAddress ORDER BY `tedarik_zinciri_muhendisi`.`dateTime` DESC");

                            while ($row = $query->fetch_assoc()) {
                                echo '<tr>';
                                // echo '<td>' . $row['Id'] . '</td>';
                                echo '<td>' . $row['nameSurname'] . '</td>';
                                echo '<td>' . $row['phoneNumber'] . '</td>';
                                echo '<td>' . $row['emailAddress'] . '</td>';
                                echo '<td>' . $row['university'] . '</td>';
                                echo '<td>' . $row['department'] . '</td>';
                                echo '<td>' . $row['graduationYear'] . '</td>';
                                echo '<td>' . $row['dateTime'] . '</td>';
                                echo '</tr>';
                            }

                            ?>
                        </tbody>
                    </table>

                    <table id="datatable1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <!-- <th>Id</th> -->
                                <th>Ad-Soyad</th>
                                <th>Telefon</th>
                                <th>E-mail</th>
                                <th>Üniversite</th>
                                <th>Bölüm</th>
                                <th>Mezuniyet Yılı</th>
                                <th>Başvuru Tarihi</th>
                                <th>CV</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //database details
                            $dbHost     = '5.2.84.96';
                            $dbUsername = 'badiworks_bosch';
                            $dbPassword = 'Ok?2021?.';
                            $dbName     = 'badiworks_bosch';

                            //create connection and select DB
                            $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
                            $db->set_charset("utf8");
                            if ($db->connect_error) {
                                die("Bağlantı hatası: " . $db->connect_error);
                            }

                            //get user data from the database
                            $query = $db->query("SELECT * FROM tedarik_zinciri_muhendisi group by emailAddress ORDER BY `tedarik_zinciri_muhendisi`.`dateTime` DESC");

                            while ($row = $query->fetch_assoc()) {
                                echo '<tr>';
                                // echo '<td>' . $row['Id'] . '</td>';
                                echo '<td>' . $row['nameSurname'] . '</td>';
                                echo '<td>' . $row['phoneNumber'] . '</td>';
                                echo '<td>' . $row['emailAddress'] . '</td>';
                                echo '<td>' . $row['university'] . '</td>';
                                echo '<td>' . $row['department'] . '</td>';
                                echo '<td>' . $row['graduationYear'] . '</td>';
                                echo '<td>' . $row['dateTime'] . '</td>';
                                echo '<td><a href="https://bosch.ogrencikariyeri.com/tedarik-zinciri-muhendisi/uploads/' . $row['cvPath'] . '" download="' . $row['cvPath'] . '" >
                                <img src="images/downloadCv.png" style="max-width:40px;max-height:40px;outline: 0px solid #0782C1;" />
                                </a></td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section><!-- #content end -->

    <script src="js/jquery.js"></script>
    <script src="js/plugins.min.js"></script>

    <!-- Bootstrap Data Table Plugin -->
    <script src="js/bs-datatable.js"></script>

    <script type="text/javascript" src='js/jszip.js'></script>

    <script type="text/javascript" src='js/jszip-utils.js'></script>

    <script type="text/javascript" src='js/FileSaver.js'></script>
    <!-- Footer Scripts
	============================================= -->
    <script src="js/jquery.table2excel.js"></script>

    <script>
        $(document).ready(function() {

            // $('#datatable1').dataTable();
            $('#datatable1').dataTable({
                "ordering": false,
                "pageLength": 10
            });

            $("#exportButton").click(function() {
                $("#datatable2").table2excel({
                    name: "Başvurular",
                    filename: "Tedarik Zinciri Mühendisi Başvuruları", //do not include extension
                    fileext: ".xls" // file extension
                });
            });

            $("#exportCv").click(function() {
                $.ajax({
                    url: 'allDownload.php',
                    type: 'post',
                    success: function(response) {
                        console.log(response);
                        window.location = "https://bosch.ogrencikariyeri.com/tedarik-zinciri-muhendisi/ilan-basvuru-listesi/uploads/allCV.zip";
                    }
                });
            });

            $('#ftco-loader').removeClass('show');

            var textUnder = $("#datatable1_info").text();
            $("#totalApply").text("Toplam Başvuru : " + textUnder.substr(0, textUnder.indexOf(' ')));

        });
    </script>
</body>

</html>
