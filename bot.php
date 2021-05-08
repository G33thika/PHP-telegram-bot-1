<?php

$token = "1496077730:AAHRsipL11gAJXQxnjYvBgFTxp7aeifTnR4";
$web = "https://api.telegram.org/file/bot".$token;
$link01 = "https://api.telegram.org/bot".$token;

$updates = file_get_contents('php://input');
$updates = json_decode($updates, TRUE);
//updates
$msgID = $updates['message']['from']['id'];
$name = $updates['message']['from']['first_name'];
$text = $updates['message']['text'];


//callback
$callback = $updates['callback_query'];
$cbackdata = $callback['data'];
$quserID = $callback['from']['id'];
$mID = $callback['message']['message_id'];

$welcome = "Welcome $name";
$welcome2 = "Main Menu";
$select = "Select one";


$con = mysqli_connect("localhost","username","password");


//if reg
function checkreg($con,$mID,$quserID)
	{
		$text = "svgerv";
		mysqli_select_db($con,"id12999274_ccnadump");
		$sql = "SELECT * FROM `bot_usertable` WHERE user_ID='$quserID'";
        $result = mysqli_query($con,$sql);
		$numrows = mysqli_num_rows($result);
		if (!$con) {
		sample($quserID,$text);
	    }
		else{
		  if($numrows == 0){
		  reg($quserID,$mID);
	      }
	      else{
		  alreg($quserID,$mID);
	      }
		}
		mysqli_close($con);
		
	}

//if callback

//goback
if($cbackdata == "gobackxyz"){
	back($quserID,$mID,$welcome2);
}
//register
if($cbackdata == "regxyz"){
	checkreg($con,$mID,$quserID);
	
}

//addcountry
if($cbackdata == "adcntryxyz"){
	reqcnt($quserID,$mID);
	
}

//confreg
if($cbackdata == "regconfxyz")
{
	req($quserID,$mID);
}





//simple menu buttons

//menu A
//gift idea
if($cbackdata == "giftideaxyz")
{
	gift($quserID,$mID,$select);
	
}
//try luck
if($cbackdata == "tryluckxyz")
{
	
}
//calculator
if($cbackdata == "calxyz")
{
	
}
//Reminder
if($cbackdata == "reminderxyz")
{
	
}
//add friend
if($cbackdata == "friendxyz")
{
	
}

//menu B
//for him
if($cbackdata == "himxyz")
{
	forhim($quserID,$mID,$select);
}
//for her
if($cbackdata == "herxyz")
{
	forher($quserID,$mID,$select);
}
//for Kids
if($cbackdata == "kidsxyz")
{
	forkids($quserID,$mID,$select);
}
//Corporate
if($cbackdata == "copxyz")
{
	coporate($quserID,$mID,$select);
}
//Occasion
if($cbackdata == "occaxyz")
{
	occation($quserID,$mID,$select);
}

//menu C
//hobbies
if($cbackdata == "hobbyxyz")
{
	hc1($quserID,$mID,$select);
}
//occasion
if($cbackdata == "baseoccaxyz"){
	oc1($quserID,$mID,$select);
}

//menu D
if($cbackdata == "hobby2xyz")
{
	hd2($quserID,$mID,$select);
}
//occasion
if($cbackdata == "baseocca2xyz"){
	od2($quserID,$mID,$select);
}

//menu E
if($cbackdata == "hobby3xyz")
{
	he3($quserID,$mID,$select);
}
//occasion
if($cbackdata == "baseocca3xyz"){
	oe3($quserID,$mID,$select);
}

//if msg
switch($text)
{
		case"/start":
		startmsg($msgID,$welcome);
		break;
		case"info":
		info($msgID);
		break;
		default:
			if(substr( $text, 0, 5 ) === "name-"){
				$pname = substr($text,5);
				confreg($msgID,$con,$pname);
			}
		    elseif(substr( $text, 0, 8 ) === "country-"){
				$couname = substr($text,8);
			    upcountry($msgID,$con,$couname);
		    }
			elseif(substr( $text, 0, 4 ) === "ref-"){
				$refc = substr($text,4);
			    addfr($msgID,$con,$refc);
		    }
			elseif(substr( $text, 0, 2 ) === "19"){
				$andate = substr($text,0,4);
				cal($msgID,$andate);
			}
			elseif(substr( $text, 0, 2 ) === "20"){
				$andate = substr($text,0,4);
				cal($msgID,$andate);
			}
			else{
				$rmarray = (explode("-",$text));
				if(substr($rmarray[1], 0, 2 ) === "19"){
					remind($msgID,$con,$rmarray);
				}
				elseif(substr($rmarray[1], 0, 2 ) === "20"){
					remind($msgID,$con,$rmarray);
				}
				else{
					$error = "Sorry pleace check and try again...!";
					sample($msgID,$error);
				}
				
			}
}


//functions

//sample 
function sample($msgID,$text)
{
	
    $inline = '&reply_markup={"inline_keyboard":[[{"text":"Back to Main Menu","callback_data":"gobackxyz"}]]}';
	$url22 = $GLOBALS[link01].'/sendMessage?chat_id='.$msgID.'&text='.urlencode($text).$inline;
	file_get_contents($url22);
	
}

