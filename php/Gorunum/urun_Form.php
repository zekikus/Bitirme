<body>
	<section>
		<div class="header">
			<span class="header_text">Urun</span>
			<div class="header_icon">
				<a id="modal_trigger" href="#modal" class="btn"><span class="glyphicon glyphicon-plus"></span></a>
			</div>
		</div>
		<div class="search_form">
			<form>
				<label>Ürün No:</label>
				<input type="text" name="urunNo" />
				<a><span class="glyphicon glyphicon-list"></span></a><br/>
				
				<label>Ürün Adı:</label>
				<input type="text" name="urunAdi" />
				<a><span class="glyphicon glyphicon-list"></span></a>
			</form>
		</div>
		<table class="table table-striped">
			<thead>
		      <tr>
		        <th>Adı</th>
		        <th>Ürün Tanımı</th>
		        <th>Ürün No</th>
		        <th>İşlemler</th>
		      </tr>
		    </thead>
		    <tbody>
		      <tr>
		        <td>John</td>
		        <td>Doe</td>
		        <td>john@example.com</td>
		        <td></td>
		      </tr>
		      <tr>
		        <td>Mary</td>
		        <td>Moe</td>
		        <td>mary@example.com</td>
		        <td></td>
		      </tr>
		      <tr>
		        <td>July</td>
		        <td>Dooley</td>
		        <td>july@example.com</td>
		        <td></td>
		      </tr>
		    </tbody>
		</table>
		<?php
			include "php/Gorunum/urun_Islemleri.php";
		?>

	</section>
</body>