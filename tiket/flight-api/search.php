<?php
error_reporting(0);

require_once('../config/social.php');
require_once('../config/meta.php');
$title='Hasil Pencarian Tiket Pesawat Terbang | TIKET';
require_once('header.php');
/*
$pergi=$_GET['pergi'];
$pulang=$_GET['pulang'];
*/
$dari=$_POST['asal'];
$ke=$_POST['tujuan'];

$tgl_berangkat=$_POST['departDate'];
$tgl_tiba=$_POST['returnDate'];

$pergi=$tgl_berangkat;
/*
$status=$_POST['roundTrip'];
$adult=$_POST['adultNum'];
$child=$_POST['childNum'];
$infant=$_POST['infantNum'];
function konversiTanggal($wkt){
	$waktu=str_split($wkt,4);
	$tahun=$waktu[0];
	$time=str_split($waktu[1],2);
	$bulan=$time[0];
	$tanggal=$time[1];
	return $tahun.'-'.$bulan.'-'.$tanggal;
}
*/
function formatRupiah($nilaiUang){
  $nilaiRupiah 	   = "";
  $jumlahAngka  = strlen($nilaiUang);
  while($jumlahAngka > 3)
  {
    $nilaiRupiah    = "." . substr($nilaiUang,-3) . $nilaiRupiah;
    $sisaNilai         = strlen($nilaiUang) - 3;
    $nilaiUang       = substr($nilaiUang,0,$sisaNilai);
    $jumlahAngka = strlen($nilaiUang);
  }
  $nilaiRupiah       = "IDR " . $nilaiUang . $nilaiRupiah;
  return $nilaiRupiah;
}
function konversiKota($kota){
	$kode=explode("[",$kota);
	$kode=explode("-",$kode[0]);
	$kode=$kode[1];
	return trim($kode," ");
}
$d=konversiKota($dari);
$a=konversiKota($ke);

//$date=konversiTanggal($tgl_berangkat);

$date=$tgl_berangkat;

$status='0';
$adult='1';
$child='0';
$infant='0';

if($status=='1'){
	$ret_date=konversiTanggal($tgl_tiba);
	$pulang=$pulang;
}else if ($status=='0'){
	$ret_date='';
	$pulang='';
}

$Secret		= '87ec16a248fa7088b0a489b8dad4d03b'; //Zainal 

$GetToken = "http://api.sandbox.tiket.com/apiv1/payexpress?method=getToken&secretkey=".$Secret."&output=json";
$TokenJSON=json_decode(file_get_contents($GetToken), true);
$Status=$TokenJSON['diagnostic']['status'];
if ($Status!='403'){
	$Token=$TokenJSON['token'];
}
?>
<style>
	td:first-child{
		text-align:left;
	}
	div.wrap{
		width:100%;
	}
</style>

<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php require_once('table-search.php');?>
			</div>
		</div>
	</div>
</section>
<section style="margin-top:30px;">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<!-- 970 -->
				<ins class="adsbygoogle"
				style="display:inline-block;width:970px;height:90px"
				data-ad-client="ca-pub-9008926290238612"
				data-ad-slot="5618767864"></ins>
				<script>
					(adsbygoogle = window.adsbygoogle || []).push({});
				</script>
			</div>
		</div>	
	</div>
</section>
	
<style>
	th,td{
		text-align:center;
		font-size:12px;
	}
	a{
		text-decoration:none;
	}
	a:hover{
		color:#be0000;
		background:white;
	}
	.highlight{
		color:#f0ad4e;
		background:transparent;
		border:none;
		font-weight:bold;
	}
	p{
		color:black;
	}
	.atap{
		background:#be0000;
		margin:5px 0;
		padding:10px;
	}
	.atap p{
		color:white;
		font-weight:bold;
	}
	td:last-child{
		color:#be0000;
		font-weight:bold;
	}
	.btn-beli{
		color:white;
		font-weight:bold;
		background:#be0000;
	}
	table#pp,
	table#pp th,
	table#pp td{
		border: 2px solid #be0000;
	} 
	table#pp th{
		font-weight:bold;background:#be0000;color:white;text-align:center;padding:10px;text-transform:uppercase;
	}
	.total-price{
		font-size:17px;
	}
</style>
<script>
	function formatRupiah(nilaiUang){
		var nilaiRupiah 	   = "";
		var jumlahAngka  = nilaiUang.length;
		while(jumlahAngka > 3){
			nilaiRupiah    = "." + nilaiUang.substr(-3) + nilaiRupiah;
			var sisaNilai         = (nilaiUang.length) - 3;
			nilaiUang       = nilaiUang.substr(0,sisaNilai);
			jumlahAngka = nilaiUang.length;
		}
		nilaiRupiah       = "IDR " +nilaiUang+nilaiRupiah;
		return nilaiRupiah;
	}
	
	var pergi_price=$('tr.pergi td.harga').text().split(' ');
	pergi_price=pergi_price[1];
	pergi_price=pergi_price.split('.');
	var count_pergi=pergi_price.length;
	var npergi=count_pergi;
	var pergiprice = [];
	for(var i = 0; i < npergi; i++){
		pergiprice+=pergi_price[i];
	}
	pergi_price=pergiprice.toString();
	pergi_price=parseInt(pergi_price);
	
	var pulang_price=$('tr.pulang td.harga').text().split(' ');
	pulang_price=pulang_price[1];
	pulang_price=pulang_price.split('.');
	var count_pulang=pulang_price.length;
	var npulang=count_pulang;
	var pulangprice = [];
	for(var i = 0; i < npulang; i++){
		pulangprice+=pulang_price[i];
	}
	pulang_price=pulangprice.toString();
	pulang_price=parseInt(pulang_price);
	pulang_price=parseInt(pulang_price);
	
	var total_price=pergi_price+pulang_price;
	total_price=total_price.toString();
	$('.total-price').text(formatRupiah(total_price));
	
</script>
<?php
	require_once('footer.php');
?>