//start msg
function startmsg($msgID,$text)
{
	
	
	$inline = '&reply_markup={"inline_keyboard":[[{"text":"Gift idea","callback_data":"giftideaxyz"},{"text":"Try My Luck","callback_data":"tryluckxyz"}],[{"text":"Calculator","callback_data":"calxyz"},{"text":"Reminder","callback_data":"reminderxyz"}],[{"text":"Add a friend","callback_data":"friendxyz"},{"text":"Channel","url":"https://t.me/trygiftidea"}],[{"text":"Register","callback_data":"regxyz"}]]}';
    $url2 = $GLOBALS[link01].'/sendMessage?chat_id='.$msgID.'&text='.urlencode($text).$inline;
	file_get_contents($url2);
	
	
}

//gift idea
function gift($quserID,$mID,$text)
{
	$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
	file_get_contents($url1);
	
	$inline = '&reply_markup={"inline_keyboard":[[{"text":"For him","callback_data":"himxyz"},{"text":"For her","callback_data":"herxyz"}],[{"text":"For kids","callback_data":"kidsxyz"},{"text":"Corporate","callback_data":"copxyz"}],[{"text":"Occasion","callback_data":"occaxyz"},{"text":"Personalized","callback_data":"personxyz"}],[{"text":"Back to Main Menu","callback_data":"gobackxyz"}]]}';
	$url2 = $GLOBALS[link01].'/sendMessage?chat_id='.$quserID.'&text='.urlencode($text).$inline;
	file_get_contents($url2);
}

//Back to main menu
function back($quserID,$mID,$text)
{
	$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
	file_get_contents($url1);
	$inline = '&reply_markup={"inline_keyboard":[[{"text":"Gift idea","callback_data":"giftideaxyz"},{"text":"Try My Luck","callback_data":"tryluckxyz"}],[{"text":"Calculator","callback_data":"calxyz"},{"text":"Reminder","callback_data":"reminderxyz"}],[{"text":"Add a friend","callback_data":"friendxyz"},{"text":"Channel","url":"https://t.me/trygiftidea"}],[{"text":"Register","callback_data":"regxyz"}]]}';
    $url2 = $GLOBALS[link01].'/sendMessage?chat_id='.$quserID.'&text='.urlencode($text).$inline;
	file_get_contents($url2);
	
}

//register confermation
function reg($quserID,$mID){
	
	$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
	file_get_contents($url1);
	$text = "Are you sure ?";
	$inline = '&reply_markup={"inline_keyboard":[[{"text":"YES","callback_data":"regconfxyz"}],[{"text":"Back to Main Menu","callback_data":"gobackxyz"}]]}';
	$url2 = $GLOBALS[link01].'/sendMessage?chat_id='.$quserID.'&text='.urlencode($text).$inline;
	file_get_contents($url2);
}

//alrady reg
function alreg($quserID,$mID){
	
	$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
	file_get_contents($url1);
	$text = "You alrady Registered";
	$inline = '&reply_markup={"inline_keyboard":[[{"text":"Back to Main Menu","callback_data":"gobackxyz"}]]}';
	$url2 = $GLOBALS[link01].'/sendMessage?chat_id='.$quserID.'&text='.urlencode($text).$inline;
	file_get_contents($url2);
}


//req name
function req($quserID,$mID){
	
	$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
	file_get_contents($url1);
	$text = "Enter your Name this format: \n\n name-mike \n\n copy paste and enter your name";
	$inline = '&reply_markup={"inline_keyboard":[[{"text":"Back to Main Menu","callback_data":"gobackxyz"}]]}';
	$url2 = $GLOBALS[link01].'/sendMessage?chat_id='.$quserID.'&text='.urlencode($text).$inline;
	file_get_contents($url2);
	
}

//req country
function reqcnt($quserID,$mID){
	
	$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
	file_get_contents($url1);
	$text = "Enter your Country this format: \n\n country-India \n\n copy paste and enter your Country";
	$url2 = $GLOBALS[link01].'/sendMessage?chat_id='.$quserID.'&text='.urlencode($text);
	file_get_contents($url2);
	
}

//conf reg
function confreg($msgID,$con,$pname){
    $date = date('Y-m-d');
	mysqli_select_db($con,"id12999274_ccnadump");
	$sql = "INSERT INTO `bot_usertable` (`user_ID`, `user_name`, `country`, `ref_ID`, `entry_date`) VALUES ('$msgID', '$pname', '', '', '$date')";
    $result = mysqli_query($con,$sql);
	  if ($result){
		  $text = "Registation completed ..";
	$inline = '&reply_markup={"inline_keyboard":[[{"text":"Add country","callback_data":"adcntryxyz"}]]}';
	$url21 = $GLOBALS[link01].'/sendMessage?chat_id='.$msgID.'&text='.urlencode($text).$inline;
	file_get_contents($url21);
	  }
	else{
		$text2 = "Registation not completed ..";
	$inline = '&reply_markup={"inline_keyboard":[[{"text":"Back to Main Menu","callback_data":"gobackxyz"}]]}';
	$url22 = $GLOBALS[link01].'/sendMessage?chat_id='.$msgID.'&text='.urlencode($text2).$inline;
	file_get_contents($url22);
	}
}



