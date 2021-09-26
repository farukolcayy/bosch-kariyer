<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Değerlendirme Sonuçları</title>

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
                </div>
                <div class="table-responsive" style="margin-top: 100px;">
                    <table style="display:none;" id="datatable2">
                        <thead>
                            <tr>
                                <th>Eğitmen</th>
                                <th>Etkinlikte içerikler amacına yönelik hazırlanmış ve tatmin ediciydi</th>
                                <th>Etkinliğin duyurulma şekli ve iletişimi başarılıydı</th>
                                <th>Bu etkinliği arkadaşlarıma rahatlıkla tavsiye ederim</th>
                                <th>Genel olarak etkinliği nasıl buldunuz?</th>
                                <th>Toplam Oylama</th>
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
                            $query = $db->query("
                            SELECT count(*) as 'toplam',instructor,
CASE
    WHEN round(avg(substr(ratingScore,1,1)),1)+0 >=1 and  round(avg(substr(ratingScore,1,1)),1)+0 <2 THEN 'Hiç Katılmıyorum'
    WHEN round(avg(substr(ratingScore,1,1)),1)+0 >=2 and  round(avg(substr(ratingScore,1,1)),1)+0 <3 THEN 'Katılmıyorum'
    WHEN round(avg(substr(ratingScore,1,1)),1)+0 >=3 and  round(avg(substr(ratingScore,1,1)),1)+0 <4 THEN 'Kısmen Katılıyorum'
    WHEN round(avg(substr(ratingScore,1,1)),1)+0 >=4 and  round(avg(substr(ratingScore,1,1)),1)+0 <5 THEN 'Katılıyorum'
    WHEN round(avg(substr(ratingScore,1,1)),1)+0 >=5 THEN 'Kesinlikle Katılıyorum'
    ELSE 'Geçersiz Oylama'
END AS 'Rate1', 
CASE
    WHEN round(avg(substr(ratingScore,3,1)),1)+0 >=1 and  round(avg(substr(ratingScore,1,1)),1)+0 <2 THEN 'Hiç Katılmıyorum'
    WHEN round(avg(substr(ratingScore,3,1)),1)+0 >=2 and  round(avg(substr(ratingScore,1,1)),1)+0 <3 THEN 'Katılmıyorum'
    WHEN round(avg(substr(ratingScore,3,1)),1)+0 >=3 and  round(avg(substr(ratingScore,1,1)),1)+0 <4 THEN 'Kısmen Katılıyorum'
    WHEN round(avg(substr(ratingScore,3,1)),1)+0 >=4 and  round(avg(substr(ratingScore,1,1)),1)+0 <5 THEN 'Katılıyorum'
    WHEN round(avg(substr(ratingScore,3,1)),1)+0 >=5 THEN 'Kesinlikle Katılıyorum'
    ELSE 'Geçersiz Oylama'
END AS 'Rate2',
CASE
    WHEN round(avg(substr(ratingScore,5,1)),1)+0 >=1 and  round(avg(substr(ratingScore,1,1)),1)+0 <2 THEN 'Hiç Katılmıyorum'
    WHEN round(avg(substr(ratingScore,5,1)),1)+0 >=2 and  round(avg(substr(ratingScore,1,1)),1)+0 <3 THEN 'Katılmıyorum'
    WHEN round(avg(substr(ratingScore,5,1)),1)+0 >=3 and  round(avg(substr(ratingScore,1,1)),1)+0 <4 THEN 'Kısmen Katılıyorum'
    WHEN round(avg(substr(ratingScore,5,1)),1)+0 >=4 and  round(avg(substr(ratingScore,1,1)),1)+0 <5 THEN 'Katılıyorum'
    WHEN round(avg(substr(ratingScore,5,1)),1)+0 >=5 THEN 'Kesinlikle Katılıyorum'
    ELSE 'Geçersiz Oylama'
END AS 'Rate3',
CASE
    WHEN round(avg(substr(ratingScore,7,1)),1)+0 >=1 and  round(avg(substr(ratingScore,1,1)),1)+0 <2 THEN 'Hiç Katılmıyorum'
    WHEN round(avg(substr(ratingScore,7,1)),1)+0 >=2 and  round(avg(substr(ratingScore,1,1)),1)+0 <3 THEN 'Katılmıyorum'
    WHEN round(avg(substr(ratingScore,7,1)),1)+0 >=3 and  round(avg(substr(ratingScore,1,1)),1)+0 <4 THEN 'Kısmen Katılıyorum'
    WHEN round(avg(substr(ratingScore,7,1)),1)+0 >=4 and  round(avg(substr(ratingScore,1,1)),1)+0 <5 THEN 'Katılıyorum'
    WHEN round(avg(substr(ratingScore,7,1)),1)+0 >=5 THEN 'Kesinlikle Katılıyorum'
    ELSE 'Geçersiz Oylama'
END AS 'Rate4'
FROM live_rating  where instructor like '%Zafer Yıldırım%'
                            ");

                            while ($row = $query->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td>' . $row['instructor'] . '</td>';
                                echo '<td>' . $row['Rate1'] . '</td>';
                                echo '<td>' . $row['Rate2'] . '</td>';
                                echo '<td>' . $row['Rate3'] . '</td>';
                                echo '<td>' . $row['Rate4'] . '</td>';
                                echo '<td>' . $row['toplam'] . '</td>';
                                echo '</tr>';
                            }

                            ?>
                        </tbody>
                    </table>

                    <table id="datatable1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Eğitmen</th>
                                <th>Etkinlikte içerikler amacına yönelik hazırlanmış ve tatmin ediciydi</th>
                                <th>Etkinliğin duyurulma şekli ve iletişimi başarılıydı</th>
                                <th>Bu etkinliği arkadaşlarıma rahatlıkla tavsiye ederim</th>
                                <th>Genel olarak etkinliği nasıl buldunuz?</th>
                                <th>Toplam Oylama</th>
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

                            $query = $db->query("
                            SELECT count(*) as 'toplam',instructor,
CASE
    WHEN round(avg(substr(ratingScore,1,1)),1)+0 >=1 and  round(avg(substr(ratingScore,1,1)),1)+0 <1.5 THEN 'Hiç Katılmıyorum'
    WHEN round(avg(substr(ratingScore,1,1)),1)+0 >=1.5 and  round(avg(substr(ratingScore,1,1)),1)+0 <2.5 THEN 'Katılmıyorum'
    WHEN round(avg(substr(ratingScore,1,1)),1)+0 >=2.5 and  round(avg(substr(ratingScore,1,1)),1)+0 <3.5 THEN 'Kısmen Katılıyorum'
    WHEN round(avg(substr(ratingScore,1,1)),1)+0 >=3.5 and  round(avg(substr(ratingScore,1,1)),1)+0 <4.5 THEN 'Katılıyorum'
    WHEN round(avg(substr(ratingScore,1,1)),1)+0 >=4.5 THEN 'Kesinlikle Katılıyorum'
    ELSE 'Geçersiz Oylama'
END AS 'Rate1', 
CASE
    WHEN round(avg(substr(ratingScore,3,1)),1)+0 >=1 and  round(avg(substr(ratingScore,3,1)),1)+0 <1.5 THEN 'Hiç Katılmıyorum'
    WHEN round(avg(substr(ratingScore,3,1)),1)+0 >=1.5 and  round(avg(substr(ratingScore,3,1)),1)+0 <2.5 THEN 'Katılmıyorum'
    WHEN round(avg(substr(ratingScore,3,1)),1)+0 >=2.5 and  round(avg(substr(ratingScore,3,1)),1)+0 <3.5 THEN 'Kısmen Katılıyorum'
    WHEN round(avg(substr(ratingScore,3,1)),1)+0 >=3.5 and  round(avg(substr(ratingScore,3,1)),1)+0 <4.5 THEN 'Katılıyorum'
    WHEN round(avg(substr(ratingScore,3,1)),1)+0 >=4.5 THEN 'Kesinlikle Katılıyorum'
    ELSE 'Geçersiz Oylama'
END AS 'Rate2',
CASE
    WHEN round(avg(substr(ratingScore,5,1)),1)+0 >=1 and  round(avg(substr(ratingScore,5,1)),1)+0 <1.5 THEN 'Hiç Katılmıyorum'
    WHEN round(avg(substr(ratingScore,5,1)),1)+0 >=1.5 and  round(avg(substr(ratingScore,5,1)),1)+0 <2.5 THEN 'Katılmıyorum'
    WHEN round(avg(substr(ratingScore,5,1)),1)+0 >=2.5 and  round(avg(substr(ratingScore,5,1)),1)+0 <3.5 THEN 'Kısmen Katılıyorum'
    WHEN round(avg(substr(ratingScore,5,1)),1)+0 >=3.5 and  round(avg(substr(ratingScore,5,1)),1)+0 <4.5 THEN 'Katılıyorum'
    WHEN round(avg(substr(ratingScore,5,1)),1)+0 >=4.5 THEN 'Kesinlikle Katılıyorum'
    ELSE 'Geçersiz Oylama'
END AS 'Rate3',
CASE
    WHEN round(avg(substr(ratingScore,7,1)),1)+0 >=1 and  round(avg(substr(ratingScore,7,1)),1)+0 <1.5 THEN 'Çok Kötü'
    WHEN round(avg(substr(ratingScore,7,1)),1)+0 >=1.5 and  round(avg(substr(ratingScore,7,1)),1)+0 <2.5 THEN 'Kötü'
    WHEN round(avg(substr(ratingScore,7,1)),1)+0 >=2.5 and  round(avg(substr(ratingScore,7,1)),1)+0 <3.5 THEN 'Daha İyi Olabilirdi'
    WHEN round(avg(substr(ratingScore,7,1)),1)+0 >=3.5 and  round(avg(substr(ratingScore,7,1)),1)+0 <4.5 THEN 'İyi'
    WHEN round(avg(substr(ratingScore,7,1)),1)+0 >=4.5 THEN 'Çok İyi'
    ELSE 'Geçersiz Oylama'
END AS 'Rate4'
FROM live_rating  where instructor like '%Zafer Yıldırım%'
                            ");

                            while ($row = $query->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td>' . $row['instructor'] . '</td>';
                                echo '<td>' . $row['Rate1'] . '</td>';
                                echo '<td>' . $row['Rate2'] . '</td>';
                                echo '<td>' . $row['Rate3'] . '</td>';
                                echo '<td>' . $row['Rate4'] . '</td>';
                                echo '<td>' . $row['toplam'] . '</td>';
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
                    name: "Oylama Sonuçları",
                    filename: "GlobalBilgi Oylama Sonuçları", //do not include extension
                    fileext: ".xls" // file extension
                });
            });

            $('#ftco-loader').removeClass('show');

            // var textUnder = $("#datatable1_info").text();
            // $("#totalApply").text("Toplam O : " + textUnder.substr(0, textUnder.indexOf(' ')));

        });
    </script>
</body>

</html>