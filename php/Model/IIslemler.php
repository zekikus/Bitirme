<?php
	
	interface IIslemler{
		public function ekle($sorgu);
		public function sil($sorgu);
		public function guncelle($sorgu);
		public function listele($sorgu);
	}

?>