//update country
function upcountry($msgID,$con,$couname){
	mysqli_select_db($con,"id12999274_ccnadump");
	$sql = "UPDATE `bot_usertable` SET country='$couname' WHERE user_ID='$msgID'";
    $result = mysqli_query($con,$sql);
	if ($result){
		  $text = "Updated";
	$inline = '&reply_markup={"inline_keyboard":[[{"text":"Add Friends referral code","callback_data":"adrfcxyz"}],[{"text":"Back to Main Menu","callback_data":"gobackxyz"}]]}';
	$url21 = $GLOBALS[link01].'/sendMessage?chat_id='.$msgID.'&text='.urlencode($text).$inline;
	file_get_contents($url21);
	  }
	else{
		$text2 = "Retry";
	$inline = '&reply_markup={"inline_keyboard":[[{"text":"Add country","callback_data":"adcntryxyz"}]]}';
	$url22 = $GLOBALS[link01].'/sendMessage?chat_id='.$msgID.'&text='.urlencode($text2).$inline;
	file_get_contents($url22);
	}
}



//menu C
function forhim($quserID,$mID,$text)
{
	$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
	file_get_contents($url1);
	
	$inline = '&reply_markup={"inline_keyboard":[[{"text":"Dad","callback_data":"dadxyz"},{"text":"Brother","callback_data":"broxyz"}],[{"text":"Son","callback_data":"sonxyz"},{"text":"Boy friend","callback_data":"bfxyz"}],[{"text":"Husband","callback_data":"husxyz"},{"text":"Grandfather","callback_data":"grandfxyz"}],[{"text":"Based on hobbies","callback_data":"hobbyxyz"},{"text":"Based on Occasions","callback_data":"baseoccaxyz"}],[{"text":"Back to Main Menu","callback_data":"gobackxyz"}]]}';
	$url2 = $GLOBALS[link01].'/sendMessage?chat_id='.$quserID.'&text='.urlencode($text).$inline;
	file_get_contents($url2);
}


//menu D
function forher($quserID,$mID,$text)
{
	$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
	file_get_contents($url1);
	
	$inline = '&reply_markup={"inline_keyboard":[[{"text":"Mom","callback_data":"momxyz"},{"text":"Sister","callback_data":"sisxyz"}],[{"text":"Daughter","callback_data":"daughterxyz"},{"text":"Girl friend","callback_data":"gfxyz"}],[{"text":"Wife","callback_data":"wifexyz"},{"text":"Grand mom","callback_data":"grandmxyz"}],[{"text":"Based on hobbies","callback_data":"hobby2xyz"},{"text":"Based on Occasions","callback_data":"baseocca2xyz"}],[{"text":"Back to Main Menu","callback_data":"gobackxyz"}]]}';
	$url2 = $GLOBALS[link01].'/sendMessage?chat_id='.$quserID.'&text='.urlencode($text).$inline;
	file_get_contents($url2);
}


//menu E
function forkids($quserID,$mID,$text)
{
	$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
	file_get_contents($url1);
	
	$inline = '&reply_markup={"inline_keyboard":[[{"text":"New born","callback_data":"nbornabc"},{"text":"Age 1 to 3","callback_data":"age1t3abc"}],[{"text":"Age 4 to 5","callback_data":"age4t5abc"},{"text":"Age 6 to 10","callback_data":"age6t10abc"}],[{"text":"Based on hobbies","callback_data":"hobby3xyz"},{"text":"Based on Occasions","callback_data":"baseocca3xyz"}],[{"text":"Back to Main Menu","callback_data":"gobackxyz"}]]}';
	$url2 = $GLOBALS[link01].'/sendMessage?chat_id='.$quserID.'&text='.urlencode($text).$inline;
	file_get_contents($url2);
}


//menu F
function coporate($quserID,$mID,$text)
{
	$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
	file_get_contents($url1);
	
	$inline = '&reply_markup={"inline_keyboard":[[{"text":"Boss","callback_data":"bossabc"},{"text":"Employee","callback_data":"empabc"}],[{"text":"Thank you","callback_data":"thankabc"},{"text":"Well done","callback_data":"wellabc"}],[{"text":"Back to Main Menu","callback_data":"gobackxyz"}]]}';
	$url2 = $GLOBALS[link01].'/sendMessage?chat_id='.$quserID.'&text='.urlencode($text).$inline;
	file_get_contents($url2);
}


//menu G
function occation($quserID,$mID,$text){
	
	$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
	file_get_contents($url1);
	
	$inline = '&reply_markup={"inline_keyboard":[[{"text":"Birthday","callback_data":"birthdayxyz"},{"text":"Anniversary","callback_data":"anniversaryxyz"}],[{"text":"House warming","callback_data":"ousexyz"},{"text":"Thank you","callback_data":"thankyouxyz"}],[{"text":"Retirement day","callback_data":"retirementdayxyz"},{"text":"Get Well Soon","callback_data":"getwellxyz"}],[{"text":"Baby Shower","callback_data":"bbyshowxyz"},{"text":"Holiday Gifts","callback_data":"hdayxyz"}],[{"text":"Back to Main Menu","callback_data":"gobackxyz"}]]}';
	$url2 = $GLOBALS[link01].'/sendMessage?chat_id='.$quserID.'&text='.urlencode($text).$inline;
	file_get_contents($url2);
}


