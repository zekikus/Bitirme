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

  function ajaxIlceGetir(content,value){
       
       var bilgi = {
                deger: $(value).val(),
                islem : "ilceGetir"
       }
       ajaxFonk(bilgi,content,'ajax/birimAjax.php');
  }

  function ajaxBirimKaydet(nesne){
        var islemTip = ajaxKaydet(nesne);
        var bilgi = {
                    ad: $("#ad").val(),
                    birimIl : $("#birimIl select option:selected").text(),
                    birimIlce : $("#birimIlce select option:selected").text(),
                    birimAdres : $("#birimAdres").val(),
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

function ajaxInputDoldur(nesne,url){
   $("#modal").css({
           'overlay' : '0.6',
           'top' : '50px'
        });
    $("#modal").toggle();

    var bilgi = {
                deger : $(nesne).val(),
                islem : "doldur"
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
}

/* ------------ Ortak Fonksiyonlar Son ----------*/
