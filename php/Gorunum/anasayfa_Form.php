<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/php/Kontrol/AnasayfaKontrol.php");
  require_once($_SERVER["DOCUMENT_ROOT"]."/Bitirme/ajax/ortakFonksiyonlar.php");
  $myDefines = include($_SERVER["DOCUMENT_ROOT"]."/Bitirme/ajax/myDefines.php");

  $birimID = $_SESSION['kullanici'];
  $sorgu = "SELECT * FROM alarm WHERE sensor_id IN (SELECT sb.sensor_id FROM stok_birim sb WHERE sb.birim_id = ".$birimID.") ORDER BY `id` DESC LIMIT 10";
  if ($birimID == -1) $sorgu = "SELECT * FROM alarm ORDER BY `id` DESC LIMIT 5";
  $kontrol = new AnasayfaKontrol();
  $sonuc = $kontrol -> listele($sorgu);
?>
<body>
  <div class="panel-group">
    <div class="panel panel-info">
      <div class="panel-heading">Alarm Listesi</div>
      <div class="panel-body">
        <table class="table table-striped">
          <tr>
            <?php
              foreach ($myDefines["homeAlarmHeaderNames"] as $headerName)
                echo "<th>".$headerName."</th>";
            ?>
          </tr>
          <?php
            while ($satir = mysqli_fetch_assoc($sonuc)) {
              $alarm_baslangic = $satir['baslangic_zaman'];
              $durum = getAlarmAciliyet($alarm_baslangic);

              echo "<tr>";
        					foreach ($myDefines["homeAlarmColNames"] as $colName)
        						echo "<td>".$satir[$colName]."</td>";
              echo "<td style='color:".$durum[1]."'>".$durum[0]."</td>";
              echo "</tr>";
            }
          ?>
        </table>
      </div>
    </div>

    <div class="panel panel-success">
      <div class="panel-heading">Stok Listesi</div>
      <div class="panel-body">
        <table class="table table-striped">
          <tr>
            <?php
              foreach ($myDefines["homeStokHeaderNames"] as $headerName)
                echo "<th>".$headerName."</th>";
            ?>
          </tr>
          <?php
            $sorgu = "SELECT s.stokbirim_ad,u.ad,COUNT(*) AS Stok_Sayisi FROM stok s,urun u WHERE s.urun_id = u.id and s.stokbirim_id IN (SELECT id FROM stok_birim WHERE stok_birim.birim_id = ".$birimID.") GROUP BY u.ad";
            if ($birimID == -1) $sorgu = "SELECT s.stokbirim_ad,u.ad,COUNT(*) AS Stok_Sayisi FROM stok s,urun u WHERE s.urun_id = u.id and s.stokbirim_id IN (SELECT id FROM stok_birim) GROUP BY u.ad";
            $sonuc = $kontrol -> listele($sorgu);

            while ($satir = mysqli_fetch_assoc($sonuc)) {
              echo "<tr>";
        					foreach ($myDefines["homeStokColNames"] as $colName)
        						echo "<td>".$satir[$colName]."</td>";
              echo "</tr>";
            }
          ?>
        </table>
      </div>
    </div>

    <div class="panel panel-danger">
      <div class="panel-heading">Son Kullanma Tarihi</div>
      <div class="panel-body">
        <table class="table table-striped">
          <tr>
            <?php
              foreach ($myDefines["homeSKTHeaderNames"] as $headerName)
                echo "<th>".$headerName."</th>";
            ?>
          </tr>
          <?php
            $sorgu = "SELECT s.stokbirim_ad,s.tag_id as TagID,u.ad,u.kullanim_suresi FROM stok s,urun u WHERE s.urun_id = u.id and s.stokbirim_id IN (SELECT id FROM stok_birim WHERE stok_birim.birim_id = ".$birimID.")";
            if ($birimID == -1) $sorgu = "SELECT s.stokbirim_ad,s.tag_id as TagID,u.ad,u.kullanim_suresi FROM stok s,urun u WHERE s.urun_id = u.id and s.stokbirim_id IN (SELECT id FROM stok_birim)";
            $sonuc = $kontrol -> listele($sorgu);

            while ($satir = mysqli_fetch_assoc($sonuc)) {
              $kalanZaman = $satir['kullanim_suresi'];
              $durum = getSKTAciliyet($kalanZaman);
              echo "<tr>";
        					foreach ($myDefines["homeSKTColNames"] as $colName)
        						echo "<td>".$satir[$colName]."</td>";
                  echo "<td style='color:".$durum[1]."'>".$durum[0]."</td>";
              echo "</tr>";
            }
          ?>
        </table>
      </div>
    </div>
  <!--Son-->
  </div>
</body>
