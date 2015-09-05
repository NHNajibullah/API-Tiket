<?php 
	require_once('config/social.php');
	require_once('config/meta.php');
	$title='Beranda | TIKET';
	require_once('header.php');
?>
<section  style="margin:10px 0;padding:10px 0;background:#be0000;">
	<div class="container">	
		<div class="row">
			<div class="col-md-12">

				<center>
				<form method="post" action="flight-api/search.php">
					<select name="asal">
						<option value="BalikPapan - BPN [Indonesia]">BalikPapan - BPN [Indonesia]</option>
						<option value="Batam - BTH [Indonesia]">Batam - BTH [Indonesia]</option>
						<option value="Denpasar, Bali - DPS [Indonesia]">Denpasar, Bali - DPS [Indonesia]</option>
						<option value="Jakarta, Cengkareng - CGK [Indonesia]" selected="">Jakarta, Cengkareng - CGK [Indonesia]</option>
						<option value="Medan (Kuala Namu) - KNO [Indonesia]">Medan (Kuala Namu) - KNO [Indonesia]</option>
						<option value="Padang - PDG [Indonesia]">Padang - PDG [Indonesia]</option>
						<option value="Pekanbaru - PKU [Indonesia]">Pekanbaru - PKU [Indonesia]</option>
						<option value="Surabaya - SUB [Indonesia]">Surabaya - SUB [Indonesia]</option>
						<option value="Ujungpandang, Makassar - UPG [Indonesia]">Ujungpandang, Makassar - UPG [Indonesia]</option>
						<option value="Yogyakarta - JOG [Indonesia]">Yogyakarta - JOG [Indonesia]</option>
					</select>
    				<select name="tujuan">
						<option value="BalikPapan - BPN [Indonesia]">BalikPapan - BPN [Indonesia]</option>
						<option value="Batam - BTH [Indonesia]">Batam - BTH [Indonesia]</option>
						<option value="Denpasar, Bali - DPS [Indonesia]" selected="">Denpasar, Bali - DPS [Indonesia]</option>
						<option value="Jakarta, Cengkareng - CGK [Indonesia]">Jakarta, Cengkareng - CGK [Indonesia]</option>
						<option value="Medan (Kuala Namu) - KNO [Indonesia]">Medan (Kuala Namu) - KNO [Indonesia]</option>
						<option value="Padang - PDG [Indonesia]">Padang - PDG [Indonesia]</option>
						<option value="Pekanbaru - PKU [Indonesia]">Pekanbaru - PKU [Indonesia]</option>
						<option value="Surabaya - SUB [Indonesia]">Surabaya - SUB [Indonesia]</option>
						<option value="Ujungpandang, Makassar - UPG [Indonesia]">Ujungpandang, Makassar - UPG [Indonesia]</option>
						<option value="Yogyakarta - JOG [Indonesia]">Yogyakarta - JOG [Indonesia]</option>
					</select>

					<input id="datepicker" type="text" name="departDate" placeholder="Tanggal Keberangkatan">
					<img src="img/calender.png" height="15">
					<button type="submit">CARI TIKET <i class="fa fa-play"></i></button>
				</form>
				</center>
			
			</div>
		</div>
	</div>
</section>

<script>
		$(function(){
			$.datepicker.setDefaults(
				$.extend($.datepicker.regional[''])
			);
			$('#datepicker').datepicker({ dateFormat: 'yy-mm-dd' });
		});
	</script>

<section>
	<div class="container text-center">
		<div class="row">
			<div class="col-md-4">
				<center>
					<div class='fln-affiliate' data-username='okakzai' data-style='' data-qts='//t.flnaffiliate.com/' data-type='banner' data-theme='faces' data-size='300x250' ></div>
					<script type='text/javascript'>
						(function(d) {
					    	var po = d.createElement('script');
    						po.type = 'text/javascript'; po.async = true; po.src = '//static.flnaffiliate.com/build/js/affiliate-sdk.js';
    						var s = d.getElementsByTagName('script')[0];
    						s.parentNode.insertBefore(po, s);
						})(document);
					</script>
				</center>	
			</div>
			<div class="col-md-4">
				<center>	
					<a href='http://www.sribu.com/en?affcode=ccf68b&utm_campaign=sribupass&utm_medium=banner_250x250&utm_source=affiliate' rel='nofollow'><img alt='250x250_en' src='https://s3-ap-southeast-1.amazonaws.com/sribu-sg/assets/affiliate-referral/250x250_en.jpg' /></a>
				</center>	
			</div>
			<div class="col-md-4">
				<center>
					<a href="http://ninetyninedesigns.7eer.net/c/167959/177079/3172">
						<img src="http://adn.impactradius.com/display-ad/3172-177079" border="0" alt="" width="300" height="250"/>
					</a>
					<img height="0" width="0" src="http://ninetyninedesigns.7eer.net/i/167959/177079/3172" style="position:absolute;visibility:hidden;" border="0" />
				</center>
			</div>
		</div>
	</div>
</section>

<?php
	require_once('footer.php');
?>	