//menu h.1
function hc1($quserID,$mID,$text)
{
	$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
	file_get_contents($url1);
	
	$inline = '&reply_markup={"inline_keyboard":[[{"text":"Sports","callback_data":"h1spabc"},{"text":"Travel","callback_data":"h1trabc"}],[{"text":"Cooking","callback_data":"h1coabc"},{"text":"Arts","callback_data":"h1artabc"}],[{"text":"Techie","callback_data":"h1techxyz"},{"text":"Books","callback_data":"h1bookxyz"}],[{"text":"Back to Main Menu","callback_data":"gobackxyz"}]]}';
	$url2 = $GLOBALS[link01].'/sendMessage?chat_id='.$quserID.'&text='.urlencode($text).$inline;
	file_get_contents($url2);
}

//menu h.2
function hd2($quserID,$mID,$text)
{
	$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
	file_get_contents($url1);
	
	$inline = '&reply_markup={"inline_keyboard":[[{"text":"Sports","callback_data":"h2spabc"},{"text":"Travel","callback_data":"h2trabc"}],[{"text":"Cooking","callback_data":"h2coabc"},{"text":"Arts","callback_data":"h2artabc"}],[{"text":"Techie","callback_data":"h2techxyz"},{"text":"Books","callback_data":"h2bookxyz"}],[{"text":"Back to Main Menu","callback_data":"gobackxyz"}]]}';
	$url2 = $GLOBALS[link01].'/sendMessage?chat_id='.$quserID.'&text='.urlencode($text).$inline;
	file_get_contents($url2);
}

//menu h.3
function he3($quserID,$mID,$text)
{
	$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
	file_get_contents($url1);
	
	$inline = '&reply_markup={"inline_keyboard":[[{"text":"Sports","callback_data":"h3spabc"},{"text":"Arts","callback_data":"h3artabc"}],[{"text":"Games","callback_data":"h3gamexyz"},{"text":"Books","callback_data":"h3bookxyz"}],[{"text":"Back to Main Menu","callback_data":"gobackxyz"}]]}';
	$url2 = $GLOBALS[link01].'/sendMessage?chat_id='.$quserID.'&text='.urlencode($text).$inline;
	file_get_contents($url2);
}

//menu O.1
function oc1($quserID,$mID,$text)
{
	$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
	file_get_contents($url1);
	
	$inline = '&reply_markup={"inline_keyboard":[[{"text":"Birthday","callback_data":"o1bdabc"},{"text":"Anniversary","callback_data":"o1anabc"}],[{"text":"New year","callback_data":"o1nwabc"},{"text":"Father’s day","callback_data":"o1fdabc"}],[{"text":"Valentine’s day","callback_data":"o1vdabc"},{"text":"Friendship day","callback_data":"o1frndabc"}],[{"text":"Back to Main Menu","callback_data":"gobackxyz"}]]}';
	$url2 = $GLOBALS[link01].'/sendMessage?chat_id='.$quserID.'&text='.urlencode($text).$inline;
	file_get_contents($url2);
}
//menu o.2
function od2($quserID,$mID,$text)
{
	$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
	file_get_contents($url1);
	
	$inline = '&reply_markup={"inline_keyboard":[[{"text":"Birthday","callback_data":"o2bdabc"},{"text":"Anniversary","callback_data":"o2anabc"}],[{"text":"New year","callback_data":"o2nwabc"},{"text":"Mother’s day","callback_data":"o2fdabc"}],[{"text":"Valentine’s day","callback_data":"o2vdabc"},{"text":"Friendship day","callback_data":"o2frndabc"}],[{"text":"Back to Main Menu","callback_data":"gobackxyz"}]]}';
	$url2 = $GLOBALS[link01].'/sendMessage?chat_id='.$quserID.'&text='.urlencode($text).$inline;
	file_get_contents($url2);
}

//menu o.3
function oe3($quserID,$mID,$text)
{
	$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
	file_get_contents($url1);
	
	$inline = '&reply_markup={"inline_keyboard":[[{"text":"Birthday","callback_data":"o3bdabc"},{"text":"Baby shower","callback_data":"o3bshabc"}],[{"text":"New year","callback_data":"o3nwabc"},{"text":"Exam day","callback_data":"o3exdabc"}],[{"text":"Back to Main Menu","callback_data":"gobackxyz"}]]}';
	$url2 = $GLOBALS[link01].'/sendMessage?chat_id='.$quserID.'&text='.urlencode($text).$inline;
	file_get_contents($url2);
}



//data displaying section..............................................................................................
function display($quserID,$mID,$con,$tag){
	
	mysqli_select_db($con,"id12999274_ccnadump");
		$sql = "SELECT * FROM `bot_producttable` WHERE product_tag='$tag'";
        $result = mysqli_query($con,$sql);
		if ($result){
		while($row = mysqli_fetch_object($result)){

			$price = $row->product_price;
			$imagelink = $row->product_img;
			$plink = $row->product_link;
			$product_title = $row->	product_title;
			$pdetails = "Title: $product_title \n Price: $price \n Link: $plink";
			$url2 = $GLOBALS[link01].'/sendPhoto?chat_id='.$quserID.'&photo='.$imagelink.'&caption='.urlencode($pdetails);
			file_get_contents($url2);
			$price ="";

		}
			$text = "Select One";
			back($quserID,$mID,$text);
		}
	    else{
			$error = "Server getting an error";
			$url2 = $GLOBALS[link01].'/sendMessage?chat_id='.$quserID.'&text='.urlencode($error);
			file_get_contents($url2);
		}
}

