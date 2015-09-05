<?php
error_reporting(0);

require_once('../config/social.php');
require_once('../config/meta.php');
$title='Get Flight Data | TIKET';
require_once('header.php');

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

$token=$_GET['token'];
$flight_id=$_GET['flight_id'];
$date=$_GET['date'];
$status=$_GET['status'];

?>
<section style="margin-top:30px;">
	<div class="container">
<?php
if ($status=='0'){
	$get='http://api.sandbox.tiket.com/flight_api/get_flight_data?flight_id='.$flight_id.'&token='.$token.'&date='.$date."&output=json";
}else if ($status=='1'){
	$ret_flight_id=$_GET['ret_flight_id'];
	$ret_date=$_GET['ret_date'];
	$get='http://api.sandbox.tiket.com/flight_api/get_flight_data?flight_id='.$flight_id.'&token='.$token.'&date='.$date.'&ret_flight_id='.$ret_flight_id.'&ret_date='.$ret_date."&output=json";
}else{
	$get='data/getFlightData-SekaliJalan.json';
}
$data = json_decode(file_get_contents($get), true);
$oken=$data['token'];
?>
		<div class="row">
			<div class="col-md-12">
				<?php
				if ($status=='0'){
					$dari=$_GET['dari'];
					$ke=$_GET['ke'];
					$pergi=$_GET['pergi'];
					$flight_number=$_GET['flight_number'];
					$flight_icon=$_GET['flight_icon'];
					$dt=$_GET['dt'];
					$at=$_GET['at'];
					$harga=$_GET['harga'];
				?>
				<table id="pp" border="1" width="100%">
					<thead>
						<tr>
							<th colspan="3" align="left">
								<span style="color:black;">Pergi:</span> <?php echo $dari;?> <span style="color:black;">ke</span> <?php echo $ke;?> 
							</th>
							<th style="text-align:right"><?php echo $pergi;?></th>
						</tr>
					</thead>
					<tbody>
						<tr class="pergi">
							<td style="padding-left:10px;" width="150px">
								<p>
									<img style="vertical-align:middle;" src="<?php echo $flight_icon;?>"> (<?php echo $flight_number;?>)
								</p>
							</td>	
							<td align="center"><?php echo $dt;?></td>	
							<td align="center"><?php echo $at;?></td>		
							<td align="center" style="color:#be0000;font-weight:bold;"><?php echo $harga;?></td>	
						</tr>
					</tbody>
				</table>
				<?php
				}else if ($status=='1'){
					$dari=$_GET['dari'];
					$ke=$_GET['ke'];
					$pergi=$_GET['pergi'];
					$flight_number=$_GET['flight_number'];
					$flight_icon=$_GET['flight_icon'];
					$dt=$_GET['dt'];
					$at=$_GET['at'];
					$harga=$_GET['harga'];
					$pulang=$_GET['pulang'];
					$ret_flight_number=$_GET['ret_flight_number'];
					$ret_flight_icon=$_GET['ret_flight_icon'];
					$ret_dt=$_GET['ret_dt'];
					$ret_at=$_GET['ret_at'];
					$ret_harga=$_GET['ret_harga'];
				?>
				<table id="pp" border="1" width="100%">
					<thead>
						<tr>
							<th colspan="3" align="left">
								<span style="color:black;">Pergi:</span> <?php echo $dari;?> <span style="color:black;">ke</span> <?php echo $ke;?> 
							</th>
							<th style="text-align:right"><?php echo $pergi;?></th>
						</tr>
					</thead>
					<tbody>
						<tr class="pergi">
							<td style="padding-left:10px;" width="150px">
								<p>
									<img style="vertical-align:middle;" src="<?php echo $flight_icon;?>"> (<?php echo $flight_number;?>)
								</p>
							</td>	
							<td align="center"><?php echo $dt;?></td>	
							<td align="center"><?php echo $at;?></td>		
							<td align="center" style="color:#be0000;font-weight:bold;"><?php echo $harga;?></td>	
						</tr>
					</tbody>
				</table>
				<table id="pp" border="1" width="100%">
					<thead>
						<tr>
							<th colspan="3" align="left">
								<span style="color:black;">Pulang:</span> <?php echo $ke;?> <span style="color:black;">ke</span> <?php echo $dari;?> 
							</th>
							<th style="text-align:right"><?php echo $pulang;?></th>
						</tr>
					</thead>
					<tbody>
						<tr class="pulang">
							<td style="padding-left:10px;" width="150px">
								<p>
									<img style="vertical-align:middle;" src="<?php echo $ret_flight_icon;?>"> (<?php echo $ret_flight_number;?>)
								</p>
							</td>	
							<td align="center"><?php echo $ret_dt;?></td>	
							<td align="center"><?php echo $ret_at;?></td>		
							<td align="center" style="color:#be0000;font-weight:bold;"><?php echo $ret_harga;?></td>	
						</tr>
					</tbody>
				</table>
				<?php
				}else{
				?>
					<div style="border:dashed 3px #f0ad4e;border-radius:3px;padding:10px;margin:10px 10%;">
						<p align="center">
							Maaf, <span class="highlight">token</span> Anda tidak valid. <br>
							Data yang tertampil di bawah ini <span class="highlight">bukan data real-time</span>. <br>
							Untuk menyelesaikan masalah ini, silahkan menghubungi saya di <a href="http://zainalabidin.me" class="highlight">www.zainalabidin.me</a>.
						</p>
					</div>
					<table id="pp" border="1" width="100%">
					<thead>
						<tr>
							<th colspan="3" align="left">
								<span style="color:black;">Pergi:</span> Jakarta, Cengkareng - CGK [Indonesia] <span style="color:black;">ke</span> Denpasar, Bali - DPS [Indonesia] 
							</th>
							<th style="text-align:right">10 Mar 2015</th>
						</tr>
					</thead>
					<tbody>
						<tr class="pergi">
							<td style="padding-left:10px;" width="150px">
								<p>
									<img style="vertical-align:middle;" src="<?php echo $data['departures']['image'];?>"> (<?php echo $data['departures']['flight_number'];?>)
								</p>
							</td>	
							<td align="center"><?php echo $data['departures']['simple_departure_time'];?></td>	
							<td align="center"><?php echo $data['departures']['simple_arrival_time'];?></td>		
							<td align="center" style="color:#be0000;font-weight:bold;">
								<?php 
									$harga=$data['departures']['price_value'];
									$harga=str_replace('.00','',$harga);
									echo formatRupiah($harga);
								?>
							</td>	
						</tr>
					</tbody>
					</table>
				<?php
				}
				?>
			</div>
		</div>	
		
		<form id="addorder" method="POST" action="add-order.php" style="margin-top:30px;margin-bottom:30px;">	
		<div class="row">
			<div class="col-md-12">	
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title"><?php echo $data['required']['separator']['FieldText'];?></h3>
						</div>
						<div class="panel-body">
							<div class="form-group">
								<label><?php echo $data['required']['conSalutation']['FieldText'];?></label>
								<select class="form-control validate[required]" name="conSalutation" id="conSalutation">
									<option value="" selected="selected">Pilih <?php echo $data['required']['conSalutation']['FieldText'];?></option>
									<option value="<?php echo $data['required']['conSalutation']['resource'][0]['id'];?>"><?php echo $data['required']['conSalutation']['resource'][0]['name'];?></option>
									<option value="<?php echo $data['required']['conSalutation']['resource'][1]['id'];?>"><?php echo $data['required']['conSalutation']['resource'][1]['name'];?></option>
									<option value="<?php echo $data['required']['conSalutation']['resource'][2]['id'];?>"><?php echo $data['required']['conSalutation']['resource'][2]['name'];?></option>
								</select>
							</div>
							<div class="form-group">
								<label><?php echo $data['required']['conEmailAddress']['FieldText'];?></label>
								<input class="form-control validate[required,custom[email]]" placeholder="<?php echo $data['required']['conEmailAddress']['example'];?>" type="email" name="conEmailAddress" id="conEmailAddress" size="40">
								<span class="span-notice">E-Tiket Anda akan dikirim ke alamat email ini.</span>
							</div>
							<div class="form-group">
								<label><?php echo $data['required']['conFirstName']['FieldText'];?></label>
								<input class="form-control validate[required]" placeholder="<?php echo $data['required']['conFirstName']['example'];?>" type="<?php echo $data['required']['conFirstName']['type'];?>" name="conFirstName" id="conFirstName" size="40">
							</div>
							<div class="form-group">
								<label><?php echo $data['required']['conLastName']['FieldText'];?></label>
								<input class="form-control validate[required]" placeholder="<?php echo $data['required']['conLastName']['example'];?>" type="<?php echo $data['required']['conLastName']['type'];?>" name="conLastName" id="conLastName" size="40">
							</div>
							<div class="form-group">
								<label><?php echo $data['required']['conPhone']['FieldText'];?></label>
								<input class="form-control validate[required,custom[phone]]" placeholder="<?php echo $data['required']['conPhone']['example'];?>" type="<?php echo $data['required']['conPhone']['type'];?>" name="conPhone" id="conPhone" size="40">
							</div>
						</div>
					</div>
			</div>
		</div>
		<div class="row">
			<?php
			for ($i=1;$i<=$data['departures']['count_adult']; $i++){
			?>
			<div class="col-md-6">	
					<div class="panel panel-success">
						<div class="panel-heading">
							<h3 class="panel-title"><?php echo $data['required']['separator_adult'.$i.'']['FieldText'];?></h3>
						</div>
						<div class="panel-body">
							<div class="form-group">
								<label><?php echo $data['required']['titlea'.$i.'']['FieldText'];?></label>
								<select class="form-control validate[required]" name="titlea<?php echo $i;?>" id="titlea<?php echo $i;?>">
									<option value="" selected="selected">Pilih <?php echo $data['required']['titlea'.$i.'']['FieldText'];?></option>
									<option value="<?php echo $data['required']['titlea'.$i.'']['resource'][0]['id'];?>"><?php echo $data['required']['titlea'.$i.'']['resource'][0]['name'];?></option>
									<option value="<?php echo $data['required']['titlea'.$i.'']['resource'][1]['id'];?>"><?php echo $data['required']['titlea'.$i.'']['resource'][1]['name'];?></option>
									<option value="<?php echo $data['required']['titlea'.$i.'']['resource'][2]['id'];?>"><?php echo $data['required']['titlea'.$i.'']['resource'][2]['name'];?></option>
								</select>
							</div>
							<div class="form-group">
								<label><?php echo $data['required']['firstnamea'.$i.'']['FieldText'];?></label>
								<input class="form-control validate[required]" placeholder="<?php echo $data['required']['firstnamea'.$i.'']['example'];?>" type="<?php echo $data['required']['firstnamea'.$i.'']['type'];?>" name="firstnamea<?php echo $i;?>" id="firstnamea<?php echo $i;?>" size="40">
							</div>
							<div class="form-group">
								<label><?php echo $data['required']['lastnamea'.$i.'']['FieldText'];?></label>
								<input class="form-control validate[required]" placeholder="<?php echo $data['required']['lastnamea'.$i.'']['example'];?>" type="<?php echo $data['required']['lastnamea'.$i.'']['type'];?>" name="lastnamea<?php echo $i;?>" id="lastnamea<?php echo $i;?>" size="40">
							</div>
							<div class="form-group">
								<label><?php echo $data['required']['birthdatea'.$i.'']['FieldText'];?></label>
								<input class="form-control validate[required,custom[date]]" placeholder="<?php echo $data['required']['birthdatea'.$i.'']['example'];?>" type="<?php echo $data['required']['birthdatea'.$i.'']['type'];?>" name="birthdatea<?php echo $i;?>" id="birthdatea<?php echo $i;?>" size="40">
							</div>
							<?php
								if (isset($data['required']['ida'.$i.''])){
							?>
							<div class="form-group">
								<label><?php echo $data['required']['ida'.$i.'']['FieldText'];?></label>
								<input class="form-control validate[required,custom[onlyNumberSp]]" placeholder="<?php echo $data['required']['ida'.$i.'']['example'];?>" type="<?php echo $data['required']['ida'.$i.'']['type'];?>" name="ida<?php echo $i;?>" id="ida<?php echo $i;?>" size="40">
							</div>
							<?php
								}
							?>	
							<?php
								if (isset($data['required']['passportnoa'.$i.''])){
							?>
							<div class="form-group">
								<label><?php echo $data['required']['passportnoa'.$i.'']['FieldText'];?></label>
								<input class="form-control validate[required,custom[onlyNumberSp]]" placeholder="<?php echo $data['required']['passportnoa'.$i.'']['example'];?>" type="<?php echo $data['required']['passportnoa'.$i.'']['type'];?>" name="passportnoa<?php echo $i;?>" id="passportnoa<?php echo $i;?>" size="40">
							</div>
							<?php
								}
							?>	
							<?php
								if (isset($data['required']['passportExpiryDatea'.$i.''])){
							?>
							<div class="form-group">
								<label><?php echo $data['required']['passportExpiryDatea'.$i.'']['FieldText'];?></label>
								<input class="form-control validate[required,custom[date]]]" placeholder="<?php echo $data['required']['passportExpiryDatea'.$i.'']['example'];?>" type="<?php echo $data['required']['passportExpiryDatea'.$i.'']['type'];?>" name="passportExpiryDatea<?php echo $i;?>" id="passportExpiryDatea<?php echo $i;?>" size="40">
							</div>
							<?php
								}
							?>
							<?php
								if (isset($data['required']['passportissueddatea'.$i.''])){
							?>
							<div class="form-group">
								<label><?php echo $data['required']['passportissueddatea'.$i.'']['FieldText'];?></label>
								<input class="form-control validate[required,custom[date]]]" placeholder="<?php echo $data['required']['passportissueddatea'.$i.'']['example'];?>" type="<?php echo $data['required']['passportissueddatea'.$i.'']['type'];?>" name="passportissueddatea<?php echo $i;?>" id="passportissueddatea<?php echo $i;?>" size="40">
							</div>
							<?php
								}
							?>
							<?php
								if (isset($data['required']['passportissuinga'.$i.''])){
							?>
							<div class="form-group">
								<label><?php echo $data['required']['passportissuinga'.$i.'']['FieldText'];?></label>
								<select class="form-control validate[required]" name="passportissuinga<?php echo $i;?>" id="passportissuinga<?php echo $i;?>">
									<option value="" selected="selected">Pilih <?php echo $data['required']['passportissuinga'.$i.'']['FieldText'];?></option>
									<option value="<?php echo $data['required']['passportissuinga'.$i.'']['example'];?>"><?php echo $data['required']['passportissuinga'.$i.'']['example'];?></option>
								</select>
							</div>
							<?php
								}
							?>	
							<?php
								if (isset($data['required']['passportnationalitya'.$i.''])){
							?>
							<div class="form-group">
								<label><?php echo $data['required']['passportnationalitya'.$i.'']['FieldText'];?></label>
								<select class="form-control validate[required]" name="passportnationalitya<?php echo $i;?>" id="passportnationalitya<?php echo $i;?>">
									<option value="" selected="selected">Pilih <?php echo $data['required']['passportnationalitya'.$i.'']['FieldText'];?></option>
									<option value="<?php echo $data['required']['passportnationalitya'.$i.'']['example'];?>"><?php echo $data['required']['passportnationalitya'.$i.'']['example'];?></option>
								</select>
							</div>
							<?php
								}
							?>	
						</div>
					</div>
			</div>
			<?php
			}	
			?>
		</div>

		<div class="row">
			<?php
			for ($i=1;$i<=$data['departures']['count_child']; $i++){
			?>
			<div class="col-md-6">	
					<div class="panel panel-warning">
						<div class="panel-heading">
							<h3 class="panel-title"><?php echo $data['required']['separator_child'.$i.'']['FieldText'];?></h3>
						</div>
						<div class="panel-body">
							<div class="form-group">
								<label><?php echo $data['required']['titlec'.$i.'']['FieldText'];?></label>
								<select class="form-control validate[required]" name="titlec<?php echo $i;?>" id="titlec<?php echo $i;?>">
									<option value="" selected="selected">Pilih <?php echo $data['required']['titlec'.$i.'']['FieldText'];?></option>
									<option value="<?php echo $data['required']['titlec'.$i.'']['resource'][0]['id'];?>"><?php echo $data['required']['titlec'.$i.'']['resource'][0]['name'];?></option>
									<option value="<?php echo $data['required']['titlec'.$i.'']['resource'][1]['id'];?>"><?php echo $data['required']['titlec'.$i.'']['resource'][1]['name'];?></option>
									<option value="<?php echo $data['required']['titlec'.$i.'']['resource'][2]['id'];?>"><?php echo $data['required']['titlec'.$i.'']['resource'][2]['name'];?></option>
								</select>
							</div>
							<div class="form-group">
								<label><?php echo $data['required']['firstnamec'.$i.'']['FieldText'];?></label>
								<input class="form-control validate[required]" placeholder="<?php echo $data['required']['firstnamec'.$i.'']['example'];?>" type="<?php echo $data['required']['firstnamec'.$i.'']['type'];?>" name="firstnamec<?php echo $i;?>" id="firstnamec<?php echo $i;?>" size="40">
							</div>
							<div class="form-group">
								<label><?php echo $data['required']['lastnamec'.$i.'']['FieldText'];?></label>
								<input class="form-control validate[required]" placeholder="<?php echo $data['required']['lastnamec'.$i.'']['example'];?>" type="<?php echo $data['required']['lastnamea'.$i.'']['type'];?>" name="lastnamec<?php echo $i;?>" id="lastnamec<?php echo $i;?>" size="40">
							</div>
							<div class="form-group">
								<label><?php echo $data['required']['birthdatec'.$i.'']['FieldText'];?></label>
								<input class="form-control validate[required,custom[date]]" placeholder="<?php echo $data['required']['birthdatec'.$i.'']['example'];?>" type="<?php echo $data['required']['birthdatea'.$i.'']['type'];?>" name="birthdatec<?php echo $i;?>" id="birthdatec<?php echo $i;?>" size="40">
							</div>
							<?php
								if (isset($data['required']['passportnationalityc'.$i.''])){
							?>
							<div class="form-group">
								<label><?php echo $data['required']['passportnationalityc'.$i.'']['FieldText'];?></label>
								<select class="form-control validate[required]" name="passportnationalityc<?php echo $i;?>" id="passportnationalityc<?php echo $i;?>">
									<option value="" selected="selected">Pilih <?php echo $data['required']['passportnationalityc'.$i.'']['FieldText'];?></option>
									<option value="<?php echo $data['required']['passportnationalityc'.$i.'']['example'];?>"><?php echo $data['required']['passportnationalityc'.$i.'']['example'];?></option>
								</select>
							</div>
							<?php
								}
							?>
						</div>
					</div>
			</div>
			<?php
			}	
			?>
		</div>
		<div class="row">
			<?php
			for ($i=1;$i<=$data['departures']['count_infant']; $i++){
			?>
			<div class="col-md-6">	
					<div class="panel panel-danger">
						<div class="panel-heading">
							<h3 class="panel-title"><?php echo $data['required']['separator_infant'.$i.'']['FieldText'];?></h3>
						</div>
						<div class="panel-body">
							<div class="form-group">
								<label><?php echo $data['required']['titlei'.$i.'']['FieldText'];?></label>
								<select class="form-control validate[required]" name="titlei<?php echo $i;?>" id="titlei<?php echo $i;?>">
									<option value="" selected="selected">Pilih <?php echo $data['required']['titlei'.$i.'']['FieldText'];?></option>
									<option value="<?php echo $data['required']['titlei'.$i.'']['resource'][0]['id'];?>"><?php echo $data['required']['titlei'.$i.'']['resource'][0]['name'];?></option>
									<option value="<?php echo $data['required']['titlei'.$i.'']['resource'][1]['id'];?>"><?php echo $data['required']['titlei'.$i.'']['resource'][1]['name'];?></option>
									<option value="<?php echo $data['required']['titlei'.$i.'']['resource'][2]['id'];?>"><?php echo $data['required']['titlei'.$i.'']['resource'][2]['name'];?></option>
								</select>
							</div>
							<div class="form-group">
								<label><?php echo $data['required']['firstnamei'.$i.'']['FieldText'];?></label>
								<input class="form-control validate[required]" placeholder="<?php echo $data['required']['firstnamei'.$i.'']['example'];?>" type="<?php echo $data['required']['firstnamei'.$i.'']['type'];?>" name="firstnamei<?php echo $i;?>" id="firstnamei<?php echo $i;?>" size="40">
							</div>
							<div class="form-group">
								<label><?php echo $data['required']['lastnamei'.$i.'']['FieldText'];?></label>
								<input class="form-control validate[required]" placeholder="<?php echo $data['required']['lastnamei'.$i.'']['example'];?>" type="<?php echo $data['required']['lastnamei'.$i.'']['type'];?>" name="lastnamei<?php echo $i;?>" id="lastnamei<?php echo $i;?>" size="40">
							</div>
							<div class="form-group">
								<label><?php echo $data['required']['birthdatei'.$i.'']['FieldText'];?></label>
								<input class="form-control validate[required,custom[date]]" placeholder="<?php echo $data['required']['birthdatei'.$i.'']['example'];?>" type="<?php echo $data['required']['birthdatei'.$i.'']['type'];?>" name="birthdatei<?php echo $i;?>" id="birthdatei<?php echo $i;?>" size="40">
							</div>
							<?php
								if (isset($data['required']['passportnationalityi'.$i.''])){
							?>
							<div class="form-group">
								<label><?php echo $data['required']['passportnationalityi'.$i.'']['FieldText'];?></label>
								<select class="form-control validate[required]" name="passportnationalityi<?php echo $i;?>" id="passportnationalityi<?php echo $i;?>">
									<option value="" selected="selected">Pilih <?php echo $data['required']['passportnationalityi'.$i.'']['FieldText'];?></option>
									<option value="<?php echo $data['required']['passportnationalityi'.$i.'']['example'];?>"><?php echo $data['required']['passportnationalityi'.$i.'']['example'];?></option>
								</select>
							</div>
							<?php
								}
							?>
						</div>
					</div>
			</div>
			<?php
			}	
			?>
		</div>

		<div class="row">
			<div class="col-md-12">
				<hr>
					<button class="btn btn-primary btn-pesan col-md-4" style="float:right;font-weight:bold;text-transform:uppercase;">Pesan Tiket</button>
					<input type="hidden" name="status" value="<?php if (isset($status)) {echo $status;}else{echo '0';}?>">
					<input type="hidden" name="token" value="<?php echo $oken;?>">	
					<?php
						if($status!='1'){
					?>
							<input type="hidden" name="adult" value="<?php echo $data['departures']['count_adult'];?>">
							<input type="hidden" name="child" value="<?php echo $data['departures']['count_child'];?>">
							<input type="hidden" name="infant" value="<?php echo $data['departures']['count_infant'];?>">	
							<input type="hidden" name="flight_id" value="<?php echo $data['departures']['flight_id'];?>">
					<?php
						}else{
					?>
							<input type="hidden" name="adult" value="<?php echo $data['returns']['count_adult'];?>">
							<input type="hidden" name="child" value="<?php echo $data['returns']['count_child'];?>">
							<input type="hidden" name="infant" value="<?php echo $data['returns']['count_infant'];?>">	
							<input type="hidden" name="flight_id" value="<?php echo $data['departures']['flight_id'];?>">
							<input type="hidden" name="ret_flight_id" value="<?php echo $data['returns']['flight_id'];?>">
					<?php
						}
					?>
				</div>	
		</div>	
		</form>
	</div>
