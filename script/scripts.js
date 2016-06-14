$(document).ready(function(){
});

 /* --------- Uretici Fonksiyonları ------------- */

function ajaxUreticiKaydet(nesne){

        var islemTip = ajaxKaydet(nesne);
        var bilgi = {
                    ad: $("#ad").val(),
                    ulke : $("#ulke").val(),
                    islem : islemTip
        };

        ajaxFonk(bilgi,'#denemeTablo','ajax/ureticiAjax.php');
        $("#ad,#ulke").val("");   
}
 /* --------- Uretici Fonksiyonları Son ------------- */

/* ---------- Dolap Tipi Fonksiyonlari -----------*/

  function ajaxDolapTipiKaydet(nesne){

        var islemTip = ajaxKaydet(nesne);
        var bilgi = {
                    ad: $("#ad").val(),
                    aktifMi : $("#aktifMi").val(),
                    islem : islemTip
        };

        ajaxFonk(bilgi,'#denemeTablo','ajax/dolapTipiAjax.php');
        $("#ad,#aktifMi").val("");   
  }

/* ---------- Dolap Tipi Fonksiyonlari Son -----------*/

/* ---------- Tüketim Nedeni Fonksiyonlari -----------*/

  function ajaxTuketimNedeniKaydet(nesne){
        var islemTip = ajaxKaydet(nesne);
        var bilgi = {
                    tanim : $("#tuketimTanim").val(),
                    aktifMi : $("#aktifMi").val(),
                    islem : islemTip
        };

        
        ajaxFonk(bilgi,'#denemeTablo','ajax/tuketimNedeniAjax.php');
        $("#tanim,#aktifMi").val("");   
  }

/* ---------- Urun Tanım Fonksiyonlari -----------*/
  
  function ajaxUrunTanimKaydet(nesne){
        var islemTip = ajaxKaydet(nesne);
        var bilgi = {
                    ad: $("#ad").val(),
                    tip : $("#urunTip").val(),
                    aciklama : $("#urunAciklama").val(),
                    islem : islemTip
        };

        ajaxFonk(bilgi,'#denemeTablo','ajax/urunTanimAjax.php');
        $("#ad,#urunTip,#urunAciklama").val("");   
  }

/* ---------- Urun Tanım Fonksiyonlari Son -----------*/

/* ---------- Urun Fonksiyonlari -----------*/

  function ajaxUrunKaydet(nesne){
        var islemTip = ajaxKaydet(nesne);
        var bilgi = {
                    ad: $("#ad").val(),
                    urunTanim : $("#urunTanim").val(),
                    urunNo : $("#urunNo").val(),
                    uretici : $("#uretici").val(),
                    aciklama : $("#aciklama").val(),
                    urunDoz : $("#urunDoz").val(),
                    seansTip : $("#seansTip").val(),
                    seansSayi : $("#seansSayi").val(),
                    kullanimSuresi : $("#kullanimSuresi").val(),
                    islem : islemTip
        };

        ajaxFonk(bilgi,'#denemeTablo','ajax/urunAjax.php');
        $("#ad,#urunTip,#urunAciklama").val("");   
  }

/* ---------- Urun Tanım Fonksiyonlari Son -----------*/

