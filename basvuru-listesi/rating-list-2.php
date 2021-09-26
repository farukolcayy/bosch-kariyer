<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Anket Sonuçları</title>

    <head>
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Poppins:300,400,500,600,700|PT+Serif:400,400i&display=swap" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="/basvuru-listesi/css/bootstrap.css" type="text/css" />
        <link rel="stylesheet" href="/basvuru-listesi/css/bs-datatable.css" type="text/css" />
        <link rel="shortcut icon" type="image/png" href="/assets/img/favicon.png" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
    </head>
</head>
<style>
    #datatable1 .row {
        margin-right: 0px !important;
        margin-left: 0px !important;
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
                    <div class="col-md-12" style="text-align: center;">
                        <h2>Mini Anket Sonuçları</h2>
                    </div>
                </div>
                <div class="table-responsive" style="margin-top: 100px;">

                    <table id="datatable1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>En az bir kariyer sitesinde güncel özgeçmişim var</th>
                                <th>Başvurduğum ilanlar üzerinden en az bir mülakat deneyimi yaşadım</th>
                                <th>Zorunlu ya da gönüllü olarak en az bir staj yaptım</th>
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
                            $query = $db->query("SELECT substr(ratingScore,1,1) as 'rate1', substr(ratingScore,3,1) as 'rate2', substr(ratingScore,5,1) as 'rate3' FROM live_rating_2 where instructor like '%Zafer Yıldırım%'");


                            $rate1_1 = 0;
                            $rate1_2 = 0;
                            $rate2_1 = 0;
                            $rate2_2 = 0;
                            $rate3_1 = 0;
                            $rate3_2 = 0;

                            $totalRate = 0;

                            while ($row = $query->fetch_assoc()) {
                                if ($row['rate1'] == '1') {
                                    $rate1_1 += 1;
                                } else {
                                    $rate1_2 += 1;
                                }

                                if ($row['rate2'] == '1') {
                                    $rate2_1 += 1;
                                } else {
                                    $rate2_2 += 1;
                                }

                                if ($row['rate3'] == '1') {
                                    $rate3_1 += 1;
                                } else {
                                    $rate3_2 += 1;
                                }

                                $totalRate += 1;
                            }


                            echo '<tr>';
                            echo '<td><div class="row"><div class="col-md-6" style="border: 1px solid orange;font-style: italic;">Toplam cevap:</div><div class="col-md-6" style="border: 1px solid #2dd000;font-weight: bolder;">' . $totalRate . '</div></div><div class="row"><div class="col-md-6" style="border: 1px solid orange;font-style: italic;">Evet:</div><div class="col-md-6" style="border: 1px solid #2dd000;font-weight: bolder;">' . $rate1_1 . '</div></div><div class="row"><div class="col-md-6" style="border: 1px solid orange;font-style: italic;">Hayır:</div><div class="col-md-6" style="border: 1px solid #2dd000;font-weight: bolder;">' . $rate1_2 . '</div></div></td>';
                            echo '<td><div class="row"><div class="col-md-6" style="border: 1px solid orange;font-style: italic;">Toplam cevap:</div><div class="col-md-6" style="border: 1px solid #2dd000;font-weight: bolder;">' . $totalRate . '</div></div><div class="row"><div class="col-md-6" style="border: 1px solid orange;font-style: italic;">Evet:</div><div class="col-md-6" style="border: 1px solid #2dd000;font-weight: bolder;">' . $rate2_1 . '</div></div><div class="row"><div class="col-md-6" style="border: 1px solid orange;font-style: italic;">Hayır:</div><div class="col-md-6" style="border: 1px solid #2dd000;font-weight: bolder;">' . $rate2_2 . '</div></div></td>';
                            echo '<td><div class="row"><div class="col-md-6" style="border: 1px solid orange;font-style: italic;">Toplam cevap:</div><div class="col-md-6" style="border: 1px solid #2dd000;font-weight: bolder;">' . $totalRate . '</div></div><div class="row"><div class="col-md-6" style="border: 1px solid orange;font-style: italic;">Evet:</div><div class="col-md-6" style="border: 1px solid #2dd000;font-weight: bolder;">' . $rate3_1 . '</div></div><div class="row"><div class="col-md-6" style="border: 1px solid orange;font-style: italic;">Hayır:</div><div class="col-md-6" style="border: 1px solid #2dd000;font-weight: bolder;">' . $rate3_2 . '</div></div></td>';
                            echo '</tr>';

                            echo '<tr>';
                            echo '<td><div class="row"><div class="col-md-12" style="text-align:center;"><p style="font-weight: bolder;font-size:26px;">' . $rate1_1 . '/' . $rate1_2 . '</p></div></div></td>';
                            echo '<td><div class="row"><div class="col-md-12" style="text-align:center;"><p style="font-weight: bolder;font-size:26px;">' . $rate2_1 . '/' . $rate2_2 . '</p></div></div></td>';
                            echo '<td><div class="row"><div class="col-md-12" style="text-align:center;"><p style="font-weight: bolder;font-size:26px;">' . $rate3_1 . '/' . $rate3_2 . '</p></div></div></td>';
                            echo '</tr>';

                            ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>

    <script src="/basvuru-listesi/js/jquery.js"></script>
    <script src="/basvuru-listesi/js/plugins.min.js"></script>
    <script src="/basvuru-listesi/js/bs-datatable.js"></script>

    <script>
        $(document).ready(function() {

            var checkSecurity = localStorage.getItem("loginGlobalBilgi");

            if (checkSecurity != "c25b4a830d05a822f8b658f99f0c44dc") {
                alert("Yetkisiz giriş!");
                window.location.href = 'https://globalbilgi.ogrencikariyeri.com/basvuru-listesi/';
            }

            $('#datatable1').dataTable({
                "ordering": false,
                "pageLength": 10
            });

            $('#ftco-loader').removeClass('show');
        });
    </script>
</body>

</html>