//calback .......................................
//menu C ....................
//dad
if($cbackdata == "dadxyz")
{
	dad($quserID,$mID,$con);
}
//brother
if($cbackdata == "broxyz")
{
	bro($quserID,$mID,$con);
}
//son
if($cbackdata == "sonxyz")
{
	son($quserID,$mID,$con);
}
//boy friend
if($cbackdata == "bfxyz")
{
	boyf($quserID,$mID,$con);
}
//husband
if($cbackdata == "husxyz")
{
	husband($quserID,$mID,$con);
}
//grandfather
if($cbackdata == "grandfxyz")
{
	grandf($quserID,$mID,$con);
}

//menu D ....................
//mom
if($cbackdata == "momxyz")
{
	mom($quserID,$mID,$con);
}
//sister
if($cbackdata == "sisxyz")
{
	sis($quserID,$mID,$con);
}
//daugter
if($cbackdata == "daughterxyz")
{
	daughter($quserID,$mID,$con);
}
//gf
if($cbackdata == "gfxyz")
{
	girlf($quserID,$mID,$con);
}
//wife
if($cbackdata == "wifexyz")
{
	wife($quserID,$mID,$con);
}
//grandmom
if($cbackdata == "grandmxyz")
{
	grandm($quserID,$mID,$con);
}
//function.......................................
//menu C.....................
//dad
function dad($quserID,$mID,$con){

		$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
		file_get_contents($url1);
	
		$tag = "Dad";
	
		display($quserID,$mID,$con,$tag);
						
}
//brother
function bro($quserID,$mID,$con){

		$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
		file_get_contents($url1);
	
		$tag = "Brother";
	
		display($quserID,$mID,$con,$tag);
						
}
//son
function son($quserID,$mID,$con){

		$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
		file_get_contents($url1);
	
		$tag = "Son";
	
		display($quserID,$mID,$con,$tag);
						
}
//boy friend
function boyf($quserID,$mID,$con){

		$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
		file_get_contents($url1);
	
		$tag = "Boy friend";
	
		display($quserID,$mID,$con,$tag);
						
}
//Husband
function husband($quserID,$mID,$con){

		$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
		file_get_contents($url1);
	
		$tag = "Husband";
	
		display($quserID,$mID,$con,$tag);
						
}
//grandfather
function grandf($quserID,$mID,$con){

		$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
		file_get_contents($url1);
	
		$tag = "Grandfather";
	
		display($quserID,$mID,$con,$tag);
						
}



//menu C.....................
//mom
function mom($quserID,$mID,$con){

		$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
		file_get_contents($url1);
	
		$tag = "Mom";
	
		display($quserID,$mID,$con,$tag);
						
}
//sister
function sis($quserID,$mID,$con){

		$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
		file_get_contents($url1);
	
		$tag = "Sister";
	
		display($quserID,$mID,$con,$tag);
						
}
//daughter
function daughter($quserID,$mID,$con){

		$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
		file_get_contents($url1);
	
		$tag = "Daughter";
	
		display($quserID,$mID,$con,$tag);
						
}
//gf
function girlf($quserID,$mID,$con){

		$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
		file_get_contents($url1);
	
		$tag = "Girl Friend";
	
		display($quserID,$mID,$con,$tag);
						
}
//wife
function wife($quserID,$mID,$con){

		$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
		file_get_contents($url1);
	
		$tag = "Wife";
	
		display($quserID,$mID,$con,$tag);
						
}
//grand mom
function grandm($quserID,$mID,$con){

		$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
		file_get_contents($url1);
	
		$tag = "Grand Mom";
	
		display($quserID,$mID,$con,$tag);
						
}



//calback .......................................
//menu E ....................
//newborn
if($cbackdata == "nbornabc")
{
	newborn($quserID,$mID,$con);
}
//age 1- 3
if($cbackdata == "age1t3abc")
{
	age13($quserID,$mID,$con);
}
//age 4- 5
if($cbackdata == "age4t5abc")
{
	age45($quserID,$mID,$con);
}
//age 6- 10
if($cbackdata == "age6t10abc")
{
	age610($quserID,$mID,$con);
}


//function.......................................
//menu E.....................
//age6-10
function age610($quserID,$mID,$con){

		$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
		file_get_contents($url1);
	
		$tag = "Age 6 to 10";
	
		display($quserID,$mID,$con,$tag);
						
}
//age4-5
function age45($quserID,$mID,$con){

		$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
		file_get_contents($url1);
	
		$tag = "Age 4 to 5";
	
		display($quserID,$mID,$con,$tag);
						
}
//age1-3
function age13($quserID,$mID,$con){

		$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
		file_get_contents($url1);
	
		$tag = "Age 1 to 3";
	
		display($quserID,$mID,$con,$tag);
						
}
//newborn
function newborn($quserID,$mID,$con){

		$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
		file_get_contents($url1);
	
		$tag = "New Born";
	
		display($quserID,$mID,$con,$tag);
						
}