/* ---------- Birim Tanım Fonksiyonlari -----------*/

  function ajaxIlceGetir(content,value,url){
       
       var bilgi = {
                deger: $(value).val(),
                islem : "ilceGetir"
       }
       ajaxFonk(bilgi,content,'ajax/'+url+'.php');
  }

  function ajaxBirimKaydet(nesne){
        var islemTip = ajaxKaydet(nesne);
        var bilgi = {

                    ad: $("#ad").val(),
                    birimIl : $("#birimIl select option:selected").text(),
                    birimIlce : $("#birimIlce select option:selected").text(),
                    birimAdres : $("#birimAdres").val(),
                    kullaniciID : $("#kullanici1 select option:selected").val(),
                    kullaniciID2 : $("#kullanici2 select option:selected").val(),
                    islem : islemTip
        };

        ajaxFonk(bilgi,'#denemeTablo','ajax/birimAjax.php');
        $("#ad,#birimIl,#birimIlce,#birimAdres").val("");   
  }

  function formGetir(content,islemTip){
      var bilgi = {
          birimID : $("#birimID").val(),
          islem : islemTip
      }
      ajaxFonk(bilgi,content,'ajax/birimAjax.php');
  }

  function panelTemizle(field){
    butonTemizle(field);
    
    $("#stokLink").hide();
    $("#kullaniciLink").hide();
    $("#stokPanel").empty();
    $("#kullaniciPanel").empty();

    $('#birimIl select #ilkOpt').text('');
    $('#birimIl select').removeAttr('disabled');
    $('#birimIlce select').prop('disabled','false');
    $('#birimIlce').html('');
  }

/* ---------- Urun Tanım Fonksiyonlari Son -----------*/

/* ---------- İmha Fonksiyonlari -----------*/
  function ajaxImhaKaydet(nesne){

        var islemTip = "kaydet";

        var bilgi = {
                    urun_id : parseInt($("#urunID option:selected").text()),
                    tarih : $("#islemTarih").val(),
                    tuketim : $("#tuketimNeden option:selected").text(),
                    aciklama : $("#aciklama").val(),
                    islem : islemTip
        };

        
        ajaxFonk(bilgi,'#denemeTablo','ajax/imhaAjax.php');
        $("#urunID,#islemTarih,#aciklama").val("");
  }
/* ---------- İmha Fonksiyonlari Son -----------*/

/* ---------- Kullanıcı Fonksiyonlari -----------*/

  function panelGoster(){
    butonTemizle('.form');

    $('#kLink').show();
    $('#kisLink').show();
    $('#sPlus').show();
    $('#sPluss').show();
    $('#aLink').hide();
    $('#iLink').hide();
    $('#userID').val('');

    $('#adresSonucccc table').remove();
    $('#iletisimSonuc table').remove();
  }

  function ajaxKullaniciKaydet(nesne){

        var sonuc = inputKontrol('#kisiBilgi');
        if(sonuc){
          var islemTip = ajaxKaydet(nesne);
          var bilgi = {
                      gTCNO : $("#gTCNO").val(),
                      gAd : $("#gAd").val(),
                      gSoyad : $("#gSoyad").val(),
                      gKadi : $("#gKadi").val(),
                      gSifre : $("#gSifre").val(),
                      islem : islemTip
          };
          ajaxFonk(bilgi,'#denemeTablo','ajax/kullaniciAjax.php');
        }else{
          alert("Tüm Alanlar Doldurulmak Zorundadır!");
        }
  }

  function ajaxIletisimKaydet(nesne){

          var islemTip = ajaxKaydet(nesne);
          var bilgi = {
                      kullaniciID : $('#userID').val(),
                      iletisimTip : $("#iletisimTip option:selected").val(),
                      deger : $("#iDeger").val(),
                      iletisimIslem : islemTip,
                      islem : islemTip
          };
          ajaxFonk(bilgi,'#iletisimSonuc','ajax/kullaniciAjax.php');
          butonTemizle('#modalIletisim');
  }

   function ajaxAdresKaydet(nesne){

          var islemTip = ajaxKaydet(nesne);
          var bilgi = {
                       kullaniciID : $('#userID').val(),
                      il : $("#kullaniciIl option:selected").text(),
                      ilce : $("#kullaniciIlce option:selected").text(),
                      adres : $("#kullaniciAdres").val(),
                      adresIslem : islemTip,
                      islem : islemTip
          };
          ajaxFonk(bilgi,'#adresSonucccc','ajax/kullaniciAjax.php');
          butonTemizle('#modalAdres');
  }

  function inputKontrol(field){
    var sonuc = true;

    $(field + " input,"+field+" textarea").each(function(){
      if($(this).val() == ''){
        sonuc = false;
        return sonuc;
      }
    });

    return sonuc;
  }

