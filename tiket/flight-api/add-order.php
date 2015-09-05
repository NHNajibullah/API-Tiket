<?php
error_reporting(0);

require_once('../config/social.php');
require_once('../config/meta.php');
$title='Add Order | TIKET';
require_once('header.php');
?>
<section style="margin-top:30px;background:white;">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
<?php
$conSalutation=$_POST['conSalutation'];
$conFirstName=$_POST['conFirstName'];
$conLastName=$_POST['conLastName'];
$conPhone=$_POST['conPhone'];
$conEmailAddress=$_POST['conEmailAddress'];

$adult=$_POST['adult'];
$child=$_POST['child'];
$infant=$_POST['infant'];

$token=$_POST['token'];
$status=$_POST['status'];

if ($status=='0'){
	$flight_id=$_POST['flight_id'];
	$adults='';
	for ($i=1;$i<=$adult; $i++){
		$firstnamea{$i}=$_POST['firstnamea'.$i];
		$lastnamea{$i}=$_POST['lastnamea'.$i];
		$birthdatea{$i}=$_POST['birthdatea'.$i];
		$titlea{$i}=$_POST['titlea'.$i];
		$ida{$i}=$_POST['ida'.$i];
		$passportnationalitya{$i}=$_POST['passportnationalitya'.$i];
		$passportnoa{$i}=$_POST['passportnoa'.$i];
		$passportExpiryDatea{$i}=$_POST['passportExpiryDatea'.$i];
		$passportissueddatea{$i}=$_POST['passportissueddatea'.$i];
		$passportissuinga{$i}=$_POST['passportissuinga'.$i];
		$adult_link[]='&titlea'.$i.'='.$titlea{$i}.'&firstnamea'.$i.'='.$firstnamea{$i}.'&lastnamea'.$i.'='.$lastnamea{$i}.'&ida'.$i.'='.$ida{$i}.'&birthdatea'.$i.'='.$birthdatea{$i}.'&passportnoa'.$i.'='.$passportnoa{$i}.'&passportExpiryDatea'.$i.'='.$passportExpiryDatea{$i}.'&passportissueddatea'.$i.'='.$passportissueddatea{$i}.'&passportissuinga'.$i.'='.$passportissuinga{$i}.'&passportnationalitya'.$i.'='.$passportnationalitya{$i};
	}
	$adults=implode($adult_link);
	$childs='';
	for ($i=1;$i<=$child; $i++){
		$titlec{$i}=$_POST['titlec'.$i];
		$firstnamec{$i}=$_POST['firstnamec'.$i];
		$lastnamec{$i}=$_POST['lastnamec'.$i];
		$birthdatec{$i}=$_POST['birthdatec'.$i];
		$passportnationalityc{$i}=$_POST['passportnationalityc'.$i];
		$child_link[]='&titlec'.$i.'='.$titlec{$i}.'&firstnamec'.$i.'='.$firstnamec{$i}.'&lastnamec'.$i.'='.$lastnamec{$i}.'&birthdatec'.$i.'='.$birthdatec{$i}.'&passportnationalityc'.$i.'='.$passportnationalityc{$i};
	}
	$childs=implode($child_link);
	$infants='';
	for ($i=1;$i<=$infant; $i++){	
		$titlei{$i}=$_POST['titlei'.$i];
		$firstnamei{$i}=$_POST['firstnamei'.$i];
		$lastnamei{$i}=$_POST['lastnamei'.$i];
		$birthdatei{$i}=$_POST['birthdatei'.$i];
		$passportnationalityi{$i}=$_POST['passportnationalityi'.$i];
		$infant_link[]='&titlei'.$i.'='.$titlei{$i}.'&parenti1=1&firstnamei'.$i.'='.$firstnamei{$i}.'&lastnamei'.$i.'='.$lastnamei{$i}.'&birthdatei'.$i.'='.$birthdatei{$i}.'&passportnationalityi'.$i.'='.$passportnationalityi{$i};
	}	
	$infants=implode($infant_link);
	$pergilink='https://api.sandbox.tiket.com/order/add/flight?token='.$token.'&flight_id='.$flight_id.'&child='.$child.'&adult='.$adult.'&infant='.$infant.'&conSalutation='.$conSalutation.'&conFirstName='.$conFirstName.'&conLastName='.$conLastName.'&conPhone='.$conPhone.'&conEmailAddress='.$conEmailAddress.$adults.'&conOtherPhone='.$childs.$infants.'&output=json';
	$data = json_decode(file_get_contents($pergilink), true);
	echo $pergilink.'<br>';
	echo file_get_contents($pergilink).'<br>';
}else if ($status=='1'){
	$flight_id=$_POST['flight_id'];
	$adults='';
	for ($i=1;$i<=$adult; $i++){
		$firstnamea{$i}=$_POST['firstnamea'.$i];
		$lastnamea{$i}=$_POST['lastnamea'.$i];
		$birthdatea{$i}=$_POST['birthdatea'.$i];
		$titlea{$i}=$_POST['titlea'.$i];
		$ida{$i}=$_POST['ida'.$i];
		$passportnationalitya{$i}=$_POST['passportnationalitya'.$i];
		$passportnoa{$i}=$_POST['passportnoa'.$i];
		$passportExpiryDatea{$i}=$_POST['passportExpiryDatea'.$i];
		$passportissueddatea{$i}=$_POST['passportissueddatea'.$i];
		$passportissuinga{$i}=$_POST['passportissuinga'.$i];
		$adult_link[]='&titlea'.$i.'='.$titlea{$i}.'&firstnamea'.$i.'='.$firstnamea{$i}.'&lastnamea'.$i.'='.$lastnamea{$i}.'&ida'.$i.'='.$ida{$i}.'&birthdatea'.$i.'='.$birthdatea{$i}.'&passportnoa'.$i.'='.$passportnoa{$i}.'&passportExpiryDatea'.$i.'='.$passportExpiryDatea{$i}.'&passportissueddatea'.$i.'='.$passportissueddatea{$i}.'&passportissuinga'.$i.'='.$passportissuinga{$i}.'&passportnationalitya'.$i.'='.$passportnationalitya{$i};
	}
	$adults=implode($adult_link);
	$childs='';
	for ($i=1;$i<=$child; $i++){
		$titlec{$i}=$_POST['titlec'.$i];
		$firstnamec{$i}=$_POST['firstnamec'.$i];
		$lastnamec{$i}=$_POST['lastnamec'.$i];
		$birthdatec{$i}=$_POST['birthdatec'.$i];
		$passportnationalityc{$i}=$_POST['passportnationalityc'.$i];
		$child_link[]='&titlec'.$i.'='.$titlec{$i}.'&firstnamec'.$i.'='.$firstnamec{$i}.'&lastnamec'.$i.'='.$lastnamec{$i}.'&birthdatec'.$i.'='.$birthdatec{$i}.'&passportnationalityc'.$i.'='.$passportnationalityc{$i};
	}
	$childs=implode($child_link);
	$infants='';
	for ($i=1;$i<=$infant; $i++){	
		$titlei{$i}=$_POST['titlei'.$i];
		$firstnamei{$i}=$_POST['firstnamei'.$i];
		$lastnamei{$i}=$_POST['lastnamei'.$i];
		$birthdatei{$i}=$_POST['birthdatei'.$i];
		$passportnationalityi{$i}=$_POST['passportnationalityi'.$i];
		$infant_link[]='&titlei'.$i.'='.$titlei{$i}.'&parenti1=1&firstnamei'.$i.'='.$firstnamei{$i}.'&lastnamei'.$i.'='.$lastnamei{$i}.'&birthdatei'.$i.'='.$birthdatei{$i}.'&passportnationalityi'.$i.'='.$passportnationalityi{$i};
	}	
	$infants=implode($infant_link);
	$pergilink='https://api.sandbox.tiket.com/order/add/flight?token='.$token.'&flight_id='.$flight_id.'&child='.$child.'&adult='.$adult.'&infant='.$infant.'&conSalutation='.$conSalutation.'&conFirstName='.$conFirstName.'&conLastName='.$conLastName.'&conPhone='.$conPhone.'&conEmailAddress='.$conEmailAddress.$adults.'&conOtherPhone='.$childs.$infants.'&output=json';
	$data = json_decode(file_get_contents($pergilink), true);
	echo $pergilink.'<br>';
	echo file_get_contents($pergilink).'<br>';
	
	$ret_flight_id=$_POST['ret_flight_id'];
	$adults='';
	for ($i=1;$i<=$adult; $i++){
		$firstnamea{$i}=$_POST['firstnamea'.$i];
		$lastnamea{$i}=$_POST['lastnamea'.$i];
		$birthdatea{$i}=$_POST['birthdatea'.$i];
		$titlea{$i}=$_POST['titlea'.$i];
		$ida{$i}=$_POST['ida'.$i];
		$passportnationalitya{$i}=$_POST['passportnationalitya'.$i];
		$passportnoa{$i}=$_POST['passportnoa'.$i];
		$passportExpiryDatea{$i}=$_POST['passportExpiryDatea'.$i];
		$passportissueddatea{$i}=$_POST['passportissueddatea'.$i];
		$passportissuinga{$i}=$_POST['passportissuinga'.$i];
		$adult_link[]='&titlea'.$i.'='.$titlea{$i}.'&firstnamea'.$i.'='.$firstnamea{$i}.'&lastnamea'.$i.'='.$lastnamea{$i}.'&ida'.$i.'='.$ida{$i}.'&birthdatea'.$i.'='.$birthdatea{$i}.'&passportnoa'.$i.'='.$passportnoa{$i}.'&passportExpiryDatea'.$i.'='.$passportExpiryDatea{$i}.'&passportissueddatea'.$i.'='.$passportissueddatea{$i}.'&passportissuinga'.$i.'='.$passportissuinga{$i}.'&passportnationalitya'.$i.'='.$passportnationalitya{$i};
	}
	$adults=implode($adult_link);
	$childs='';
	for ($i=1;$i<=$child; $i++){
		$titlec{$i}=$_POST['titlec'.$i];
		$firstnamec{$i}=$_POST['firstnamec'.$i];
		$lastnamec{$i}=$_POST['lastnamec'.$i];
		$birthdatec{$i}=$_POST['birthdatec'.$i];
		$passportnationalityc{$i}=$_POST['passportnationalityc'.$i];
		$child_link[]='&titlec'.$i.'='.$titlec{$i}.'&firstnamec'.$i.'='.$firstnamec{$i}.'&lastnamec'.$i.'='.$lastnamec{$i}.'&birthdatec'.$i.'='.$birthdatec{$i}.'&passportnationalityc'.$i.'='.$passportnationalityc{$i};
	}
	$childs=implode($child_link);
	$infants='';
	for ($i=1;$i<=$infant; $i++){	
		$titlei{$i}=$_POST['titlei'.$i];
		$firstnamei{$i}=$_POST['firstnamei'.$i];
		$lastnamei{$i}=$_POST['lastnamei'.$i];
		$birthdatei{$i}=$_POST['birthdatei'.$i];
		$passportnationalityi{$i}=$_POST['passportnationalityi'.$i];
		$infant_link[]='&titlei'.$i.'='.$titlei{$i}.'&parenti1=1&firstnamei'.$i.'='.$firstnamei{$i}.'&lastnamei'.$i.'='.$lastnamei{$i}.'&birthdatei'.$i.'='.$birthdatei{$i}.'&passportnationalityi'.$i.'='.$passportnationalityi{$i};
	}	
	$infants=implode($infant_link);
	$pulanglink='https://api.sandbox.tiket.com/order/add/flight?token='.$token.'&flight_id='.$ret_flight_id.'&child='.$child.'&adult='.$adult.'&infant='.$infant.'&conSalutation='.$conSalutation.'&conFirstName='.$conFirstName.'&conLastName='.$conLastName.'&conPhone='.$conPhone.'&conEmailAddress='.$conEmailAddress.$adults.'&conOtherPhone='.$childs.$infants.'&output=json';
	$pulang = json_decode(file_get_contents($pergilink), true);
	echo $pulanglink.'<br>';
	echo file_get_contents($pulanglink).'<br>';
}
?>
			</div>
		</div>
	</div>
</section>

<?php
	require_once('footer.php');
?>