//calback .......................................
//menu F ....................
//boss
if($cbackdata == "bossabc")
{
	boss($quserID,$mID,$con);
}
//Employee
if($cbackdata == "empabc")
{
	employee($quserID,$mID,$con);
}
//Thank you
if($cbackdata == "thankabc")
{
	thankyou($quserID,$mID,$con);
}
//Well done
if($cbackdata == "wellabc")
{
	welldone($quserID,$mID,$con);
}
//function.......................................
//menu E.....................
//welldone
function welldone($quserID,$mID,$con){

		$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
		file_get_contents($url1);
	
		$tag = "Well done";
	
		display($quserID,$mID,$con,$tag);
						
}
//thank you
function thankyou($quserID,$mID,$con){

		$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
		file_get_contents($url1);
	
		$tag = "Thank You";
	
		display($quserID,$mID,$con,$tag);
						
}
//Employee
function employee($quserID,$mID,$con){

		$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
		file_get_contents($url1);
	
		$tag = "Employee";
	
		display($quserID,$mID,$con,$tag);
						
}
//boss
function boss($quserID,$mID,$con){

		$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
		file_get_contents($url1);
	
		$tag = "Boss";
	
		display($quserID,$mID,$con,$tag);
						
}




//calback .......................................
//menu G ....................
//Birth day
if($cbackdata == "birthdayxyz")
{
	bday($quserID,$mID,$con);
}
//Anniversary
if($cbackdata == "anniversaryxyz")
{
	anni($quserID,$mID,$con);
}
//House warming
if($cbackdata == "ousexyz")
{
	hwarming($quserID,$mID,$con);
}
//Thank you
if($cbackdata == "thankyouxyz")
{
	thanyou($quserID,$mID,$con);
}
//Retirement day
if($cbackdata == "retirementdayxyz")
{
	tetir($quserID,$mID,$con);
}
//Get Well Soon
if($cbackdata == "getwellxyz")
{
	getwell($quserID,$mID,$con);
}
//Baby Shower
if($cbackdata == "bbyshowxyz")
{
	showerbaby($quserID,$mID,$con);
}
//Holiday Gifts
if($cbackdata == "hdayxyz")
{
	holyd($quserID,$mID,$con);
}

//function.......................................
//menu G.....................
//Holiday Gifts
function holyd($quserID,$mID,$con){

		$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
		file_get_contents($url1);
	
		$tag = "Holiday Gifts";
	
		display($quserID,$mID,$con,$tag);
						
}
//Baby Shower
function showerbaby($quserID,$mID,$con){

		$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
		file_get_contents($url1);
	
		$tag = "Baby Shower";
	
		display($quserID,$mID,$con,$tag);
						
}
//Get Well Soon
function getwell($quserID,$mID,$con){

		$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
		file_get_contents($url1);
	
		$tag = "Get Well Soon";
	
		display($quserID,$mID,$con,$tag);
						
}
//Retirement day
function tetir($quserID,$mID,$con){

		$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
		file_get_contents($url1);
	
		$tag = "Retirement day";
	
		display($quserID,$mID,$con,$tag);
						
}
//Thank you
function thanyou($quserID,$mID,$con){

		$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
		file_get_contents($url1);
	
		$tag = "House Warming";
	
		display($quserID,$mID,$con,$tag);
						
}
//House warming
function hwarming($quserID,$mID,$con){

		$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
		file_get_contents($url1);
	
		$tag = "House Warming";
	
		display($quserID,$mID,$con,$tag);
						
}
//Anniversary
function anni($quserID,$mID,$con){

		$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
		file_get_contents($url1);
	
		$tag = "Anniversary";
	
		display($quserID,$mID,$con,$tag);
						
}
//Birthday
function bday($quserID,$mID,$con){

		$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
		file_get_contents($url1);
	
		$tag = "Birthday";
	
		display($quserID,$mID,$con,$tag);
						
}


//menu h ................................................................................
//function .....................................
function mainhmenu($quserID,$mID,$con,$tag){

		$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
		file_get_contents($url1);
	
		display($quserID,$mID,$con,$tag);
						
}

//calback .......................................
//h.1.............................
//sport
if($cbackdata == "h1spabc")
{
	$tag = "Him Sports";
	mainhmenu($quserID,$mID,$con,$tag);
}
//Travel
if($cbackdata == "h1trabc")
{
	$tag = "Him Travel";
	mainhmenu($quserID,$mID,$con,$tag);
}
//cookig
if($cbackdata == "h1coabc")
{
	$tag = "Him Cooking";
	mainhmenu($quserID,$mID,$con,$tag);
}
//Arts
if($cbackdata == "h1artabc")
{
	$tag = "Him Arts";
	mainhmenu($quserID,$mID,$con,$tag);
}
//tech
if($cbackdata == "h1techxyz")
{
	$tag = "Him Techie";
	mainhmenu($quserID,$mID,$con,$tag);
}
//book
if($cbackdata == "h1bookxyz")
{
	$tag = "Him Books";
	mainhmenu($quserID,$mID,$con,$tag);
}