/* ---------- Kullanıcı Fonksiyonlari Son -----------*/

/* ---------- Sıcaklık Cihazı Fonksiyonlari -----------*/

  function ajaxSTCKaydet(nesne){

        var islemTip = "";
        if($(nesne).val() == "Guncelle")
           islemTip = "guncelle";
        else
            islemTip = "kaydet";

        var bilgi = {
                    stokbirim_id : parseInt($("#stokbirimID option:selected").text()),
                    cihaz_durum : $("#cihazAktif").val(),
                    alarm_uret : $("#alarmAktif").val(),
                    islem : islemTip
        };

        ajaxFonk(bilgi,'#denemeTablo','ajax/STCAjax.php');
        $("#cihazAktif,#aktifMi").val("");   
  }
}

/* ---------- Sıcaklık Cihazı Fonksiyonlari Son -----------*/

/* ------------ Ortak Fonksiyonlar ----------*/

function ajaxKaydet(nesne){
    var islemTip = "";
    if($(nesne).val() == "Guncelle")
       islemTip = "guncelle";
    else
        islemTip = "kaydet";
    return islemTip;
}

function ajaxListele(url){
   var bilgi = {
                    deger: $('#sInput').val(),
                    islem : "listele"
                };
    ajaxFonk(bilgi,"#denemeTablo",'ajax/'+url+'.php');
}

function ajaxCokluListele(url){
  /*Deger2 ve Deger3 Birim Tanımlama Icın Eklendi*/
   var bilgi = {
                    deger: $('#sInput').val(),
                    deger1: $('#sInput2').val(),
                    deger2: $('#sInput option:selected').text(),
                    deger3: $('#sInput2 option:selected').text(),
                    islem : "listele"
                };
    ajaxFonk(bilgi,"#denemeTablo",'ajax/'+url+'.php');
}

function ajaxInputDoldur(nesne,url,islemTip){
   $("#modal").css({
           'overlay' : '0.6',
           'top' : '50px'
        });
    $("#modal").toggle();

    var bilgi = {
                deger : $(nesne).val(),
                islem : islemTip
                };
    ajaxFonk(bilgi,"#denemeTablo","ajax/"+ url +".php");
}

function ajaxSil(nesne,url){

       var bilgi = {
                  deger: $(nesne).val(),
                  islem : "sil"
       };
       ajaxFonk(bilgi,"#denemeTablo","ajax/"+url+".php");

       $("#ad,#aktifMi").val("");       
}

function dolapKayitBilgi(islemTip){

    var aktifMi = 0;

    if($('#aktifMi').attr('checked', true))
        aktifMi = 1;

    var bilgi = {
                    ad: $("#ad").val(),
                    aktifMi : aktifMi,
                    islem : islemTip,
                    url : "dolapTipiAjax.php"
     };

     return bilgi;
}

function ajaxFonk(bilgi,alan,postUrl){
    $.ajax({
        type: 'post',
        url: postUrl,
        data: {query: bilgi},
        success: function(result) {
          $(alan).html(result);
        }
    });
}

$('.modal_close').click(function(){
        $("#modal").hide();
});

function checkBoxGuncelle(nesne){
  if($(nesne).is(":checked"))
    $(nesne).val('1');
  else
    $(nesne).val('0');
}

function butonTemizle(field){
    $(field + " input,"+field+" textarea").each(function(){ $(this).val('');});
    $(".popupBody button").val('');
    $(".popupBody button").html('Kaydet');
    $('#kullanici1 select').val('0');
    $('#kullanici2 select').val('0');
}

function gizle(nesne){
  $(nesne).hide();
}

  function ajaxIslemYap(degerAlan,islemTip,content,url){
        var bilgi = {
                    deger : $(degerAlan).val(),
                    kullaniciID : $('#userID').val(),
                    islem : islemTip
        };
        ajaxFonk(bilgi,content,'ajax/'+url+'.php');
  }

/* ------------ Ortak Fonksiyonlar Son ----------*/
