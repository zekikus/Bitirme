<?php

	interface IKontrol{

		public function kaydet($sorgu);
		public function duzenle($sorgu,$islem);
		public function listele($sorgu);
		public function sorguCalistir($sorgu);

	}

?>