//h.2...............................
//sport
if($cbackdata == "h2spabc")
{
	$tag = "Her Sports";
	mainhmenu($quserID,$mID,$con,$tag);
}
//Travel
if($cbackdata == "h2trabc")
{
	$tag = "Her Travel";
	mainhmenu($quserID,$mID,$con,$tag);
}
//cookig
if($cbackdata == "h2coabc")
{
	$tag = "Her Cooking";
	mainhmenu($quserID,$mID,$con,$tag);
}
//Arts
if($cbackdata == "h2artabc")
{
	$tag = "Her Arts";
	mainhmenu($quserID,$mID,$con,$tag);
}
//tech
if($cbackdata == "h2techxyz")
{
	$tag = "Her Techie";
	mainhmenu($quserID,$mID,$con,$tag);
}
//book
if($cbackdata == "h2bookxyz")
{
	$tag = "Her Books";
	mainhmenu($quserID,$mID,$con,$tag);
}


//h.3...............................
//sport
if($cbackdata == "h3spabc")
{
	$tag = "Kids Sports";
	mainhmenu($quserID,$mID,$con,$tag);
}
//Arts
if($cbackdata == "h3artabc")
{
	$tag = "Kids Arts";
	mainhmenu($quserID,$mID,$con,$tag);
}
//Games
if($cbackdata == "h3gamexyz")
{
	$tag = "Kids Games";
	mainhmenu($quserID,$mID,$con,$tag);
}
//book
if($cbackdata == "h3bookxyz")
{
	$tag = "Kids Books";
	mainhmenu($quserID,$mID,$con,$tag);
}



//menu h ................................................................................
//calback .......................................
//O.1.............................
//Birthday
if($cbackdata == "o1bdabc")
{
	$tag = "Him Birthday";
	mainhmenu($quserID,$mID,$con,$tag);
}
//Anniversary
if($cbackdata == "o1anabc")
{
	$tag = "Him Anniversary";
	mainhmenu($quserID,$mID,$con,$tag);
}
//New year
if($cbackdata == "o1nwabc")
{
	$tag = "Him New Year";
	mainhmenu($quserID,$mID,$con,$tag);
}
//Father’s day
if($cbackdata == "o1fdabc")
{
	$tag = "Father\'s day";
	mainhmenu($quserID,$mID,$con,$tag);
}
//Valentine’s day
if($cbackdata == "o1vdabc")
{
	$tag = "Him Valentine\'s Day";
	mainhmenu($quserID,$mID,$con,$tag);
}
//Friendship day
if($cbackdata == "o1frndabc")
{
	$tag = "Him Friendship day";
	mainhmenu($quserID,$mID,$con,$tag);
}



//O.2.............................
//Birthday
if($cbackdata == "o2bdabc")
{
	$tag = "Her Birthday";
	mainhmenu($quserID,$mID,$con,$tag);
}
//Anniversary
if($cbackdata == "o2anabc")
{
	$tag = "Her Anniversary";
	mainhmenu($quserID,$mID,$con,$tag);
}
//New year
if($cbackdata == "o2nwabc")
{
	$tag = "Her New Year";
	mainhmenu($quserID,$mID,$con,$tag);
}
//Mothers’s day
if($cbackdata == "o2fdabc")
{
	$tag = "Mother\'s day";
	mainhmenu($quserID,$mID,$con,$tag);
}
//Valentine’s day
if($cbackdata == "o2vdabc")
{
	$tag = "Her Valentine\'s Day";
	mainhmenu($quserID,$mID,$con,$tag);
}
//Friendship day
if($cbackdata == "o2frndabc")
{
	$tag = "Her Friendship day";
	mainhmenu($quserID,$mID,$con,$tag);
}


//O.3.............................
//Birthday
if($cbackdata == "o2bdabc")
{
	$tag = "Kids Birthday";
	mainhmenu($quserID,$mID,$con,$tag);
}
//Baby shower
if($cbackdata == "o3bshabc")
{
	$tag = "Baby Shower";
	mainhmenu($quserID,$mID,$con,$tag);
}
//New year
if($cbackdata == "o3nwabc")
{
	$tag = "Her New Year";
	mainhmenu($quserID,$mID,$con,$tag);
}

//Exam day
if($cbackdata == "o3exdabc")
{
	$tag = "Exam Day";
	mainhmenu($quserID,$mID,$con,$tag);
}



//calculator..............................................................................

if($cbackdata == "calxyz")
{
	$tag = "Enter youer Marage date following format \n\n 1999.08.26";
	rqdate($quserID,$mID,$tag);
}


//function
function rqdate($quserID,$mID,$tag){
	
	$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
	file_get_contents($url1);
	
	$url2 = $GLOBALS[link01].'/sendMessage?chat_id='.$quserID.'&text='.urlencode($tag);
	file_get_contents($url2);
}



function cal($msgID,$andate){
	
	//$time = strtotime($andate);
	//$newformat = date('Y',$time);
	
	$date = date('Y');
	$sum = $date-$andate;
	$anni = $sum." Anniversary";
	$inline = '&reply_markup={"inline_keyboard":[[{"text":"Back to Main Menu","callback_data":"gobackxyz"}]]}';
	$url2 = $GLOBALS[link01].'/sendMessage?chat_id='.$msgID.'&text='.urlencode($anni).$inline;
	file_get_contents($url2);
}



//Reminder..............................................................................

if($cbackdata == "reminderxyz")
{
	$tag = "Enter youer occasion name and occasion date following format \n\n Birthday-1999.08.26";
	rqdate($quserID,$mID,$tag);
}