</section>
<style>
	table#pp,
	table#pp th,
	table#pp td{
		border: 2px solid #be0000;
	} 
	table#pp th{
		font-weight:bold;background:#be0000;color:white;padding:10px;
	}
	.btn-pesan{color:#fff;background-color:#be0000;border-color:#be0000}
	.btn-pesan:hover,
	.btn-pesan:focus,
	.btn-pesan:active,
	.btn-pesan.active,
	.open>.dropdown-toggle.btn-pesan{
		color:#fff;background-color:red;border-color:red;
	}
	::-webkit-input-placeholder {
		color: #d4d4d4;
		font-style:italic;
	}
	:-moz-placeholder { /* Firefox 18- */
		color: #d4d4d4;  
		font-style:italic;
	}
	::-moz-placeholder {  /* Firefox 19+ */
		color: #d4d4d4;  
		font-style:italic;
	}
	:-ms-input-placeholder {  
		color: #d4d4d4;  
		font-style:italic;
	}
	.highlight{
		color:#f0ad4e;
		background:transparent;
		border:none;
		font-weight:bold;
	}
	td{
		background:white;
	}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		$("#addorder").validationEngine();
	});
</script>
<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="js/jquery.validationEngine.js"></script>
<script type="text/javascript" src="js/jquery.validationEngine-id.js"></script>
<link rel="stylesheet" type="text/css" href="css/validationEngine.jquery.css" />
<?php
	require_once('footer.php');
?>