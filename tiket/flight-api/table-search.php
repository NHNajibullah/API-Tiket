<?php
if (isset($Token)){
	if ($status=='0') {
		$jsonfile = "http://api.sandbox.tiket.com/search/flight?d=".$d."&a=".$a."&date=".$date."&adult=".$adult."&child=".$child."&infant=".$infant."&token=".$Token."&output=json";
		$data = json_decode(file_get_contents($jsonfile), true);
		if (isset($data['departures']['result'])){
			$n=count($data['departures']['result']);
		}else{
			$n=0;
		}
		if ($n!=0){
			$array=array();
			for ($i=0;$i<$n; $i++){
				$harga=$data['departures']['result'][$i]['price_value'];
				$harga=str_replace('.00','',$harga);
				$harga=formatRupiah($harga);
				$flight_id=$data['departures']['result'][$i]['flight_id'];	
				$flight_number=$data['departures']['result'][$i]['flight_number'];
				$flight_icon=$data['departures']['result'][$i]['image'];
				$dt=$data['departures']['result'][$i]['simple_departure_time'];
				$at=$data['departures']['result'][$i]['simple_arrival_time'];
				$oken=$data['token'];
				$link='get-flight.php?token='.$oken.'&flight_id='.$flight_id.'&date='.$date.'&status='.$status.'&dari='.$dari.'&ke='.$ke.'&pergi='.$pergi.'&flight_number='.$flight_number.'&flight_icon='.$flight_icon.'&dt='.$dt.'&at='.$at.'&harga='.$harga;	
				$array[]=array(
				'airlines_name'=>'<img style="vertical-align:middle;" src="'.$data['departures']['result'][$i]['image'].'"> '.$data['departures']['result'][$i]['airlines_name'].' ('.$data['departures']['result'][$i]['flight_number'].')',
				'simple_departure_time'=>$dt,
				'simple_arrival_time'=>$at,
				'stop'=>$data['departures']['result'][$i]['stop'],
				'duration'=>$data['departures']['result'][$i]['duration'],
				'price_value'=>$harga.'  <a href="'.$link.'" class="btn btn-beli">Beli Tiket</a>');
			}	
			$dataphp=array('data'=>$array);
			$datajson=json_encode($dataphp);
			$fp = fopen('data/realtiket.json', 'w');
			fwrite($fp,$datajson);
			fclose($fp);
?>
			<div class="atap">
				<div class="row">
					<div class="col-md-4">
						<p align="left">
							<?php echo $dari;?> <span style="color:black;">ke</span> <?php echo $ke;?> 
						</p>
					</div>
					<div class="col-md-4">
						<p align="center">
							<?php
								if ($status=='0'){
									echo 'Sekali Jalan';
								}else if ($status=='1'){
									echo 'Pulang Pergi';
								}	
							?>
						</p>
					</div>
					<div class="col-md-4">
						<p align="right">
							<?php
								if ($status=='0'){
									echo $pergi;
								}else if ($status=='1'){
									echo $pergi.' <span style="color:black;">sampai</span> '.$pulang;
								}	
							?>
						</p>
					</div>	
				</div>
			</div>
			<table id="realtiket" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Pesawat</th>
						<th>Pergi</th>
						<th>Tiba</th>
						<th>Transit</th>
						<th>Durasi</th>
						<th>Harga</th>
					</tr>
				</thead>
			</table>
			<script>
				$(document).ready(function() {
					$('#realtiket').dataTable( {
						"ajax": "data/realtiket.json",
						"columns": [
							{ "data": "airlines_name" },
							{ "data": "simple_departure_time" },
							{ "data": "simple_arrival_time" },
							{ "data": "stop" },
							{ "data": "duration" },
							{ "data": "price_value" }
						]
					} );
				} );
			</script>
		<?php
		}else{
		?>
			<div class="atap">
				<div class="row">
					<div class="col-md-4">
						<p align="left">
							<?php echo $dari;?> <span style="color:black;">ke</span> <?php echo $ke;?> 
						</p>
					</div>
					<div class="col-md-4">
						<p align="center">
							<?php
								if ($status=='0'){
									echo 'Sekali Jalan';
								}else if ($status=='1'){
									echo 'Pulang Pergi';
								}	
							?>
						</p>
					</div>
					<div class="col-md-4">
						<p align="right">
							<?php
								if ($status=='0'){
									echo $pergi;
								}else if ($status=='1'){
									echo $pergi.' <span style="color:black;">sampai</span> '.$pulang;
								}	
							?>
						</p>
					</div>	
				</div>
			</div>
			<table id="realtiket" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td style="text-align:center;font-weight:bold;border:dashed 3px #f0ad4e;color:#f0ad4e;padding:10px;text-transform:uppercase;" colspan="6">Tidak Ada Data Penerbangan</td>
					</tr>
				</tbody>
			</table>
<?php
		}	
	}else if ($status=='1'){
		$jsonfile = "http://api.sandbox.tiket.com/search/flight?d=".$d."&a=".$a."&date=".$date."&ret_date=".$ret_date."&adult=".$adult."&child=".$child."&infant=".$infant."&token=".$Token."&output=json";
		$data = json_decode(file_get_contents($jsonfile), true);
		if (isset($data['departures']['result'])){
			$n=count($data['departures']['result']);
		}else{
			$n=0;
		}
		if (isset($data['returns']['result'])){
			$o=count($data['returns']['result']);
		}else{
			$o=0;
		}
		if(($n!=0)&&($o!=0)){
			$oken=$data['token'];
			$arraypergi=array();
			for ($i=0;$i<$n; $i++){
				$harga=$data['departures']['result'][$i]['price_value'];
				$harga=str_replace('.00','',$harga);
				$harga=formatRupiah($harga);	
				$flight_id=$data['departures']['result'][$i]['flight_id'];	
				$flight_number=$data['departures']['result'][$i]['flight_number'];
				$flight_icon=$data['departures']['result'][$i]['image'];
				$arraypergi[]=array(
					'airlines_name'=>$data['departures']['result'][$i]['airlines_name'],
					'simple_departure_time'=>$data['departures']['result'][$i]['simple_departure_time'],
					'simple_arrival_time'=>$data['departures']['result'][$i]['simple_arrival_time'],
					'stop'=>$data['departures']['result'][$i]['stop'],
					'duration'=>$data['departures']['result'][$i]['duration'],
					'price_value'=>$harga,
					'id'=>$flight_id,
					'number'=>$flight_number,
					'icon'=>$flight_icon
				);
			}	
			$arraypulang=array();
			for ($i=0;$i<$o; $i++){
				$harga=$data['returns']['result'][$i]['price_value'];
				$harga=str_replace('.00','',$harga);
				$harga=formatRupiah($harga);		
				$ret_flight_id=$data['returns']['result'][$i]['flight_id'];
				$ret_flight_number=$data['returns']['result'][$i]['flight_number'];
				$ret_flight_icon=$data['returns']['result'][$i]['image'];
				$arraypulang[]=array(
					'airlines_name'=>$data['returns']['result'][$i]['airlines_name'],
					'simple_departure_time'=>$data['returns']['result'][$i]['simple_departure_time'],
					'simple_arrival_time'=>$data['returns']['result'][$i]['simple_arrival_time'],
					'stop'=>$data['returns']['result'][$i]['stop'],
					'duration'=>$data['returns']['result'][$i]['duration'],
					'price_value'=>$harga,
					'id'=>$ret_flight_id,
					'number'=>$ret_flight_number,
					'icon'=>$ret_flight_icon
				);
			}
		
			$arpergi=array('data'=>$arraypergi);
			$datapergi=json_encode($arpergi);
			$arpulang=array('data'=>$arraypulang);
			$datapulang=json_encode($arpulang);
			$fpergi = fopen('data/realtiketpergi.json', 'w');
			fwrite($fpergi,$datapergi);
			$fpulang = fopen('data/realtiketpulang.json', 'w');
			fwrite($fpulang,$datapulang);
			
			fclose($fpergi);
			fclose($fpulang);
?>	
			<div class="row">
				<div class="col-md-12">
					<table id="pp" border="1" width="100%" style="margin-bottom:27px;">
						<thead>
							<tr>
								<th colspan="9" style="font-size:27px;">Tiket Pilihan Anda</th>
							</tr>
							<tr>
								<th>Bandara</th>
								<th>Maskapai</th>
								<th>Tanggal</th>
								<th>Pergi</th>
								<th>Tiba</th>
								<th>Transit</th>
								<th>Durasi</th>
								<th>Harga</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
						<tr class="pergi">
							<td style="padding-left:10px;"><b>Pergi:</b> <?php echo $dari;?></td>
							<td class="id" style="display:none;"><?php echo $arraypergi[0]['id'];?></td>
							<td class="maskapai">
								<img class="icon" style="vertical-align:middle;" src="<?php echo $arraypergi[0]['icon'];?>">
								<?php echo $arraypergi[0]['airlines_name'];?>
								(<span class="number"><?php echo $arraypergi[0]['number'];?></span>)
							</td>
							<td class="pergi"><?php echo $pergi;?></td>
							<td class="dt"><?php echo $arraypergi[0]['simple_departure_time'];?></td>
							<td class="at"><?php echo $arraypergi[0]['simple_arrival_time'];?></td>
							<td class="transit"><?php echo $arraypergi[0]['stop'];?></td>
							<td class="durasi"><?php echo $arraypergi[0]['duration'];?></td>
							<td class="harga"><?php echo $arraypergi[0]['price_value'];?></td>
							<td rowspan="2">
								<a href="#"  id="link" class="btn btn-beli" style="color:white;">Beli Tiket</a>
								<br><br>
								<span class="total-price"></span>
							</td>
						</tr>
						<tr class="pulang">
							<td style="padding-left:10px;"><b>Pulang:</b> <?php echo $ke;?></td>
							<td class="id" style="display:none;"><?php echo $arraypulang[0]['id'];?></td>
							<td class="maskapai">
								<img class="icon" style="vertical-align:middle;" src="<?php echo $arraypulang[0]['icon'];?>">
								<?php echo $arraypulang[0]['airlines_name'];?>
								(<span class="number"><?php echo $arraypulang[0]['number'];?></span>)
							</td>
							<td class="pulang"><?php echo $pulang;?></td>
							<td class="dt"><?php echo $arraypulang[0]['simple_departure_time'];?></td>
							<td class="at"><?php echo $arraypulang[0]['simple_arrival_time'];?></td>
							<td class="transit"><?php echo $arraypulang[0]['stop'];?></td>
							<td class="durasi"><?php echo $arraypulang[0]['duration'];?></td>
							<td class="harga" style="font-weight:normal;color: rgb(94, 93, 93);"><?php echo $arraypulang[0]['price_value'];?></td>
						</tr>
						</tbody>
					</table>
					<script>
						$('a#link').click(function() {
							var oken=<?php echo json_encode($oken);?>;
							var status=<?php echo json_encode($status);?>;
							
							var dari=<?php echo json_encode($dari);?>;
							var ke=<?php echo json_encode($ke);?>;
							
							var pergi=<?php echo json_encode($pergi);?>;
							var pulang=<?php echo json_encode($pulang);?>;
							
							var date=<?php echo json_encode($date);?>;
							var ret_date=<?php echo json_encode($ret_date);?>;
							
							var flight_id=$('tr.pergi td.id').text();
							var flight_icon=$('tr.pergi td.maskapai .icon').attr('src');
							var flight_number=$('tr.pergi td.maskapai .number').text();
							var dt=$('tr.pergi td.dt').text();
							var at=$('tr.pergi td.at').text();
							var harga=$('tr.pergi td.harga').text();
							
							var ret_flight_id=$('tr.pulang td.id').text();
							var ret_flight_icon=$('tr.pulang td.maskapai .icon').attr('src');
							var ret_flight_number=$('tr.pulang td.maskapai .number').text();
							var ret_dt=$('tr.pulang td.dt').text();
							var ret_at=$('tr.pulang td.at').text();
							var ret_harga=$('tr.pulang td.harga').text();
							
							var link='get-flight.php?token='+oken+'&status='+status+'&dari='+dari+'&ke='+ke+'&date='+date+'&ret_date='+ret_date+'&pergi='+pergi+'&pulang='+pulang+'&flight_id='+flight_id+'&ret_flight_id='+ret_flight_id+'&flight_icon='+flight_icon+'&flight_number='+flight_number+'&dt='+dt+'&at='+at+'&harga='+harga+'&ret_flight_icon='+ret_flight_icon+'&ret_flight_number='+ret_flight_number+'&ret_dt='+ret_dt+'&ret_at='+ret_at+'&ret_harga='+ret_harga;
							window.location=link;
						});
					</script>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="atap">
						<div class="row">
							<div class="col-md-8">
								<p align="left">
									<span style="color:black;">Pergi:</span> <?php echo $dari;?> <span style="color:black;">ke</span> <?php echo $ke;?> 
								</p>
							</div>
							<div class="col-md-4">
								<p align="right">
									<?php echo $pergi;?>
								</p>
							</div>	
						</div>
					</div>
					<table id="realtiketpergi" class="display" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>Pesawat</th>
								<th>Pergi</th>
								<th>Tiba</th>
								<th>Transit</th>
								<th>Durasi</th>
								<th>Harga</th>
							</tr>
						</thead>
					</table>
					<script>
						$(document).ready(function() {
							$('#realtiketpergi').dataTable( {
							"ajax": "data/realtiketpergi.json",
							"columns": [
								{ "data": "airlines_name" },
								{ "data": "simple_departure_time" },
								{ "data": "simple_arrival_time" },
								{ "data": "stop" },
								{ "data": "duration" },
								{ "data": "price_value" }
							]
							} );
						} );
					</script>	
				</div>
	
				<div class="col-md-6">
					<div class="atap">
						<div class="row">
							<div class="col-md-8">
								<p align="left">
									<span style="color:black;">Pulang:</span> <?php echo $ke;?> <span style="color:black;">ke</span> <?php echo $dari;?>
								</p>
							</div>
							<div class="col-md-4">
								<p align="right">
									<?php echo $pulang;?>
								</p>
							</div>	
						</div>
					</div>
					<table id="realtiketpulang" class="display" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>Pesawat</th>
								<th>Pergi</th>
								<th>Tiba</th>
								<th>Transit</th>
								<th>Durasi</th>
								<th>Harga</th>
							</tr>
						</thead>
					</table>
					<script>
						$(document).ready(function() {
							$('#realtiketpulang').dataTable( {
								"ajax": "data/realtiketpulang.json",
								"columns": [
									{ "data": "airlines_name" },
									{ "data": "simple_departure_time" },
									{ "data": "simple_arrival_time" },
									{ "data": "stop" },
									{ "data": "duration" },
									{ "data": "price_value" }
								]
							} );
						} );
					</script>	
				</div>
			</div>
<?php
		}else{
?>
			<div class="atap">
				<div class="row">
					<div class="col-md-4">
						<p align="left">
							<?php echo $dari;?> <span style="color:black;">ke</span> <?php echo $ke;?> 
						</p>
					</div>
					<div class="col-md-4">
						<p align="center">
							<?php
								if ($status=='0'){
									echo 'Sekali Jalan';
								}else if ($status=='1'){
									echo 'Pulang Pergi';
								}	
							?>
						</p>
					</div>
					<div class="col-md-4">
						<p align="right">
							<?php
								if ($status=='0'){
									echo $pergi;
								}else if ($status=='1'){
									echo $pergi.' <span style="color:black;">sampai</span> '.$pulang;
								}	
							?>
						</p>
					</div>	
				</div>
			</div>
			<table id="realtiket" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td style="text-align:center;font-weight:bold;border:dashed 3px #f0ad4e;color:#f0ad4e;padding:10px;text-transform:uppercase;" colspan="6">Tidak Ada Data Penerbangan</td>
					</tr>
				</tbody>
			</table>	
<?php
		}	
	}
}else{
	if ($status=='0'){
?>
	<div style="border:dashed 3px #f0ad4e;border-radius:3px;padding:10px;margin:10px 10%;">
		<p align="center">
			Maaf, <span class="highlight">token</span> Anda tidak valid. <br>
			Data yang tertampil di bawah ini <span class="highlight">bukan data real-time</span>. <br>
			Untuk menyelesaikan masalah ini, silahkan menghubungi saya di <a href="http://zainalabidin.me" class="highlight">www.zainalabidin.me</a>.
		</p>
	</div>
	<div class="atap">
		<div class="row">
			<div class="col-md-4">
				<p align="left">
					<?php echo $dari;?> <span style="color:black;">ke</span> <?php echo $ke;?> 
				</p>
			</div>
			<div class="col-md-4">
				<p align="center">
					<?php
						if ($status=='0'){
							echo 'Sekali Jalan';
						}else if ($status=='1'){
							echo 'Pulang Pergi';
						}	
					?>
				</p>
			</div>
			<div class="col-md-4">
				<p align="right">
					<?php
						if ($status=='0'){
							echo $pergi;
						}else if ($status=='1'){
							echo $pergi.' <span style="color:black;">sampai</span> '.$pulang;
						}	
					?>
				</p>
			</div>	
		</div>
	</div>
	<table id="tiket" class="display" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>Pesawat</th>
				<th>Pergi</th>
				<th>Tiba</th>
				<th>Transit</th>
				<th>Durasi</th>
				<th>Harga</th>
			</tr>
		</thead>
	</table>
	<script>
	$(document).ready(function() {
	$('#tiket').dataTable( {
        "ajax": "data/tiket.json",
        "columns": [
            { "data": "airlines_name" },
            { "data": "simple_departure_time" },
            { "data": "simple_arrival_time" },
            { "data": "stop" },
            { "data": "duration" },
            { "data": "price_value" }
        ]
    } );
	} );
	</script>
<?php
	}else if ($status=='1'){
?>
	<div style="border:dashed 3px #f0ad4e;border-radius:3px;padding:10px;margin:10px 10%;">
		<p align="center">
			Maaf, <span class="highlight">token</span> Anda tidak valid. <br>
			Data yang tertampil di bawah ini <span class="highlight">bukan data real-time</span>. <br>
			Untuk menyelesaikan masalah ini, silahkan menghubungi saya di <a href="http://zainalabidin.me" class="highlight">www.zainalabidin.me</a>.
		</p>
	</div>
	<div class="row">
				<div class="col-md-12">
					<table id="pp" border="1" width="100%" style="margin-bottom:27px;">
						<thead>
							<tr>
								<th colspan="9" style="font-size:27px;">Tiket Pilihan Anda</th>
							</tr>
							<tr>
								<th>Bandara</th>
								<th>Maskapai</th>
								<th>Tanggal</th>
								<th>Pergi</th>
								<th>Tiba</th>
								<th>Transit</th>
								<th>Durasi</th>
								<th>Harga</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
						<tr class="pergi">
							<td style="padding-left:10px;"><b>Pergi:</b> <?php echo $dari;?></td>
							<td class="maskapai">AIRASIA (QZ-7534)</td>
							<td class="maskapai"><?php echo $pergi;?></td>
							<td class="maskapai">21:40</td>
							<td class="maskapai">00:25</td>
							<td class="maskapai">Langsung</td>
							<td class="maskapai">1 j 45 m</td>
							<td class="harga">IDR 483.900</td>
							<td rowspan="2">
								<span class="total-price"></span>
							</td>
						</tr>
						<tr class="pulang">
							<td style="padding-left:10px;"><b>Pulang:</b> <?php echo $ke;?></td>
							<td class="maskapai">AIRASIA (QZ-7534)</td>
							<td class="maskapai"><?php echo $pulang;?></td>
							<td class="maskapai">21:40</td>
							<td class="maskapai">00:25</td>
							<td class="maskapai">Langsung</td>
							<td class="maskapai">1 j 45 m</td>
							<td class="harga" style="font-weight:normal;color: rgb(94, 93, 93);">IDR 483.900</td>
						</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="atap">
						<div class="row">
							<div class="col-md-8">
								<p align="left">
									<span style="color:black;">Pergi:</span> <?php echo $dari;?> <span style="color:black;">ke</span> <?php echo $ke;?> 
								</p>
							</div>
							<div class="col-md-4">
								<p align="right">
									<?php echo $pergi;?>
								</p>
							</div>	
						</div>
					</div>
					<table id="realtiketpergi" class="display" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>Pesawat</th>
								<th>Pergi</th>
								<th>Tiba</th>
								<th>Transit</th>
								<th>Durasi</th>
								<th>Harga</th>
							</tr>
						</thead>
					</table>
					<script>
						$(document).ready(function() {
							$('#realtiketpergi').dataTable( {
							"ajax": "data/tiket.json",
							"columns": [
								{ "data": "airlines_name" },
								{ "data": "simple_departure_time" },
								{ "data": "simple_arrival_time" },
								{ "data": "stop" },
								{ "data": "duration" },
								{ "data": "price_value" }
							]
							} );
						} );
					</script>	
				</div>
	
				<div class="col-md-6">
					<div class="atap">
						<div class="row">
							<div class="col-md-8">
								<p align="left">
									<span style="color:black;">Pulang:</span> <?php echo $ke;?> <span style="color:black;">ke</span> <?php echo $dari;?>
								</p>
							</div>
							<div class="col-md-4">
								<p align="right">
									<?php echo $pulang;?>
								</p>
							</div>	
						</div>
					</div>
					<table id="realtiketpulang" class="display" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>Pesawat</th>
								<th>Pergi</th>
								<th>Tiba</th>
								<th>Transit</th>
								<th>Durasi</th>
								<th>Harga</th>
							</tr>
						</thead>
					</table>
					<script>
						$(document).ready(function() {
							$('#realtiketpulang').dataTable( {
								"ajax": "data/tiket.json",
								"columns": [
									{ "data": "airlines_name" },
									{ "data": "simple_departure_time" },
									{ "data": "simple_arrival_time" },
									{ "data": "stop" },
									{ "data": "duration" },
									{ "data": "price_value" }
								]
							} );
						} );
					</script>	
				</div>
			</div>
<?php
	}	
}
?>