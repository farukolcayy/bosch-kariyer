<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GlobalBilgi Sorular</title>

    <head>
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Poppins:300,400,500,600,700|PT+Serif:400,400i&display=swap" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="/basvuru-listesi/css/bootstrap.css" type="text/css" />
        <link rel="stylesheet" href="/basvuru-listesi/css/bs-datatable.css" type="text/css" />
        <link rel="shortcut icon" type="image/png" href="/assets/img/favicon.png" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
    </head>
</head>
<style>
    #exportButton {
        cursor: pointer;
        border: 3px solid black;
        color: white;
        padding: 10px;
        background-color: #007bff;
        border-radius: 8px;
    }

    #exportButton:active {
        transform: scale(1.1);
        /* Scaling button to 0.98 to its original size */
        box-shadow: 3px 2px 22px 1px rgba(0, 0, 0, 0.60);
        /* Lowering the shadow */
    }


    #ftco-loader {
        position: fixed;
        width: 96px;
        height: 96px;
        left: 50%;
        top: 50%;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        background-color: rgba(255, 255, 255, 0.9);
        -webkit-box-shadow: 0px 24px 64px rgba(0, 0, 0, 0.24);
        box-shadow: 0px 24px 64px rgba(0, 0, 0, 0.24);
        border-radius: 16px;
        opacity: 0;
        visibility: hidden;
        -webkit-transition: opacity .2s ease-out, visibility 0s linear .2s;
        -o-transition: opacity .2s ease-out, visibility 0s linear .2s;
        transition: opacity .2s ease-out, visibility 0s linear .2s;
        z-index: 1000;
    }

    #ftco-loader.fullscreen {
        padding: 0;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        -webkit-transform: none;
        -ms-transform: none;
        transform: none;
        background-color: #fff;
        border-radius: 0;
        -webkit-box-shadow: none;
        box-shadow: none;
    }

    #ftco-loader.show {
        -webkit-transition: opacity .4s ease-out, visibility 0s linear 0s;
        -o-transition: opacity .4s ease-out, visibility 0s linear 0s;
        transition: opacity .4s ease-out, visibility 0s linear 0s;
        visibility: visible;
        opacity: 1;
    }

    #ftco-loader .circular {
        -webkit-animation: loader-rotate 2s linear infinite;
        animation: loader-rotate 2s linear infinite;
        position: absolute;
        left: calc(50% - 24px);
        top: calc(50% - 24px);
        display: block;
        -webkit-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        transform: rotate(0deg);
    }

    #ftco-loader .path {
        stroke-dasharray: 1, 200;
        stroke-dashoffset: 0;
        -webkit-animation: loader-dash 1.5s ease-in-out infinite;
        animation: loader-dash 1.5s ease-in-out infinite;
        stroke-linecap: round;
    }

    @-webkit-keyframes loader-rotate {
        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @keyframes loader-rotate {
        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @-webkit-keyframes loader-dash {
        0% {
            stroke-dasharray: 1, 200;
            stroke-dashoffset: 0;
        }

        50% {
            stroke-dasharray: 89, 200;
            stroke-dashoffset: -35px;
        }

        100% {
            stroke-dasharray: 89, 200;
            stroke-dashoffset: -136px;
        }
    }

    @keyframes loader-dash {
        0% {
            stroke-dasharray: 1, 200;
            stroke-dashoffset: 0;
        }

        50% {
            stroke-dasharray: 89, 200;
            stroke-dashoffset: -35px;
        }

        100% {
            stroke-dasharray: 89, 200;
            stroke-dashoffset: -136px;
        }
    }

    .copy-button {
        border: 2px solid #2121af;
        background: #f0ff0a;
        color: black;
        border-radius: 4px;
        padding: 7px;
        cursor: pointer;
    }

    .copy-button:active {
        transform: scale(0.99);
        /* Scaling button to 0.98 to its original size */
        box-shadow: 3px 2px 22px 1px rgba(0, 0, 0, 0.60);
        /* Lowering the shadow */
    }
</style>

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
                </div>
                <div class="table-responsive" style="margin-top: 100px;">
                    <table style="display:none;" id="datatable2">
                        <thead>
                            <tr>
                                <!-- <th>Id</th> -->
                                <th>Ad-Soyad</th>
                                <th>E-mail</th>
                                <th>Soru</th>
                                <th>Tarih</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            //database details
                            $dbHost     = '185.8.128.171';
                            $dbUsername = 'badiworks_global';
                            $dbPassword = '!tgb!2021!';
                            $dbName     = 'badiworks_global';

                            //create connection and select DB
                            $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
                            $db->set_charset("utf8");
                            if ($db->connect_error) {
                                die("Bağlantı hatası: " . $db->connect_error);
                            }

                            //get user data from the database
                            $query = $db->query("SELECT * FROM questions group by question ORDER BY `questions`.`dateTime` DESC");

                            while ($row = $query->fetch_assoc()) {
                                echo '<tr>';
                                // echo '<td>' . $row['Id'] . '</td>';
                                echo '<td>' . $row['nameSurname'] . '</td>';
                                echo '<td>' . $row['emailAddress'] . '</td>';
                                echo '<td>' . $row['question'] . '</td>';
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
                                <th>E-mail</th>
                                <th>Soru</th>
                                <th>Tarih</th>
                                <th>İşlem</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            //database details
                            $dbHost     = '185.8.128.171';
                            $dbUsername = 'badiworks_tofas';
                            $dbPassword = 'Ok?2021?.';
                            $dbName     = 'badiworks_tofas';

                            //create connection and select DB
                            $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
                            $db->set_charset("utf8");
                            if ($db->connect_error) {
                                die("Bağlantı hatası: " . $db->connect_error);
                            }

                            //get user data from the database
                            $query = $db->query("SELECT * FROM questions group by question ORDER BY `questions`.`dateTime` DESC");

                            while ($row = $query->fetch_assoc()) {
                                echo '<tr>';
                                // echo '<td>' . $row['Id'] . '</td>';
                                echo '<td>' . $row['nameSurname'] . '</td>';
                                echo '<td>' . $row['emailAddress'] . '</td>';
                                echo '<td>' . $row['question'] . '</td>';
                                echo '<td>' . $row['dateTime'] . '</td>';
                                echo '<td><button class="copy-button" data-name="' . $row['nameSurname'] . '" data-question="' . $row['question'] . '">Kopyala</button></td>';
                                echo '</tr>';
                            }

                            ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section><!-- #content end -->

    <script src="/basvuru-listesi/js/jquery.js"></script>
    <script src="/basvuru-listesi/js/plugins.min.js"></script>

    <!-- Bootstrap Data Table Plugin -->
    <script src="/basvuru-listesi/js/bs-datatable.js"></script>

    <!-- Footer Scripts
	============================================= -->
    <script src="/basvuru-listesi/js/jquery.table2excel.js"></script>
    <script>
        $(document).ready(function() {

            var checkSecurity = localStorage.getItem("loginGlobalBilgi");

            if (checkSecurity != "c25b4a830d05a822f8b658f99f0c44dc") {
                alert("Yetkisiz giriş!");
                window.location.href = 'https://globalbilgi.ogrencikariyeri.com/basvuru-listesi/';
            }

            // $('#datatable1').dataTable();
            $('#datatable1').dataTable({
                "ordering": true,
                "pageLength": 10
            });

            $("#exportButton").click(function() {
                $("#datatable2").table2excel({
                    name: "Sorular",
                    filename: "GlobalBilgi Sorular", //do not include extension
                    fileext: ".xls" // file extension
                });
            });

            $('#ftco-loader').removeClass('show');

            var textUnder = $("#datatable1_info").text();
            $("#totalApply").text("Toplam Soru : " + textUnder.substr(0, textUnder.indexOf(' ')));

        });
    </script>
</body>

</html>