function remind($msgID,$con,$rmarray){
	
	$date = date('Y-m-d');
	mysqli_select_db($con,"id12999274_ccnadump");
	$sql = "INSERT INTO `bot_remindertable` (`user_ID`, `occasion_date`, `occasion_title`, `entry_date`) VALUES ('$msgID', '$rmarray[1]', '$rmarray[0]', '$date')";
    $result = mysqli_query($con,$sql);
	  if ($result){
		  $text = "Reminder added ..";
	$inline = '&reply_markup={"inline_keyboard":[[{"text":"Back to Main Menu","callback_data":"gobackxyz"}]]}';
	$url21 = $GLOBALS[link01].'/sendMessage?chat_id='.$msgID.'&text='.urlencode($text).$inline;
	file_get_contents($url21);
	  }
	else{
		$text2 = "Reminder not addedn ..";
	$inline = '&reply_markup={"inline_keyboard":[[{"text":"Back to Main Menu","callback_data":"gobackxyz"}]]}';
	$url22 = $GLOBALS[link01].'/sendMessage?chat_id='.$msgID.'&text='.urlencode($text2).$inline;
	file_get_contents($url22);
	}
}



//Add Friend..............................................................................
if($cbackdata == "friendxyz")
{
	$text2 = "Send this referral code to your Friends: $quserID";
	sample2($quserID,$text2,$mID);
	
}

function sample2($msgID,$text,$mID)
{
	$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$msgID.'&message_id='.$mID;
	file_get_contents($url1);
	
    $inline = '&reply_markup={"inline_keyboard":[[{"text":"Back to Main Menu","callback_data":"gobackxyz"}]]}';
	$url22 = $GLOBALS[link01].'/sendMessage?chat_id='.$msgID.'&text='.urlencode($text).$inline;
	file_get_contents($url22);
	
}

//add referal code to db ..............................................
if($cbackdata == "adrfcxyz")
{
	reqrfc($quserID,$mID);
	
}


//req
function reqrfc($quserID,$mID){
	
	$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
	file_get_contents($url1);
	$text = "Enter your ref code this format: \n\n ref-1235468 \n\n copy paste and enter your ref code";
	$url2 = $GLOBALS[link01].'/sendMessage?chat_id='.$quserID.'&text='.urlencode($text);
	file_get_contents($url2);
	
}

function addfr($msgID,$con,$refc){
	if ($refc == $msgID){
		$text2 = "wrong ref";
		$inline = '&reply_markup={"inline_keyboard":[[{"text":"Add country","callback_data":"adcntryxyz"}]]}';
		$url23 = $GLOBALS[link01].'/sendMessage?chat_id='.$msgID.'&text='.urlencode($text2).$inline;
		file_get_contents($url23);
	}
	else{
		mysqli_select_db($con,"id12999274_ccnadump");
		$sql = "SELECT * FROM `bot_usertable` WHERE user_ID='$refc'";
        $result = mysqli_query($con,$sql);
		$numrows = mysqli_num_rows($result);
		if($numrows == 1){
				mysqli_select_db($con,"id12999274_ccnadump");
				$sql = "UPDATE `bot_usertable` SET ref_ID='$refc' WHERE user_ID='$msgID'";
				$result = mysqli_query($con,$sql);
				if ($result){
					  $text = "Updated";
				$inline = '&reply_markup={"inline_keyboard":[[{"text":"Back to Main Menu","callback_data":"gobackxyz"}]]}';
				$url21 = $GLOBALS[link01].'/sendMessage?chat_id='.$msgID.'&text='.urlencode($text).$inline;
				file_get_contents($url21);
				  }
				else{
					$text2 = "Retry";
				$inline = '&reply_markup={"inline_keyboard":[[{"text":"Back to Main Menu","callback_data":"gobackxyz"}]]}';
				$url22 = $GLOBALS[link01].'/sendMessage?chat_id='.$msgID.'&text='.urlencode($text2).$inline;
				file_get_contents($url22);
				}
		}else{
			$text2 = "wrong ref";
			$inline = '&reply_markup={"inline_keyboard":[[{"text":"Back to Main Menu","callback_data":"gobackxyz"}]]}';
			$url24 = $GLOBALS[link01].'/sendMessage?chat_id='.$msgID.'&text='.urlencode($text2).$inline;
			file_get_contents($url24);
		}
	}
	

}





//luck........................................................................................................
if($cbackdata == "tryluckxyz")
{
	randluck($quserID,$mID);
	
}

function randluck($quserID,$mID){
	
	$url1 = $GLOBALS[link01].'/deleteMessage?chat_id='.$quserID.'&message_id='.$mID;
	file_get_contents($url1);
	
	$items=array("Bags","Furniture","Mobile","Laptop","Gift Cards","Jewelry","Books","Clothing","Musical Instrument","Shoes"," Fitness Equipment","Watches","Sunglass");
	$random_keys=array_rand($items);
	
	$txt = "As of per Current Luck , you can purchase ".$items[$random_keys];
	
	$inline = '&reply_markup={"inline_keyboard":[[{"text":"Back to Main Menu","callback_data":"gobackxyz"}]]}';
	$url24 = $GLOBALS[link01].'/sendMessage?chat_id='.$quserID.'&text='.urlencode($txt).$inline;
	file_get_contents($url24);
	
}





?>
