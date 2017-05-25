<html>
<head>
<link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
<script src="js/getImage.js"></script>
<meta content="text/html; charset=utf-8" />
<title>GCM Send</title>
<!--[if IE]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<style>
  article, aside, figure, footer, header, hgroup,
  menu, nav, section { display: block; }
</style>

</head>
<body>
  <?php
    if(isset($_GET['title'])){
        require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Kontrol/StokKabulKontrol.php");
        require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/ajax/ortakFonksiyonlar.php");
        date_default_timezone_set('Europe/Istanbul');
        $sensor_id = $_GET['sensorID'];
        $kontrol = new StokKabulKontrol();
        $sorgu = "SELECT a.durum,a.baslangic_zaman,a.bitis_zaman,sc.cihaz_durum,sc.alarm_uret FROM alarm a,sicakliktakipcihazi sc WHERE a.sensor_id = sc.id and sensor_id = '".$sensor_id."'";
        $result = $kontrol -> listele($sorgu);

        while($row = mysqli_fetch_assoc($result)){
          $isActive = $row['durum'];
          $isDevActive = $row['cihaz_durum'];
          $isAlarmActive = $row['alarm_uret'];
          if($isActive && $isDevActive && $isAlarmActive){

            $startDate = $row['baslangic_zaman'];
            $endDate = $row['bitis_zaman'];
            $today =  date("d.m.Y H:i:s");
            $startDiff = compTime($startDate,$today);
            $endDiff = compTime($endDate,$today);

            if(!$startDiff && $endDiff){
              if(isset($_GET['title']) && isset($_GET['mesaj'])&& isset($_GET['birimID'])   ){
                  $title = $_GET['title'];
                  $sicaklik = $_GET['sicaklik'];
                  $mesaj = $_GET['mesaj'].$sicaklik."\nStok Birim:".$_GET['stokBirim'];
                  $birimID = $_GET['birimID'];
              }

              $registration_ids = array();//registration idlerimizi tutacak array ı oluşturuyoruz

              $kontrol = new StokKabulKontrol();

              $sql = "SELECT * FROM kullanici WHERE birimID = '$birimID'";
              $result = $kontrol -> listele($sql);

              while($row = mysqli_fetch_assoc($result)){
                if ($row['registration_id'] != '') {
                  # code...
                  array_push($registration_ids, $row['registration_id']);//databaseden dönen registration idleri
                  echo $row['registration_id']."</br>";
                }
              }

              //buradan sonra google..
              $firebase_url = 'https://fcm.googleapis.com/fcm/send';

              $fields = array(
              'registration_ids' => $registration_ids,
              'priority' => "high",
              'notification' => array(
                  'title' => ''.$title,
                  'body' => ''.$mesaj,
                  'sound' => 'default'),
                  'data' => array('site_adi' => 'akiftas.com','site_linki'=>'https://www.akiftas.com')
              );

              //data tipinde mesaj
       //Notification tipinde mesaj
              $headers = array(
              'Authorization:key=' . 'AIzaSyChzyCBYDPpxaoAxgq1ttAHCeiBpy8zxYk',//AIzaSyAO_9WhovCQ_fdLWf_cjgR8zMFJhk1Cc-4*************AIzaSyBPWs8eHhEuEtzqCEL6tbtIQqcT8kmXbu8
              'Content-Type:application/json'
              ); //SERVER API KEY -> Konsoldan aldık

              $ch = curl_init();

              curl_setopt($ch, CURLOPT_URL, $firebase_url);
              curl_setopt($ch, CURLOPT_POST, true);
              curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
              curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
              curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
              curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

              $result = curl_exec($ch);

              curl_close($ch);

              echo $result;


              $startTime = date("d.m.Y H:i:s");
              $sorgu = "INSERT INTO `sicaklik`(`sensor_id`, `sicaklik_deger`, `kayit_zamani`) VALUES ('".$sensor_id."','".$sicaklik."','".$startTime."')";
              $kontrol -> sorguCalistir($sorgu);
              break;
            }
          }

        }


    }
    ?>
</body>
</html>
