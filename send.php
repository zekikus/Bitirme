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
    if(isset($_POST['submit'])){//kontrol

        if(isset($_POST['title']) && isset($_POST['mesaj'])&& isset($_POST['birimID'])   ){
            $title = $_POST['title'];
            $mesaj = $_POST['mesaj'];
            $birimID = $_POST['birimID'];
        }

        //require_once("baglan.php");//database bağlantısı gercekleştirdik
        require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Kontrol/StokKabulKontrol.php");
        $registration_ids = array();//registration idlerimizi tutacak array ı oluşturuyoruz

        $kontrol = new StokKabulKontrol();

        $sql = "SELECT * FROM kullanici WHERE birimID = '$birimID'";
        $result = $kontrol -> listele($sql);
        //$result = mysqli_query($con, $sql);//sorguyu çalıştırıyoruz
        while($row = mysqli_fetch_assoc($result)){
          if ($row['registration_id'] != '') {
            # code...
            array_push($registration_ids, $row['registration_id']);//databaseden dönen registration idleri
            echo $row['registration_id']."</br>";
          }
        }

        //buradan sonra google..
        $firebase_url = 'https://fcm.googleapis.com/fcm/send';

        //single token = ('to' => $token) X multiple tokens = ('registration_ids' => '$registrationIds')
        //'registration_ids' => '$registration_ids', //KULLANICI TOKEN -> Kullanıcı telefonunda oluşan Token
        /*$token = 'eaG8uCmQcZ4:APA91bGZdVh32cxRMFScQz46pfI4wdQoDe_eeEqJWuRGUb6iNF9Mxc8JgcpJkbrsA2RLuC-Awp8tEVC4D2-eHikYGe24-TH1sQhLT6LGi-rco7KweMDiPC4DA9IB5ghlBTghUJdA_fqS';
        $fields = array(
            'to' => $token, //KULLANICI TOKEN -> Kullanıcı telefonunda oluşan Token
            'notification' => array('title' => 'Mobilhanem.com', 'body' => 'Mobilhanem.com Firebase Push Mesaj'), //Notification tipinde mesaj
            'data' => array('site_adi' => 'Mobilhanem.com','site_linki'=>'https://www.mobilhanem.com') //data tipinde mesaj
        );
        */






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

/*
        // GCM servicelerine gidecek veri
        //Arkadaşlar aşşağıdaki PHP kodlarıyla oynamıyoruz. Bu Google 'n bizden kullanmamızı istediği kodlar
        //Sadece registration_ids,mesaj ve Authorization: key değerlerini değiştiriyoruz
        $url = 'https://android.googleapis.com/gcm/send';

        $mesaj = array("notification_message" => $_POST['mesaj']); //gönderdiğimiz mesaj POST 'tan alıyoruz.Androidde okurken notification_message değerini kullanacağız
        $fields = array(
        'registration_ids' => $registatoin_ids,
        'data' => $mesaj,
        );

        //Alttaki Authorization: key= kısmına Google Apis kısmında oluşturduğumuz key'i yazacağız
        $headers = array(
        'Authorization: key=AIzaSyAO_9WhovCQ_fdLWf_cjgR8zMFJhk1Cc-4',
        'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);
*/


    }
    ?>

  <form method="post" action="send.php">


    <label>Başlık : </label><input type="text" name="title" /> <br/> <br/>
    <label>Açıklama : </label><input type="text" name="mesaj" /> <br/> <br/>
    <label>Birim ID : </label><input type="text" name="birimID" /> <br/> <br/>
    <input type="submit" name="submit" value="Gönder" />

  </form>

</body>
</html>
