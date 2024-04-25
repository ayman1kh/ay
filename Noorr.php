<?php
ob_start();
$token = "1993420105:AAGihu7m3E2TnJi-3o5w-1qdvo_60evQ65M";
define("API_KEY",$token);
function bot($method, $datas=[]){
$Saied_Botate = "https://api.telegram.org/bot".API_KEY."/".$method;
$saied_botate = null;
if(!empty($datas)){
$boundary = uniqid();
$saied_botate = buildMultipartData($datas,$boundary);
$Saied = ['http'=>[
'header'=>"Content-Type: multipart/form-data; boundary=$boundary\r\n",
'method'=>'POST',
'content'=>$saied_botate,
],];
}
if($saied_botate !== null){
$saied = stream_context_create($Saied);
$saied_result = file_get_contents($Saied_Botate, false, $saied);
}else{
$saied_result = file_get_contents($Saied_Botate);
}
if($saied_result === false){
return "Error: ".error_get_last()['message'];
}else{
return json_decode($saied_result);
}
}

function buildMultipartData($data,$boundary){
$SaiedData = '';
foreach($data as $key => $value){
if($value instanceof CURLFile){
$fileContents = file_get_contents($value->getFilename());
$fileName = basename($value->getFilename());
$fileMimeType = $value->getMimeType();
$SaiedData .= "--" . $boundary . "\r\n";
$SaiedData .= 'Content-Disposition: form-data; name="' . $key . '"; filename="' . $fileName . '"' . "\r\n";
$SaiedData .= 'Content-Type: ' . $fileMimeType . "\r\n\r\n";
$SaiedData .= $fileContents . "\r\n";
}else{
$SaiedData .= "--" . $boundary . "\r\n";
$SaiedData .= 'Content-Disposition: form-data; name="' . $key . '"' . "\r\n\r\n";
$SaiedData .= $value . "\r\n";
}
}
$SaiedData .= "--" . $boundary . "--\r\n";
return $SaiedData;
}

# Short
$update  = json_decode(file_get_contents('php://input'));
$message= $update->message;
$txt = $message->caption;
$text = $message->text;
$chat_id = $message->chat->id;
$from_id = $message->from->id;
$new = $message->new_chat_members;
$message_id = $message->message_id;
$type = $message->chat->type;
$name = $message->from->first_name;
$forwqe = $message->forward_from_chat;
$user = $message->from->username;

if(isset($update->callback_query)){
$chat_id = $update->callback_query->message->chat->id;
$from_id = $update->callback_query->from->id;
$user = $update->callback_query->from->username;
$name = $update->callback_query->from->first_name;
$message_id = $update->callback_query->message->message_id;
    $data = $update->callback_query->data;
$chat_id10 = $update->callback_query->id;
}

$id = $update->inline_query->from->id;
$admin = "460011702";
$admins = explode("\n",file_get_contents("data/admins.txt"));
$ch = "-1001707523024";
if(isset($update->inline_query)){
$from_id = $update->inline_query->from->id; 
$name = $update->inline_query->from->first_name;
$ala = $update->inline_query->query;
}
$numbergm = json_decode(file_get_contents("number/number.json"),true);
if($update->inline_query->query){
$ala = $update->inline_query->query;
$number = json_decode(file_get_contents("number/number.json"),true);

$keyboard["inline_keyboard"]=[];
$adms = $number["name"];
$results = [];
$i =0;
foreach ($adms as $item => $t) {
$i =$i;

    if (stripos($number["name"]["$item"], $update->inline_query->query) !== false and $i < 10) {
$numberonlian = $number["number"]["$item"];

$a = explode("-",$numberonlian);
$b = $a[0];
$c = $a[1];
$d = $a[2];
$e = $a[3];

$msharea= json_decode(file_get_contents("Gmieat/$b/$c/alagsam/$d/msharea.json"),true);
$midea= json_decode(file_get_contents("Gmieat/$b/$c/alagsam/$d/midea.json"),true);
$namegmieat = file_get_contents("Gmieat/$b/data/name.txt");
$nameonlian = $msharea["add"]["$e"]["name"];
$nameonlian2 = $msharea["add"]["$e"]["name2"];
$dolh= $msharea["add"]["$e"]["dolh"];
$almodh = $msharea["add"]["$e"]["almodh"];
$tnfeth= $msharea["add"]["$e"]["tnfeth"];
$datamshroa = $msharea["add"]["$e"]["data"];



$msar = strtoupper($numberonlian);


if($midea["yes"]["$e"]){
$yesno2 = "- تاريخ رفع التقريـر: *$almodh*.";
}
if(!$midea["yes"]["$e"]){
$yesno2 = "- تاريخ موعد التنفيذ: *$almodh*.";
}

$txt = "- رقم المشروع: `$msar`
- أسم المشروع: *$nameonlian*.
- أسـم المتبرع: *$nameonlian2*.
- دولـة المتبرع: *$dolh*.
- مكان التنفيذ: *$tnfeth*.
- الجهة المـانحة: *$namegmieat*
- تاريخ إعتماد المشروع: *$datamshroa*.
$yesno2
";


$midadd = $midea["add"]["$e"];

foreach($midadd as $id => $j){

$data1 = $midea["data"]["$e"]["$id"];
$data2 = $midea["data2"]["$e"]["$id"];
$file_id = $midea["add"]["$e"]["$id"];
 $v= $midea["send"]["$e"]["$id"];

if($v == "message"){
$results[] = [
    'type'=>"article",        
    'id'=>base64_encode(rand(5,555)),
    'title'=>$nameonlian,
'description' =>"تبرع $nameonlian2 من دولة $dolh بتاريخ $almodh",
'input_message_content'=>['parse_mode'=>'MarkDown','message_text'=>"- LINK : *$file_id*

$txt"],

];}
if($v == "video"){
$ss1 = "video_file_id";
}
if($v == "document"){
$ss1 = "document_file_id";
}
if($v == "photo"){
$ss1 = "photo_file_id";
}



if($v != "message"){

$results[] = [
    'type'=>"$v",        
    'id'=>base64_encode(rand(5,555)),
    'title'=>$nameonlian,
"$ss1" =>$file_id,
"thumb_url"=>$file_id, 
'description' =>"تبرع $nameonlian2 من دولة $dolh بتاريخ $almodh",
'caption'=>"$txt",
'parse_mode'=>"MarkDown",
];}

}
if(!$midea["add"]["$e"]){
$results[] = [
    'type'=>"article",        
    'id'=>base64_encode(rand(5,555)),
    'title'=>"$nameonlian ⚠️",
'description' =>"تبرع $nameonlian2 من دولة $dolh بتاريخ $almodh",
'input_message_content'=>['parse_mode'=>'MarkDown','message_text'=>"- *المشروع قيد التنفيذ ، لا يوجد تقارير إعلامية في الوقت الحالي.⚠️*

$txt"],
];

}
 $i =$i+1;  

}

}

$Urls = json_encode($results);
bot('answerInlineQuery',[
'inline_query_id'=>$update->inline_query->id, 
"cache_time"=>"11463",
'results' =>($Urls)
]);

}




$todaydate = date('Y/m/d',strtotime('1 hour'));
$now_date=date('h:iA',strtotime('1 hour'));
if(!$_GET['amrtimeon']) {
	$amrtimeon=" امر التوقيت لا يوجد";
} else {
	$amrtimeon=$_GET['amrtimeon'];
}

mkdir("data");
mkdir("Gmieat");
mkdir("adadt");
mkdir("number");
$number= json_decode(file_get_contents("adadt/number.json"),true);
$tgrer= json_decode(file_get_contents("adadt/tgrer.json"),true);
$numbergm= json_decode(file_get_contents("number/number.json"),true);
if(!$tgrer["gsm"]){
$tgrer["gsm"]["at"] = "✅";
$tgrer["gsm"]["bt"] = "✅";
$tgrer["gsm"]["ct"] = "✅";
$tgrer["gsm"]["dt"] = "✅";
$tgrer["gsm"]["et"] = "✅";
$tgrer["gsm"]["ft"] = "✅";
$tgrer["gsm"]["gt"] = "✅";
$tgrer["gsm"]["ht"] = "✅";
$tgrer["gsm"]["it"] = "✅";
$tgrer["gsm"]["jt"] = "✅";
$tgrer["gsm"]["lt"] = "✅";
file_put_contents("adadt/tgrer.json", json_encode($tgrer));}


$photo = file_get_contents("data/photo.txt");
$name1 = file_get_contents("data/name.txt");
$myaed = file_get_contents("data/myaed.txt");
$syanh = file_get_contents("data/syanh.txt");
$fromids = explode("\n",file_get_contents("data/fromids.txt"));

if($text == "فتح صيانة" & $from_id == $admin){
file_put_contents("data/syanh.txt","✅");
bot( sendMessage ,[
 chat_id =>$chat_id, 
 text =>"⚠️┊#المعذرة
تم فتح الصيانة",
 
]);}
if($text == "قفل صيانة" & $from_id == $admin){
file_put_contents("data/syanh.txt","❌");
bot( sendMessage ,[
 chat_id =>$chat_id, 
 text =>"⚠️┊#المعذرة
تم قفل الصيانة",
 
]);}
if($text and $chat_id != $admin & $syanh == "✅" or $data and $chat_id != $admin & $syanh == "✅" ){
bot( sendMessage ,[
 chat_id =>$chat_id, 
 text =>"⚠️┊#المعذرة
⚙┊يوجد صيانه في البوت",
 
]);

return false;}

$date=time();
if($amrtimeon=="ayman_run_on"){
$todaydate = date('Y/m/d',strtotime('1 hour'));
$now_date=date('h:iA',strtotime('1 hour'));

for($i=0;$i<1;$i++){
$years = scandir("Gmieat");

for($y=0;$y<count($years);$y++){
if( $years[$y] == "." or $years[$y] == ".." ){  
        continue;   
        }else{
 $yx = $years[$y];
    $files1 = scandir("Gmieat/$yx");

for($a=0;$a<count($files1);$a++){
if( $files1[$a] == "." or $files1[$a] == ".." ){  
        continue;   
        }else{
 $ex1 = $files1[$a];



$files2 = scandir("Gmieat/$yx/$ex1/alagsam");
for($b=0;$b<count($files2);$b++){
if( $files2[$b] == "." or $files2[$b] == ".." ){  
        continue;   
        }else{
 $ex2 = $files2[$b];

$msharea= json_decode(file_get_contents("Gmieat/$yx/$ex1/alagsam/$ex2/msharea.json"),true);
$midea= json_decode(file_get_contents("Gmieat/$yx/$ex1/alagsam/$ex2/midea.json"),true);
$time= json_decode(file_get_contents("Gmieat/$yx/$ex1/alagsam/$ex2/time.json"),true);
$msgid= json_decode(file_get_contents("data/msgid.json"),true);

$adms = $msharea["add"];
foreach($adms as $id => $t){
$name = $msharea["add"]["$id"]["name"];
$almodh = $msharea["add"]["$id"]["almodh"];
$name2= $msharea["add"]["$id"]["name2"];
$dolh= $msharea["add"]["$id"]["dolh"];
$tnfeth= $msharea["add"]["$id"]["tnfeth"];

if($almodh <= $todaydate and $time["add"]["$id"]["end"] == $now_date and $time["add"]["$id"]["ktm"] != "yes"){

if(!$midea["yes"]["$id"]){
for($v=0;$v<count($admins);$v++){
$admin = $admins[$v];
if($msgid["$id"]["$admin"]){
bot('deleteMessage', [
'chat_id' =>$admin,
'message_id'=>$msgid["$id"]["$admin"],
]);}
$get=bot('SendMessage', [
'chat_id' =>$admins[$v],
'text'=>"- تـنبـيهۂ التقـرير الٲعلامي غير متوفر ⚠️.

- ٲنتهـت فتـرة تنفيذ مشــروع *$name* بتمويل *$name2* بتـاريخ *$almodh* المنفـذ في منطقـة *$tnfeth*.
",
'disable_web_page_preview'=>'true',
'parse_mode'=>"markdown",
 'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• كتــم 🔇.",'callback_data'=>"كتم $yx $ex1 $ex2 $id"],['text'=>"• الغاء الكتــم 🔇.",'callback_data'=>"كتم1 $yx $ex1 $ex2 $id"]],
[['text'=>"• إضافة التقرير 🎬.",'callback_data'=>"فيديو $yx $ex1 $ex2 $id"]],
]
])
]);

$msg_id = $get->result->message_id;
$msgid["$id"]["$admin"] = $msg_id;
}
file_put_contents("data/msgid.json", json_encode($msgid));

}

}}
}}
}}
}}}}
if($text=="no"){

$no = 1000;
for($i=0;$i<1;$i++){
$years = scandir("Gmieat");

for($y=0;$y<count($years);$y++){
if( $years[$y] == "." or $years[$y] == ".." ){  
        continue;   
        }else{
 $yx = $years[$y];

    $files1 = scandir("Gmieat/$yx");

for($a=0;$a<count($files1);$a++){
if( $files1[$a] == "." or $files1[$a] == ".." ){  
        continue;   
        }else{
 $ex1 = $files1[$a];



$files2 = scandir("Gmieat/$yx/$ex1/alagsam");
for($b=0;$b<count($files2);$b++){
if( $files2[$b] == "." or $files2[$b] == ".." ){  
        continue;   
        }else{
 $ex2 = $files2[$b];

$msharea= json_decode(file_get_contents("Gmieat/$yx/$ex1/alagsam/$ex2/msharea.json"),true);
$midea= json_decode(file_get_contents("Gmieat/$yx/$ex1/alagsam/$ex2/midea.json"),true);
$time= json_decode(file_get_contents("Gmieat/$yx/$ex1/alagsam/$ex2/time.json"),true);
$numbergm= json_decode(file_get_contents("number/number.json"),true);
$adms = $msharea["add"];
$no = $no;
foreach($adms as $id => $t){
$name = $msharea["add"]["$id"]["name"];
$no = $no + 1;
$numbergm["number"]["$no"] = "$yx-$ex1-$ex2-$id";
$numbergm["name"]["$no"] = "$name";
$msharea["add"]["$id"]["number"]= $no;

}
file_put_contents("number/number.json", json_encode($numbergm));
file_put_contents("Gmieat/$yx/$ex1/alagsam/$ex2/msharea.json", json_encode($msharea));
file_put_contents("number/number.txt","$no");
}}
}}
}}

}

bot("sendMessage",[
"chat_id"=>$chat_id,
"text"=>"

▫️⁞ لقد أصبحت مشرف في هذا البوت ،
 
",

'disable_web_page_preview'=>'true',
'parse_mode'=>"markdown",
]);
}
$sudowathg = 460011702;
if($text == 'الملف' and $chat_id == $sudowathg){
 bot('sendDocument',[
 'chat_id'=>$chat_id,
 'document'=>new CURLFile(__FILE__)
]);
}
function SAIEDZip($SAIEDZip1, $SAIEDZip2){
$SAIEDZip4 = realpath($SAIEDZip1);
$SAIEDZip = new ZipArchive();
$SAIEDZip->open($SAIEDZip2, ZipArchive::CREATE | ZipArchive::OVERWRITE);
$SAIEDZip3 = new RecursiveIteratorIterator(
new RecursiveDirectoryIterator($SAIEDZip4),
RecursiveIteratorIterator::LEAVES_ONLY);
foreach($SAIEDZip3 as $SAIEDZip5 => $SAIEDZip6){
if(!$SAIEDZip6->isDir()){
$SAIEDZip7 = $SAIEDZip6->getRealPath();
$SAIEDZip8 = substr($SAIEDZip7, strlen($SAIEDZip4) + 1);
$SAIEDZip->addFile($SAIEDZip7, $SAIEDZip8);
}}
$SAIEDZip->close();
}
# كود حجم الملف لـ @MrDGSY #
function SAIEDZip1($SAIEDZip9, $SAIEDZip10 = 2){
$SAIEDZip11=array(' B', ' KB', ' MB', ' GB', ' TB', ' PB', ' EB', ' ZB', ' YB');
$SAIEDZip12=floor((strlen($SAIEDZip9) - 1) / 3);
return sprintf("%.{$SAIEDZip10}f", $SAIEDZip9 / pow(1024, $SAIEDZip12)) . @$SAIEDZip11[$SAIEDZip12];
}

if($text == "نسخة إحتياطية" and $from_id==460011702){
$SAIEDZip14 = "ay20kh.ml/NOSKH"; //دومين استضافتك
$RSAIED = "460011702"; //ايديك
date_default_timezone_set("Asia/Damascus");
$SAIEDZip13 = date("h-i-s");
$todaydate = date("Y-m-d");
SAIEDZip('../', "Backup-$SAIEDZip13-$todaydate.zip");
bot('senddocument',[
'chat_id'=>$RSAIED,
'document'=>"https://$SAIEDZip14/Backup-$SAIEDZip13-$todaydate.zip",
'caption'=>"Backup. 📦 TV1
Today's date : ".date('Y/m/d')." 📆
The Time is : ".date('h:i A')." ⏰
File size : ".SAIEDZip1(filesize("Backup-$SAIEDZip13-$todaydate.zip"))." 🏷",
'reply_to_message_id'=>$message_id,
]);
unlink("Backup-$SAIEDZip13-$todaydate.zip");
}
if ($text == "7374aykh" and !$data){
    if(!in_array($chat_id, $admins)){
file_put_contents("data/admins.txt","$chat_id \n",FILE_APPEND);
  $ay = count($admins);
bot("sendMessage",[
"chat_id"=>$chat_id,
"text"=>" - مرحبا [$name](tg://user?id=$from_id) 

▫️⁞ لقد أصبحت مشرف في هذا البوت ،
 أضغط على •⊱ /start ⊰• للبداية.
",

'disable_web_page_preview'=>'true',
'parse_mode'=>"markdown",
]);
bot("sendMessage",[
"chat_id"=>$admin,
"text"=>"All admins - $ay
New Member -  [$from_id](tg://user?id=$from_id) 
Name Member - [$name](tg://user?id=$from_id) 
",

'disable_web_page_preview'=>'true',
'parse_mode'=>"markdown",
]);}}




# البداية قائمة الجهات
if(in_array($from_id, $admins)){
if ($text == "/start" | $data == "حفظ1" ){
    if(!in_array($chat_id, $fromids)){
file_put_contents("data/fromids.txt","$chat_id \n",FILE_APPEND);
  $ay = count($fromids);
bot("sendMessage",[
"chat_id"=>$admin,
"text"=>"All Member - $ay
New Member -  [$from_id](tg://user?id=$from_id) 
Name Member - [$name](tg://user?id=$from_id) 
",

'disable_web_page_preview'=>'true',
'parse_mode'=>"markdown",
]);}

file_put_contents("data/amr.txt","");
$files = scandir("Gmieat");
$i=0;
for($i=0;$i<count($files);$i++){
if( $files[$i] == "." or $files[$i] == ".." ){  
        continue;   
        }else{
 $id = $files[$i];



if($id){
   $namegm = file_get_contents("Gmieat/$id/data/name.txt");
$res["inline_keyboard"][] = [["text" =>"$namegm","callback_data" =>"العام ".$id]];
}
}}

if(in_array($from_id, $admins)){
$res['inline_keyboard'][] = [['text'=>"• إضافة جمعية.",'callback_data'=>"جديد"]];}

if($text){$s = "sendmessage";}
if($data){$s = "editMessagetext";}

bot("$s",[
'chat_id'=>$chat_id,
"text"=>"- مرحباً بك عزيزي  $name


- إليك الجمعيات المانحة عدد $i ، أضغط على أسم الجمعية المراد عرض مشاريعها :
",
'parse_mode'=>"MarkDown",
'message_id'=>$message_id,
'disable_web_page_preview'=>true,
  'reply_markup' => json_encode($res)

]);


}
if(preg_match("/^(العام) (.*)/s",$data) ){


file_put_contents("data/amr.txt","");
$exw = explode(" ", $data);
$be0= $exw[0];
$be1= $exw[1];
$be2= $exw[2];
$be3= $exw[3];
$be4= $exw[4];
    
$files = scandir("Gmieat/$be1");
$i=0;
for($i=0;$i<count($files);$i++){
if( $files[$i] == "." or $files[$i] == ".." ){  
        continue;   
        }else{
 $id = $files[$i];



if($id != "data"){
   
$res["inline_keyboard"][] = [["text" =>"$id","callback_data" =>"الجمعية $be1 $id"]];
}
}}


if(!in_array($from_id, $admins)){
$res['inline_keyboard'][] = [['text'=>"• عودة.",'callback_data'=>"حفظ1"]];}

if(in_array($from_id, $admins)){
$res['inline_keyboard'][] = [['text'=>"• إنشاء عام جديد.",'callback_data'=>"جديد $be1"],['text'=>"• عودة.",'callback_data'=>"حفظ1"]];}
  $namegm = file_get_contents("Gmieat/$be1/data/name.txt");
bot("editMessagetext",[
'chat_id'=>$chat_id,
"text"=>"$namegm
أضغط على أحد الأعوام التالية :
",
'parse_mode'=>"MarkDown",
'message_id'=>$message_id,
'disable_web_page_preview'=>true,
  'reply_markup' => json_encode($res)

]);

}


if(in_array($from_id, $admins)){


# اضافة جمعيات مانحة
if($data =="جديد"){


file_put_contents("data/amr.txt","إضافة جمعية");
bot('editMessagetext',[
'chat_id'=>$chat_id,
'text'=>"
- أرسل أسم الجمعية الذي تريد إضافتها.
",
'message_id'=>$message_id,

  'reply_markup'=>json_encode([
'inline_keyboard'=>[

[['text'=>"• عــــودة 🔙.",'callback_data'=>"حفظ1"]],
]
])
  ]);
}
$amr = file_get_contents("data/amr.txt");

if($text and $amr == "إضافة جمعية" and $from_id == $admin){
$addgm = file_get_contents("data/addgm.txt");
$a2 = $addgm +1;
if($a2 < 10){
$a1 = "a$a2";
}
if($a2 > 9){
$a1 = "z$a2";
}

mkdir("Gmieat/$a1");
mkdir("Gmieat/$a1/data");
$now= date('Y',strtotime('1 hour'));
mkdir("Gmieat/$a1/$now");
mkdir("Gmieat/$a1/$now/alagsam");
mkdir("Gmieat/$a1/$now/data");


file_put_contents("Gmieat/$a1/data/name.txt","$text");
file_put_contents("data/addgm.txt","$a2");
file_put_contents("data/amr.txt","");
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"
-  تم حفظ الأسم الجديد :$text.
",
  'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• عــــودة 🔙.",'callback_data'=>"حفظ1"]],
]
])
  ]);
}
# اضافة عام جديدة
if(preg_match("/^(جديد) (.*)/s",$data) ){

$exw = explode(" ", $data);
$be0= $exw[0];
$be1= $exw[1];


bot('editMessagetext',[
'chat_id'=>$chat_id,
'text'=>"
- هل تريد إنشاء عام جديد؟.
",
'message_id'=>$message_id,
'disable_web_page_preview'=>'true',
'parse_mode'=>"markdown",
  'reply_markup'=>json_encode([
'inline_keyboard'=>[

[['text'=>"• نـعم.",'callback_data'=>"إنشاءعام $be1"],['text'=>"• تــراجع 🔙.",'callback_data'=>"العام $be1"]],
]
])
  ]);
}
if(preg_match("/^(إنشاءعام) (.*)/s",$data) ){
$exw = explode(" ", $data);
$be0= $exw[0];
$be1= $exw[1];
$files = scandir("Gmieat/$be1");
$i=0;
for($i=0;$i<count($files);$i++){
if( $files[$i] == "." or $files[$i] == ".." ){  
        continue;   
        }else{
 $id = $files[$i];



if($id != "data"){
   $now = $id;
}
}}
$now = $now + 1;
mkdir("Gmieat/$be1/$now");
mkdir("Gmieat/$be1/$now/alagsam");
mkdir("Gmieat/$be1/$now/data");

bot('editMessagetext',[
'chat_id'=>$chat_id,
'text'=>"
-  تم إنشاء عام جديد بنجاح :$now.
",
'message_id'=>$message_id,
'disable_web_page_preview'=>'true',
'parse_mode'=>"markdown",
  'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• عــــودة 🔙.",'callback_data'=>"العام $be1"]],
]
])
  ]);
}
}

#اقسام الجمعية
if(preg_match("/^(تقريرتجميعي|معلومات|التقريرالاعلامي|التقريرالاعلامي1|عرض|ارسالللقناة|نعمارسالللقناة|تكرار|الجمعية|القسم|تعديلالمعلومات|تقريرتجميعي1|عرضقرير|عرضالتقرير) (.*)/s",$data) or $text and $number["gsm"]["$text"] or $text and $number["mshro"]["$text"] or $text and $number["midea"]["$text"]){
if($data){$sendm = "editMessagetext";}
if($text){
if($number["gsm"]["$text"]){
$gsm = $number["gsm"]["$text"];
$data = "القسم $gsm";}
if($number["mshro"]["$text"]){
$mshro = $number["mshro"]["$text"];
$data = "معلومات $mshro";}
if($number["midea"]["$text"]){
$md =  $number["midea"]["$text"];
$data = "التقريرالاعلامي1 $md";}
$sendm ="sendMessage";}
file_put_contents("data/amr.txt","");
$exw = explode(" ", $data);
$be0= $exw[0];
$be1= $exw[1];
$be2= $exw[2];
$be3= $exw[3];
$be4= $exw[4];
$be5= $exw[5];
$no1 = str_replace(["z","a"] , "", $be2);
$no2 = str_replace(["z","a"] , "", $be3);
if($no1 < 10){
$no1= "0$no1";}
if($no2 < 10){
$no2= "0$no2";}
if($be4 < 10){
$noa= "0$be4";}
if($be4 > 9){
$be4= "$be4";
$noa= "$be4";
}
if($be5< 10){
$noa2= "0$be5";}
if($be5> 9){
$be5= "$be5";
$noa2= "$be5";
}
$msharea= json_decode(file_get_contents("Gmieat/$be1/$be2/alagsam/$be3/msharea.json"),true);
$midea= json_decode(file_get_contents("Gmieat/$be1/$be2/alagsam/$be3/midea.json"),true);
$time= json_decode(file_get_contents("Gmieat/$be1/$be2/alagsam/$be3/time.json"),true);
$namegmieat = file_get_contents("Gmieat/$be1/data/name.txt");
$numdergm = json_decode(file_get_contents("number/number.json"),true);
$name = $msharea["add"]["$be4"]["name"];
$name2= $msharea["add"]["$be4"]["name2"];
$dolh= $msharea["add"]["$be4"]["dolh"];
$tnfeth= $msharea["add"]["$be4"]["tnfeth"];
$data = $msharea["add"]["$be4"]["data"];
$almodh = $msharea["add"]["$be4"]["almodh"];
$no = $msharea["add"]["$be4"]["number"];
$ti = $time["add"]["$be4"]["end"];
$data1 = $midea["data"]["$be4"]["$be5"];
$data2 = $midea["data2"]["$be4"]["$be5"];
$file_id = $midea["add"]["$be4"]["$be5"];
 $v= $midea["send"]["$be4"]["$be5"];

$msar = $numbergm["number"]["$no"];
$msar = strtoupper($msar);
if($midea["data2"]["$be4"]["$be5"]){$c = " لقد قمت بإرسال هذا الوسائط للقناة بتاريخ $data2 ✅";}
if(!$midea["data2"]["$be4"]["$be5"]){$c = " لم تقم بإرسال هذا الوسائط للقناة ⚠.";}

if($midea["yes"]["$be4"]){
$yesno2 = "- تاريخ رفع التقريـر: *$almodh*.";
}
if(!$midea["yes"]["$be4"]){
$yesno2 = "- تاريخ موعد التنفيذ: *$almodh*.";
}


if($be0 == "الجمعية"){


$files = scandir("Gmieat/$be1/$be2/alagsam");
$ix1 = 0;
for($i=0;$i<count($files);$i++){
if( $files[$i] == "." or $files[$i] == ".." ){  
        continue;   
        }else{
 $id = $files[$i];
$namegm = file_get_contents("Gmieat/$be1/$be2/alagsam/$id/name.txt");
$msharea= json_decode(file_get_contents("Gmieat/$be1/$be2/alagsam/$id/msharea.json"),true);
$midea= json_decode(file_get_contents("Gmieat/$be1/$be2/alagsam/$id/midea.json"),true);
$no1 = str_replace(["z","a"] , "", $id);
if($no1 < 10){
$no1= "0$no1";}
$ix1 = $ix1 + $gs;
if(!$gs){$gs=0;}
$i3=0;
$i2=0;
$i1=0;
$gs=0;
$g3="";
$g2="";
$g1="";
$adms = $msharea["add"];
foreach($adms as $id1 => $t){

$almodh = $msharea["add"]["$id1"]["almodh"];
if($time["add"]["$id1"]["ktm"] == "yes"){$k = "🔇";$k1=$k1+1;$k2=$k1;}
if($midea["yes"]["$id1"] == "✅"){
$i3 = $i3+1;
if($i3< 10){
$i3= "0$i3";}
$g1 = "⁞$i3 ✅";
}
if(!$midea["yes"]["$id1"] and $almodh <= $todaydate){
$i1 = $i1+1;
if($i1< 10){
$i1= "0$i1";}
$g2 = "⁞$i1 ⚠";
}
if(!$midea["yes"]["$id1"] and $almodh > $todaydate){
$i2 = $i2+1;
if($i2< 10){
$i2= "0$i2";}
$g3 = "⁞$i2 ♻";
}
$gs = $i1 + $i2 + $i3;
}
if($namegm){
$ix = $i-1;
$res["inline_keyboard"][] = [["text" =>"$no1 ⁞ $namegm $g1 $g2 $g3 | $gs","callback_data" =>"القسم $be1 $be2 $id"]];
}

}}
if($ix == 0){

$ix = "لا يــوجـــد";
$ix1 = "لا يــوجـــد";
unlink("Gmieat/$be1/$be2/data/addgs.txt");
}
if(in_array($from_id, $admins)){

$res['inline_keyboard'][] = [['text'=>"• تعديل اسم قسم 🖊.",'callback_data'=>"tadelgsm $be1 $be2"]];
$res['inline_keyboard'][] = [['text'=>"• إضـافة أقسـام 📁.",'callback_data'=>"جديد1 $be1 $be2"],['text'=>"• عــــودة 🔙.",'callback_data'=>"العام $be1"]];}
if(!in_array($from_id, $admins)){
$res['inline_keyboard'][] = [['text'=>"• عــــودة 🔙.",'callback_data'=>"حفظ"]];}


bot('editMessagetext',[
'chat_id'=>$chat_id,
'text'=>"▫️⁞ •⊱ $namegmieat ~ $be2 ⊰•.

▫️⁞ عــدد الأقســام •⊱ $ix ⊰•.
▫️⁞ إجمالـي المشـاريع •⊱ $ix1 ⊰•.
",
'parse_mode'=>"MarkDown",
'message_id'=>$message_id,
'disable_web_page_preview'=>true,
  'reply_markup' => json_encode($res)

]);
}



if($be0 == "القسم"){

$g1 = "لايوجد"; $g2 ="لايوجد"; $g3 = "لايوجد"; $k2 = "لايوجد";
$adms = $msharea["add"];
$add = 0;
foreach($adms as $id => $t){
$add = $add+1;
$name = $msharea["add"]["$id"]["name"];
$almodh = $msharea["add"]["$id"]["almodh"];
$k="";
if($time["add"]["$id"]["ktm"] == "yes"){$k = "🔇";$k1=$k1+1;$k2=$k1;}
if($midea["yes"]["$id"] == "✅"){
$i = $i+1;
$res["inline_keyboard"][] = [["text" =>" $add | $name | ✅ $k","callback_data" =>"معلومات $be1 $be2 $be3 $id"]];
$g1 = $i;
}
if(!$midea["yes"]["$id"] and $almodh <= $todaydate){

$i1 = $i1+1;
$res["inline_keyboard"][] = [["text" =>" $add | $name | ⚠ $k","callback_data" =>"معلومات $be1 $be2 $be3 $id"]];
$g2 = $i1;
}
if(!$midea["yes"]["$id"] and $almodh > $todaydate){
$i2 = $i2+1;
$res["inline_keyboard"][] = [["text" =>" $add | $name | ♻ $k","callback_data" =>"معلومات $be1 $be2 $be3 $id"]];
$g3 = $i2;
}
}
$g4 = $g1 + $g2 + $g3;
$g5 = "$g1=$g2=$g3";

$res['inline_keyboard'][] = [['text'=>"• إضـافة مشـروع.",'callback_data'=>"مشروعجديد $be1 $be2 $be3"],['text'=>"• عــــودة 🔙.",'callback_data'=>"الجمعية $be1 $be2 $be3"]];
$res['inline_keyboard'][] = [['text'=>"• تقرير تجميعي.",'callback_data'=>"عرضقرير $be1 $be2 $be3 $g5"]];
$namegm = file_get_contents("Gmieat/$be1/$be2/alagsam/$be3/name.txt");
if($msharea["add"]){

$g = " 
▫️⁞ اســم القســم •⊱ *$namegm* ⊰•

▫️⁞ مشاريع متوفرة التقارير ✅ •⊱ *$g1* ⊰•
▫️⁞ غيـر متوفــر التــقريـــر ⚠  •⊱ *$g2* ⊰•
▫️⁞ مشاريع قيــد الـــتنــفيــذ  ♻ •⊱ *$g3* ⊰•
▫️⁞ المشـاريع المكتـــومة 🔇 •⊱ *$k2* ⊰•

▫️⁞ إجمالي المشاريع في هذا القسم •⊱ *$g4* ⊰•
";

}
if(!$msharea["add"]){
$g = " 
▫️⁞ اســم القســم •⊱ *$namegm* ⊰• 

▫️⁞ لا يـــوجد مشاريع في هذا القسم.

";

unlink("Gmieat/$be1/$be2/alagsam/$be3/add.txt");
}
file_put_contents("data/now.txt","مشروع $be1 $be2 $be3 $be4");
bot("$sendm",[
'chat_id'=>$chat_id,
'text'=>"
$g

",
'parse_mode'=>"MarkDown",
'message_id'=>$message_id,
'disable_web_page_preview'=>true,
  'reply_markup' => json_encode($res)

]);
}

$a = $tgrer["gsm"]["at"];
$b = $tgrer["gsm"]["bt"];
$c = $tgrer["gsm"]["ct"];
$d = $tgrer["gsm"]["dt"];
$e = $tgrer["gsm"]["et"];
$f = $tgrer["gsm"]["ft"];
$g = $tgrer["gsm"]["gt"];
$h = $tgrer["gsm"]["ht"];
$i = $tgrer["gsm"]["it"];
$j = $tgrer["gsm"]["jt"];
$l = $tgrer["gsm"]["lt"];
if($be0 == "عرضقرير"){
$tgrer["gsm"]["ht"] = "✅";
$tgrer["gsm"]["it"] = "✅";
$tgrer["gsm"]["jt"] = "✅";
$tgrer["gsm"]["lt"] = "✅";
file_put_contents("adadt/tgrer.json", json_encode($tgrer));
$h = $tgrer["gsm"]["ht"];
$i = $tgrer["gsm"]["it"];
$j = $tgrer["gsm"]["jt"];
$l = $tgrer["gsm"]["lt"];
bot("editmessagetext",[
'chat_id'=>$chat_id,
'text'=>" - إليـك إعدادات التقرير :

- رقــم القســم : `$no1$no2`",
'parse_mode'=>"MarkDown",
"message_id"=>$message_id,
'disable_web_page_preview'=>true,
  'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• رقـم المشـروع | $a.",'callback_data'=>"at $be1 $be2 $be3"]],
[['text'=>"• أسـم المشـروع | $b.",'callback_data'=>"bt $be1 $be2 $be3"]],
[['text'=>"• اسـم المتبـــرع | $c.",'callback_data'=>"ct $be1 $be2 $be3"]],
[['text'=>"• دولة المتبـــرع | $d.",'callback_data'=>"dt $be1 $be2 $be3"]],
[['text'=>"• تاريخ الاعتماد | $e.",'callback_data'=>"et $be1 $be2 $be3"]],
[['text'=>"• مكــان التنفيـــذ | $f.",'callback_data'=>"ft $be1 $be2 $be3"]],
[['text'=>"• تاريـخ التنفيـــذ | $g.",'callback_data'=>"gt $be1 $be2 $be3"]],
[['text'=>"• ✅ | $h.",'callback_data'=>"ht $be1 $be2 $be3 $be4"],['text'=>"• ⚠ | $i.",'callback_data'=>"it $be1 $be2 $be3 $be4"],['text'=>"• ♻  | $j.",'callback_data'=>"jt $be1 $be2 $be3 $be4"],['text'=>"• الكل | $l.",'callback_data'=>"lt $be1 $be2 $be3"]],

[['text'=>"• عــــــــــــرض 📑.",'callback_data'=>"تقريرتجميعي $be1 $be2 $be3"]],
[['text'=>"• عــــــــــــــودة 🔙.",'callback_data'=>"القسم $be1 $be2 $be3"]],
]])
]);}

if($be0 == "تقريرتجميعي" or $be0 == "تقريرتجميعي1"){
if($be0 == "تقريرتجميعي1"){$r2 = $be4; $j2 = $be4+100; }
if($be0 == "تقريرتجميعي"){$r2 = 0; $j2 = 100; }
$get=bot("editmessagetext",[
'chat_id'=>$chat_id,
'text'=>"ثواني من فضلك ♻.",
"message_id"=>$message_id,

]);
$m = $get->result->message_id;
$i2 = 0;
$adms = $msharea["add"];
foreach($adms as $a2 => $t){
$name = $msharea["add"]["$a2"]["name"];
$name2= $msharea["add"]["$a2"]["name2"];
$dolh= $msharea["add"]["$a2"]["dolh"];
$tnfeth= $msharea["add"]["$a2"]["tnfeth"];
$data = $msharea["add"]["$a2"]["data"];
$ti = $time["add"]["$a2"]["end"];
$almodh = $msharea["add"]["$a2"]["almodh"];

if($midea["yes"]["$be4"]){
$yesno2 = "• تاريخ رفع التقـرير : *$almodh*";
}
if(!$midea["yes"]["$be4"]){
$yesno2 = "• تاريخ موعد التنفيذ : *$almodh*";
}

$dno = str_replace(["20","/"] , "", $data);
if($a2 < 10){
$noa= "0$a2";}
if($a2 > 9){
$a2= "$a2";
$noa= "$a2";
}



if($h == "✅" and $midea["yes"]["$a2"] 
or $i == "✅" and $almodh <= $todaydate and !$midea["yes"]["$a2"] 
or $j == "✅" and $almodh >= $todaydate and !$midea["yes"]["$a2"] 
or $h == "✅" and $i == "✅" and $almodh <= $todaydate
or $h == "✅" and $j == "✅" and $almodh >= $todaydate
or $i == "✅" and $j == "✅" and !$midea["yes"]["$a2"] 
or $i == "✅" and $j == "✅" and $h == "✅"
){
$i2 = $i2+1;
if($i2 > $r2 and $i2 <= $j2){
if (mb_strlen($tgrertext,"utf-8")<4000)
  {  

$tgrertext ="$tgrertext 
";
if($a == "✅"){
$tgrertext ="$tgrertext 
- رقــم المشـروع : `$msar`";
}

if($b == "✅"){
$tgrertext ="$tgrertext 
- أسـم المشــروع : $name";
}
if($c == "✅"){
$tgrertext ="$tgrertext 
- أسـم المتبــرع : $name2";
}
if($d == "✅"){
$tgrertext ="$tgrertext 
- دولة المتبــرع : $dolh";
}
if($e == "✅"){
$tgrertext ="$tgrertext 
- تاريخ الأعتمـاد : $data";
}
if($f == "✅"){
$tgrertext ="$tgrertext 
- مكــان التنفـيــذ : $tnfeth";
}
if($g == "✅"){
$tgrertext ="$tgrertext 
$yesno2";
}
$g2 = $i2;
}
}
}
}

if($i2 > $g2 ){

$res['inline_keyboard'][] = [['text'=>"• عــــودة 🔙.",'callback_data'=>"القسم $be1 $be2 $be3"],['text'=>"عرض المزيد...",'callback_data'=>"تقريرتجميعي1 $be1 $be2 $be3 $g2"]];}
if($i2 <= $g2){

$res['inline_keyboard'][] = [['text'=>"• عــــودة 🔙.",'callback_data'=>"القسم $be1 $be2 $be3"]];}

bot('editMessagetext',[
'chat_id'=>$chat_id,
'text'=>"
$tgrertext 
",
'parse_mode'=>"MarkDown",
'message_id'=>$m,
'disable_web_page_preview'=>true,
  'reply_markup' => json_encode($res)

]);
}

if($be0 == "معلومات"){
if($time["add"]["$be4"]["ktm"] == "yes"){$k = "• الغاء الكتــم 🔇.";$k1="كتم1";}
if($time["add"]["$be4"]["ktm"] != "yes"){$k = "• كتــم 🔇.";$k1="كتم";}

$res['inline_keyboard'][] = [['text'=>"• عرض التقرير الإعلامي 📽.",'callback_data'=>"عرضالتقرير $be1 $be2 $be3 $be4"],['text'=>"• إعدادات التقرير الإعلامي 📽.",'callback_data'=>"التقريرالاعلامي $be1 $be2 $be3 $be4"]];
$res['inline_keyboard'][] = [['text'=>"• حذف المشروع 🗑.",'callback_data'=>"حذفالمشروع $be1 $be2 $be3 $be4"],['text'=>"• تعديل المعلومات ✏.",'callback_data'=>"تعديلالمعلومات $be1 $be2 $be3 $be4"]];

$res['inline_keyboard'][] = [['text'=>"$k",'callback_data'=>"$k1 $be1 $be2 $be3 $be4"],['text'=>"• عــــودة 🔙.",'callback_data'=>"القسم $be1 $be2 $be3"]];

bot("$sendm",[
'chat_id'=>$chat_id,
'text'=>" - إليــك بيانات المشـروع :

- رقم المشروع: `$msar`
- أسم المشروع: *$name*.
- أسـم المتبرع: *$name2*.
- دولـة المتبرع: *$dolh*.
- مكان التنفيذ: *$tnfeth*.
- الجهة المـانحة: *$namegmieat*
- تاريخ إعتماد المشروع: *$data*.
$yesno2

",
'message_id'=>$message_id,
'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>true,
  'reply_markup' => json_encode($res)

]);
}

if($be0 == "مععلومات"){
$res['inline_keyboard'][] = [['text'=>"أسم المشروع •⊱ $name ⊰•.",'callback_data'=>"$be1 $be2 $be3 $be4"]];
$res['inline_keyboard'][] = [['text'=>"أسم المتبرع •⊱ $name2 ⊰•.",'callback_data'=>"$be1 $be2 $be3 $be4"]];
$res['inline_keyboard'][] = [['text'=>"دولة المتبرع •⊱ $dolh ⊰•.",'callback_data'=>"$be1 $be2 $be3 $be4"]];
$res['inline_keyboard'][] = [['text'=>"مكان التنفيذ •⊱ $tnfeth ⊰•.",'callback_data'=>"$be1 $be2 $be3 $be4"]];
$res['inline_keyboard'][] = [['text'=>"تاريخ إعتماد المشروع •⊱ $data ⊰•",'callback_data'=>"$be1 $be2 $be3 $be4"]];
$res['inline_keyboard'][] = [['text'=>"$yesno2",'callback_data'=>"$be1 $be2 $be3 $be4"]];
$res['inline_keyboard'][] = [['text'=>"• التقرير الإعلامي 📽.",'callback_data'=>"التقريرالاعلامي $be1 $be2 $be3 $be4"]];
$res['inline_keyboard'][] = [['text'=>"• حذف المشروع 🗑.",'callback_data'=>"حذفالمشروع $be1 $be2 $be3 $be4"],['text'=>"• تعديل المعلومات ✏.",'callback_data'=>"تعديلالمعلومات $be1 $be2 $be3 $be4"]];

$res['inline_keyboard'][] = [['text'=>"$k",'callback_data'=>"$k1 $be1 $be2 $be3 $be4"],['text'=>"• عــــودة 🔙.",'callback_data'=>"القسم $be1 $be2 $be3"]];

bot("$sendm",[
'chat_id'=>$chat_id,
'text'=>" - إليــك بيانات المشـروع :

- رقــم المشـروع : `$msar`

",
'message_id'=>$message_id,
'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>true,
  'reply_markup' => json_encode($res)

]);
}

if($be0 == "التقريرالاعلامي1" or $be0 == "التقريرالاعلامي"){

$i = 0;
$no = "no";
$adms = $midea["add"]["$be4"];
foreach($adms as $id => $t){
$yes = $midea["yes"]["$be4"]["$id"];
$nemav = $midea["nemav"]["$be4"]["$id"];
if($midea["msg"]["$be4"]["$id"]){
$v = $midea["send"]["$be4"]["$id"];

if($v == "video" |$v == "document"){
$res["inline_keyboard"][] = [["text" =>" $id | فيـديـو $nemav 📽 | ✅.","callback_data" =>"عرض $be1 $be2 $be3 $be4 $id"]];}
if($v == "photo"){
$res["inline_keyboard"][] = [["text" =>" $id | صـورة $nemav 🖼| ✅.","callback_data" =>"عرض $be1 $be2 $be3 $be4 $id"]];}
if($v == "message"){
$res["inline_keyboard"][] = [["text" =>" $id | رابـــط $nemav 🌐| ✅.","callback_data" =>"عرض $be1 $be2 $be3 $be4 $id"]];}
}
if(!$midea["msg"]["$be4"]["$id"]){
$v = $midea["send"]["$be4"]["$id"];
if($v == "video" |$v == "document"){
$res["inline_keyboard"][] = [["text" =>" $id | فيـديـو $nemav 📽 | ⚠.","callback_data" =>"عرض $be1 $be2 $be3 $be4 $id"]];}
if($v == "photo"){
$res["inline_keyboard"][] = [["text" =>" $id | صـورة $nemav 🖼 | ⚠.","callback_data" =>"عرض $be1 $be2 $be3 $be4 $id"]];}
if($v == "message"){
$res["inline_keyboard"][] = [["text" =>" $id | رابـــط $nemav | ⚠.","callback_data" =>"عرض $be1 $be2 $be3 $be4 $id"]];}
}
$i = $i+1;
}
if($i == 0){
$res["inline_keyboard"][] = [["text"=>"لا يـــوجـــد","callback_data"=>"null"]];}

$res["inline_keyboard"][] = [["text" =>"• عــــودة 🔙.","callback_data" =>"معلومات $be1 $be2 $be3 $be4"]];
if(in_array($from_id, $admins)){
$res['inline_keyboard'][] = [['text'=>"• حذف جميع التقارير 🗑.",'callback_data'=>"حذففيديو $be1 $be2 $be3 $be4"],['text'=>"• إضافة تقرير 🎬.",'callback_data'=>"فيديو $be1 $be2 $be3 $be4"]];
}


if($be0 == "التقريرالاعلامي"){$s = "editMessagetext";}
if($be0 == "التقريرالاعلامي1"){$s = "sendMessage";
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
]);
}
bot("$s",[
'chat_id'=>$chat_id,
'text'=>" - التقرير الإعلامي •⊱ $name ⊰• :

- رقــم المشـروع : `$msar` 

",
'message_id'=>$message_id,
'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>true,
  'reply_markup' => json_encode($res)

]);

}
if($be0 == "عرضالتقرير" and $be4 and in_array($from_id, $admins)){
$i = 0;
$no = "no";
$adms = $midea["add"]["$be4"];
foreach($adms as $id => $t){

$data1 = $midea["data"]["$be4"]["$id"];
$data2 = $midea["data2"]["$be4"]["$id"];
$file_id = $midea["add"]["$be4"]["$id"];
 $v= $midea["send"]["$be4"]["$id"];

if($midea["data2"]["$be4"]["$id"]){$c = " لقد قمت بإرسال هذا الوسائط للقناة بتاريخ $data2 ✅";}
if(!$midea["data2"]["$be4"]["$id"]){$c = " لم تقم بإرسال هذا الوسائط للقناة ⚠.";}

if($v != "message" ){

bot("send$v",[
'chat_id'=>$chat_id, 
"$v"=>"$file_id",
'caption'=>"$c

- رقم المشروع: `$msar`
- أسم المشروع: *$name*.
- أسـم المتبرع: *$name2*.
- دولـة المتبرع: *$dolh*.
- مكان التنفيذ: *$tnfeth*.
- الجهة المـانحة: *$namegmieat*
- تاريخ إعتماد المشروع: *$data*.
- تاريخ تنفيذ المشروع: *$almodh*.

- الرابـــط :
 *http://t.me/AL_NOORBOT?start=$msar*
",
'message_id'=>$message_id,
'parse_mode'=>markdown,
   'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• إرسال للقناة .",'callback_data'=>"ارسالللقناة $be1 $be2 $be3 $be4 $id"]],
[['text'=>"• عــــودة 🔙.",'callback_data'=>"معلومات $be1 $be2 $be3 $be4"]],
[['text'=>"• حذف التقرير 🗑.",'callback_data'=>"حذففيديو1 $be1 $be2 $be3 $be4 $id"],['text'=>"• تبديل التقرير ♻.",'callback_data'=>"تبديلفيديو $be1 $be2 $be3 $be4 $id"]],
]
])
  ]);

}

if($v == "message" ){

bot('sendMessage',[
'chat_id'=>$chat_id, 
'text'=>"$c

- LINK : *$file_id*

- رقم المشروع: `$msar`
- أسم المشروع: *$name*.
- أسـم المتبرع: *$name2*.
- دولـة المتبرع: *$dolh*.
- مكان التنفيذ: *$tnfeth*.
- الجهة المـانحة: *$namegmieat*
- تاريخ إعتماد المشروع: *$data*.
- تاريخ تنفيذ المشروع: *$almodh*.

- الرابـــط :
 *http://t.me/AL_NOORBOT?start=$msar*
",
'message_id'=>$message_id,
'parse_mode'=>markdown,
'disable_web_page_preview'=>error,
 'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• إرسال للقناة .",'callback_data'=>"ارسالللقناة $be1 $be2 $be3 $be4 $id"]],
[['text'=>"• عــــودة 🔙.",'callback_data'=>"معلومات $be1 $be2 $be3 $be4"]],
[['text'=>"• حذف التقرير 🗑.",'callback_data'=>"حذففيديو1 $be1 $be2 $be3 $be4 $id"],['text'=>"• تبديل التقرير ♻.",'callback_data'=>"تبديلفيديو $be1 $be2 $be3 $be4 $id"]],
]
])

  ]);
}
}
}

if($be0 == "عرض" and $v != "message" and $be5 and in_array($from_id, $admins)){

bot("send$v",[
'chat_id'=>$chat_id, 
"$v"=>"$file_id",
'caption'=>"$c

- رقم المشروع: `$msar`
- أسم المشروع: *$name*.
- أسـم المتبرع: *$name2*.
- دولـة المتبرع: *$dolh*.
- مكان التنفيذ: *$tnfeth*.
- الجهة المـانحة: *$namegmieat*
- تاريخ إعتماد المشروع: *$data*.
- تاريخ تنفيذ المشروع: *$almodh*.

- الرابـــط :
 *http://t.me/AL_NOORBOT?start=$msar*
",
'message_id'=>$message_id,
'parse_mode'=>markdown,
   'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• إرسال للقناة .",'callback_data'=>"ارسالللقناة $be1 $be2 $be3 $be4 $be5"]],
[['text'=>"• عــــودة 🔙.",'callback_data'=>"معلومات $be1 $be2 $be3 $be4"]],
[['text'=>"• حذف التقرير 🗑.",'callback_data'=>"حذففيديو1 $be1 $be2 $be3 $be4 $be5"],['text'=>"• تبديل التقرير ♻.",'callback_data'=>"تبديلفيديو $be1 $be2 $be3 $be4 $be5"]],
]
])
  ]);
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
]);
}

if($be0 == "عرض"  and $v == "message" and $be5 and in_array($from_id, $admins)){

bot('editMessagetext',[
'chat_id'=>$chat_id, 
'text'=>"$c

- LINK : *$file_id*

- رقم المشروع: `$msar`
- أسم المشروع: *$name*.
- أسـم المتبرع: *$name2*.
- دولـة المتبرع: *$dolh*.
- مكان التنفيذ: *$tnfeth*.
- الجهة المـانحة: *$namegmieat*
- تاريخ إعتماد المشروع: *$data*.
- تاريخ تنفيذ المشروع: *$almodh*.

- الرابـــط :
 *http://t.me/AL_NOORBOT?start=$msar*
",
'message_id'=>$message_id,
'parse_mode'=>markdown,
'disable_web_page_preview'=>error,
 'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• إرسال للقناة .",'callback_data'=>"ارسالللقناة $be1 $be2 $be3 $be4 $be5"]],
[['text'=>"• عــــودة 🔙.",'callback_data'=>"معلومات $be1 $be2 $be3 $be4"]],
[['text'=>"• حذف التقرير 🗑.",'callback_data'=>"حذففيديو1 $be1 $be2 $be3 $be4 $be5"],['text'=>"• تبديل التقرير ♻.",'callback_data'=>"تبديلفيديو $be1 $be2 $be3 $be4 $be5"]],
]
])

  ]);
}




if($be0 == "ارسالللقناة" and $v == "message" ){
bot('editMessagetext',[
'chat_id'=>$chat_id, 
'text'=>"- LINK : *$file_id*

- رقم المشروع: `$msar`
- أسم المشروع: *$name*.
- أسـم المتبرع: *$name2*.
- دولـة المتبرع: *$dolh*.
- مكان التنفيذ: *$tnfeth*.
- الجهة المـانحة: *$namegmieat*
- تاريخ إعتماد المشروع: *$data*.
- تاريخ تنفيذ المشروع: *$almodh*.

هذا الشكل الذي سيكون بالقناة هل تريد نشرة ؟ أضغط نعم لتأكيد!
",
'parse_mode'=>markdown,
'message_id'=>$message_id,
'disable_web_page_preview'=>true,
  'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text' => "• نعــم.", 'callback_data' => "نعمارسالللقناة $be1 $be2 $be3 $be4 $be5"],['text'=>"• عــــودة 🔙.",'callback_data'=>"التقريرالاعلامي $be1 $be2 $be3 $be4"]],
]
])
  ]);
}
if($be0 == "ارسالللقناة" and $v != "message" ){
bot('editmessagemedia',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'media'=>json_encode([
'type'=>"$v",
'media'=>$file_id,
'caption'=>"- رقم المشروع: `$msar`
- أسم المشروع: *$name*.
- أسـم المتبرع: *$name2*.
- دولـة المتبرع: *$dolh*.
- مكان التنفيذ: *$tnfeth*.
- الجهة المـانحة: *$namegmieat*
- تاريخ إعتماد المشروع: *$data*.
- تاريخ تنفيذ المشروع: *$almodh*.


هذا الشكل الذي سيكون بالقناة هل تريد نشرة ؟ أضغط نعم لتأكيد!
",
]),
'parse_mode'=>markdown,
'reply_markup' => json_encode([
'inline_keyboard' => [
[['text' => "• نعــم.", 'callback_data' => "نعمارسالللقناة $be1 $be2 $be3 $be4 $be5"],['text'=>"• عــــودة 🔙.",'callback_data'=>"التقريرالاعلامي1 $be1 $be2 $be3 $be4"]],
]
])
]);
}
if($be0 == "نعمارسالللقناة" or $be0 == "تكرار"){
$msgid = $midea["msg"]["$be4"]["$be5"];
if($v == "message" or $be0  == "تكرار"){$s="editMessagetext";}
if($v != "message" and $be0 != "تكرار"){$s="sendMessage";
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
]);
}
if(!$midea["msg"]["$be4"]["$be5"] or $midea["msg"]["$be4"]["$be5"] and $be0 == "تكرار"){

if($v == "message" ){
$get=bot('sendMessage',[
'chat_id'=>$ch, 
'text'=>"- LINK : *$file_id*

- رقم المشروع: `$msar`
- أسم المشروع: *$name*.
- أسـم المتبرع: *$name2*.
- دولـة المتبرع: *$dolh*.
- مكان التنفيذ: *$tnfeth*.
- الجهة المـانحة: *$namegmieat*
- تاريخ إعتماد المشروع: *$data*.
- تاريخ تنفيذ المشروع: *$almodh*.

",
'message_id'=>$message_id,
'parse_mode'=>markdown,
'disable_web_page_preview'=>error,
  ]);
}
if($v != "message" ){
$get=bot("send$v",[
'chat_id'=>$ch, 
"$v"=>"$file_id",
'caption'=>"

- رقم المشروع: `$msar`
- أسم المشروع: *$name*.
- أسـم المتبرع: *$name2*.
- دولـة المتبرع: *$dolh*.
- مكان التنفيذ: *$tnfeth*.
- الجهة المـانحة: *$namegmieat*
- تاريخ إعتماد المشروع: *$data*.
- تاريخ تنفيذ المشروع: *$almodh*.


",
'message_id'=>$message_id,
'parse_mode'=>markdown,
'disable_web_page_preview'=>true,
 
  ]);
}

$msg= $get->result->message_id;
$data2 = $midea["data2"]["$be4"]["$be5"] = $todaydate;
$midea["msg"]["$be4"]["$be5"] = $msg;
file_put_contents("Gmieat/$be1/$be2/alagsam/$be3/msharea.json", json_encode($msharea));
file_put_contents("Gmieat/$be1/$be2/alagsam/$be3/midea.json", json_encode($midea));
bot("$s",[
'chat_id'=>$chat_id, 
'text'=>"▫️⁞ تم الإرســال للقناة بنجاح ✅.",
'message_id'=>$message_id,

  'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• عــــودة.",'callback_data'=>"معلومات $be1 $be2 $be3 $be4"]],

]
])
    ]);

return false;
}elseif($midea["msg"]["$be4"]["$be5"]){

bot("$s",[
'chat_id'=>$chat_id, 
'text'=>"- تنبية ⚠.

لقد قمت بإرسال هذا التوثيق للقناة بتاريخ *$data2*.

- إذا كنت تريد إرساله مرة أخرى أضغط على زر ( تكرار )

",
'message_id'=>$message_id,
'parse_mode'=>"markdown",
  'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• تكــرار.",'callback_data'=>"تكرار $be1 $be2 $be3 $be4 $be5"],['text'=>"• عــــودة.",'callback_data'=>"التقريرالاعلامي $be1 $be2 $be3 $be4"]],

]
])

  ]);}

}
if($be0 == "تعديلالمعلومات"){

if($midea["msg"]["$be4"]){
$yesno1 = $msharea["add"]["$be4"]["data1"];
}
$almodh = $msharea["add"]["$be4"]["almodh"];
$res['inline_keyboard'][] = [['text'=>"أسم المشروع •⊱ $name ⊰•.",'callback_data'=>"name $be1 $be2 $be3 $be4"]];
$res['inline_keyboard'][] = [['text'=>"أسم المتبرع •⊱ $name2 ⊰•.",'callback_data'=>"name2 $be1 $be2 $be3 $be4"]];
$res['inline_keyboard'][] = [['text'=>"دولة المتبرع •⊱ $dolh ⊰•.",'callback_data'=>"dolh $be1 $be2 $be3 $be4"]];
$res['inline_keyboard'][] = [['text'=>"مكان التنفيذ •⊱ $tnfeth ⊰•.",'callback_data'=>"tnfeth $be1 $be2 $be3 $be4"]];
$res['inline_keyboard'][] = [['text'=>"تاريخ إعتماد المشروع •⊱ $data ⊰•",'callback_data'=>"data $be1 $be2 $be3 $be4"]];
$res['inline_keyboard'][] = [['text'=>"$yesno2",'callback_data'=>"almodh $be1 $be2 $be3 $be4"]];
$res['inline_keyboard'][] = [['text'=>"+ عام",'callback_data'=>"year 1"],['text'=>"+ شهر",'callback_data'=>"Month 1"],['text'=>"+ يوم",'callback_data'=>"day 1"]];
$res['inline_keyboard'][] = [['text'=>"- عام",'callback_data'=>"year 2"],['text'=>"- شهر",'callback_data'=>"Month 2"],['text'=>"- يوم",'callback_data'=>"day 2"]];

$res['inline_keyboard'][] = [['text'=>"• عــــودة 🔙.",'callback_data'=>"معلومات $be1 $be2 $be3 $be4"]];
bot("$sendm",[
'chat_id'=>$chat_id,
'text'=>"
اليك لوحــة تعديـل بيانات المشـروع :

- رقــم المشـروع : `$msar` 

-----------------------
",
'message_id'=>$message_id,
'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>true,
  'reply_markup' => json_encode($res)

]);
}
}


#ضبط التثرير
function MrDGt($chat_id,$message_id,$mang)
     {
$exw = explode(" ", $mang);
$be1= $exw[0];
$be2= $exw[1];
$no1 = str_replace(["z","a"] , "", $be1);
$no2 = str_replace(["z","a"] , "", $be2);
if($no1 < 10){
$no1= "0$no1";}
if($no2 < 10){
$no2= "0$no2";}
$tgrer= json_decode(file_get_contents("adadt/tgrer.json"),true);
$a = $tgrer["gsm"]["at"];
$b = $tgrer["gsm"]["bt"];
$c = $tgrer["gsm"]["ct"];
$d = $tgrer["gsm"]["dt"];
$e = $tgrer["gsm"]["et"];
$f = $tgrer["gsm"]["ft"];
$g = $tgrer["gsm"]["gt"];
$h = $tgrer["gsm"]["ht"];
$i = $tgrer["gsm"]["it"];
$j = $tgrer["gsm"]["jt"];
$l = $tgrer["gsm"]["lt"];
bot("editmessagetext",[
'chat_id'=>$chat_id,
'text'=>" - إليـك إعدادات التقرير :

- رقــم القســم : `$no1$no2`",
'parse_mode'=>"MarkDown",
"message_id"=>$message_id,
'disable_web_page_preview'=>true,
  'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• رقـم المشـروع | $a.",'callback_data'=>"at $mang"]],
[['text'=>"• أسـم المشـروع | $b.",'callback_data'=>"bt $mang"]],
[['text'=>"• اسـم المتبـــرع | $c.",'callback_data'=>"ct $mang"]],
[['text'=>"• دولة المتبـــرع | $d.",'callback_data'=>"dt $mang"]],
[['text'=>"• تاريخ الاعتماد | $e.",'callback_data'=>"et $mang"]],
[['text'=>"• مكــان التنفيـــذ | $f.",'callback_data'=>"ft $mang"]],
[['text'=>"• تاريـخ التنفيـــذ | $g.",'callback_data'=>"gt $mang"]],
[['text'=>"• ✅ | $h.",'callback_data'=>"ht $mang"],['text'=>"• ⚠ | $i.",'callback_data'=>"it $mang"],['text'=>"• ♻  | $j.",'callback_data'=>"jt $mang"],['text'=>"• الكل | $l.",'callback_data'=>"lt $be1 $be2"]],

[['text'=>"• عــــــــــــرض 📑.",'callback_data'=>"تقريرتجميعي $mang"]],
[['text'=>"• عــــــــــــــودة 🔙.",'callback_data'=>"القسم $mang"]],
]])
]);}
if(preg_match("/^(at|bt|ct|dt|et|ft|gt|ht|it|jt|lt) (.*)/s",$data)){
$exw = explode(" ", $data);
$be1= $exw[1];
$be2= $exw[2];
$be3= $exw[3];
$a2= $exw[0];
$hij = explode("=", $be3);

$dfa1 = $tgrer["gsm"]["$a2"];
if($dfa1 == "❌"){
if($hij[0] == "لايوجد" and $a2 == "ht" or $hij[1] == "لايوجد" and $a2 == "it"  or $hij[2] == "لايوجد" and $a2 == "jt"){
if($a2 == "ht"){$ext ="▫️⁞ عذراً، لا يوجـد مشاريع تم تنفيذها ⚠";}
if($a2 == "it"){$ext ="▫️⁞ عذراً، لا يوجـد مشاريع أنتهت مدة تنفيذها ⚠";}
if($a2 == "jt"){$ext ="▫️⁞ عذراً، لا يوجـد مشاريع جارية التنفيذ ⚠";}
bot('answercallbackquery',[
            'callback_query_id'=>$chat_id10,
            'text'=>"$ext",
            'show_alert'=>true,
    ]);
$mang ="$be1 $be2 $be3";
MrDGt( $chat_id,$message_id,$mang);
return false;
}
$tgrer["gsm"]["$a2"] = "✅";
}
if($dfa1 == "✅"){
$tgrer["gsm"]["$a2"] = "❌";
}
file_put_contents("adadt/tgrer.json", json_encode($tgrer));
$mang ="$be1 $be2 $be3";
MrDGt( $chat_id,$message_id,$mang);

}


# تعديل القسم


function MrDGb($chat_id,$message_id,$mang)
     {

$exw = explode(" ", $mang);
$aex = $exw[0];
$ex1= $exw[1];
$ex2= $exw[2];
$ex3= $exw[3];
$ex4= $exw[4];
$ex5= $exw[5];
$files = scandir("Gmieat/$ex1/$ex2/alagsam");
$ix1 = 0;
for($i=0;$i<count($files);$i++){
if( $files[$i] == "." or $files[$i] == ".." ){  
        continue;   
        }else{
 $id = $files[$i];
$namegm = file_get_contents("Gmieat/$ex1/$ex2/alagsam/$id/name.txt");
$gs = file_get_contents("Gmieat/$ex1/$ex2/alagsam/$id/add.txt");
$ix1 = $ix1 + $gs;
if(!$gs){$gs=0;}
if($namegm){
$res["inline_keyboard"][] = [["text" =>"$namegm | $gs","callback_data" =>"القسمتعديل $ex1 $ex2 $ex3 $id"]];
$ix = $i-1;
}

}}

if(!in_array($from_id, $admins)){
$res['inline_keyboard'][] = [['text'=>"• عــــودة 🔙.",'callback_data'=>"الجمعية $ex1 $ex2"]];}

$namegm = file_get_contents("Gmieat/$ex1/$ex2/data/name.txt");

bot('editMessagetext',[
'chat_id'=>$chat_id,
'text'=>"-  《 $namegm 》.

- أضغط على أسم القسم لتعديل... 
",
'parse_mode'=>"MarkDown",
'message_id'=>$message_id,
'disable_web_page_preview'=>true,
  'reply_markup' => json_encode($res)

]);
}
if(preg_match("/^(tadelgsm) (.*)/s",$data)){
$exw = explode(" ", $data);
$be1= $exw[1];
$x= $exw[0];
$be2= $exw[2];
$mang ="$x $be1 $be2";

bot('answercallbackquery',[
            'callback_query_id'=>$chat_id10,
            'text'=>"▫️⁞ حسناً عزيزي ، يمكنك الضغط على اي قسم لتعديل...",
            'show_alert'=>true,
    ]);

MrDGb( $chat_id,$message_id,$mang);

}
if(preg_match("/^(القسمتعديل) (.*)/s",$data)){
$exw = explode(" ", $data);

$x = "$exw[0]";
$be1 = "$exw[1]";
$be2 = "$exw[2]";
$be3 = "$exw[3]";
$namegm = file_get_contents("Gmieat/$be1/$be2/alagsam/$be3/name.txt");
file_put_contents("data/amr.txt","$x $be1 $be2 $be3");
bot('answercallbackquery',[
            'callback_query_id'=>$chat_id10,
            'text'=>"▫️⁞ حسناً عزيزي ، أرسل الاسم الجديد بدلا عن $namegm ...",
            'show_alert'=>true,
    ]);
$mang ="$x $be1 $be2 $be3";
MrDGb( $chat_id,$message_id,$mang);

}



#تعديل بينات المشروع
function MrDGa($chat_id,$message_id)
     {
$amr = file_get_contents("data/amr.txt");
$exw = explode(" ", $amr);
$aex = $exw[0];
$be1= $exw[1];
$be2= $exw[2];
$be3= $exw[3];
$be4= $exw[4];

if($be4 == "data"){$ae1 ="✅";}
if($be4 == "data1"){$ae2 ="✅";}
if($be4 == "almodh"){$ae3 ="✅";}
$midea= json_decode(file_get_contents("Gmieat/$be1/$be2/alagsam/$be3/midea.json"),true);
$msharea= json_decode(file_get_contents("Gmieat/$be1/$be2/alagsam/$be3/msharea.json"),true);
$name = $msharea["add"]["$be4"]["name"];
$name2= $msharea["add"]["$be4"]["name2"];
$dolh= $msharea["add"]["$be4"]["dolh"];
$tnfeth= $msharea["add"]["$be4"]["tnfeth"];
$data = $msharea["add"]["$be4"]["data"];
$almodh = $msharea["add"]["$be4"]["almodh"];
if($midea["yes"]["$be4"]){
$yesno2 = "تاريخ رفــع التقـريــر •⊱ $almodh ⊰•";
}
if(!$midea["yes"]["$be4"]){
$yesno2 = "تاريخ موعـــد التنفيـــذ •⊱ $almodh ⊰•";
}
$res['inline_keyboard'][] = [['text'=>"أسم المشروع •⊱ $name ⊰•.",'callback_data'=>"name $be1 $be2 $be3 $be4"]];
$res['inline_keyboard'][] = [['text'=>"أسم المتبرع •⊱ $name2 ⊰•.",'callback_data'=>"name2 $be1 $be2 $be3 $be4"]];
$res['inline_keyboard'][] = [['text'=>"دولة المتبرع •⊱ $dolh ⊰•.",'callback_data'=>"dolh $be1 $be2 $be3 $be4"]];
$res['inline_keyboard'][] = [['text'=>"مكان التنفيذ •⊱ $tnfeth ⊰•.",'callback_data'=>"tnfeth $be1 $be2 $be3 $be4"]];
$res['inline_keyboard'][] = [['text'=>"تاريخ إعتماد المشروع •⊱ $data ⊰• $ae1",'callback_data'=>"data $be1 $be2 $be3 $be4"]];
$res['inline_keyboard'][] = [['text'=>"$yesno2",'callback_data'=>"almodh $be1 $be2 $be3 $be4"]];
$res['inline_keyboard'][] = [['text'=>"+ عام",'callback_data'=>"year 1"],['text'=>"+ شهر",'callback_data'=>"Month 1"],['text'=>"+ يوم",'callback_data'=>"day 1"]];
$res['inline_keyboard'][] = [['text'=>"- عام",'callback_data'=>"year 2"],['text'=>"- شهر",'callback_data'=>"Month 2"],['text'=>"- يوم",'callback_data'=>"day 2"]];

$res['inline_keyboard'][] = [['text'=>"• عــــودة 🔙.",'callback_data'=>"معلومات $be1 $be2 $be3 $be4"]];
bot('editmessagetext',[
'chat_id'=>$chat_id,
'text'=>"
اليك لوحــة تعديـل بيانات المشـروع :

- رقــم المشـروع : `$dno$no1$no2$noa` 

-----------------------",
'message_id'=>$message_id,
'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>true,
  'reply_markup' => json_encode($res)
]);
}
if(preg_match("/^(name|name2|dolh|tnfeth|data|data1|almodh) (.*)/s",$data)){
$exw = explode(" ", $data);
$be1= $exw[1];
$be2= $exw[2];
$be3= $exw[3];
$be4= $exw[4];
$be5= $exw[0];
$msharea= json_decode(file_get_contents("Gmieat/$be1/$be2/alagsam/$be3/msharea.json"),true);
$na = $msharea["add"]["$be4"]["$be5"];
if($be5 == "name"){
$a ="قم بإرسال أسم المشروع الجديد...
أسم المشروع السابق : `$na`";
$x = "معلوماتت";
}
if($be5 == "name2"){
$a ="قم بإرسال أسم المتبرع الجديد
أسم المتبرع السابق : `$na`
";
$x="معلوماتت";}
if($be5 == "dolh"){
$a ="قم بإرسال دولة المتبرع
دولة المتبرع سابقًا : `$na`
";
$x="معلوماتت";}
if($be5 == "tnfeth"){
$a ="قم بإرسال مكان التنفيذ
مكان التنفيذ سابقاً : `$na`
";
$x="معلوماتت";}

if($be5 == "data"){$a ="يمكنك التحكم بالتاريخ بألازار الموجوة اسفل القائمة";$x="معلوماتتا";}
if($be5 == "data1"){$a ="يمكنك التحكم بالتاريخ بألازار الموجوة اسفل القائمة";$x="معلوماتتا";}
if($be5 == "almodh"){$a ="يمكنك التحكم بالتاريخ بألازار الموجوة اسفل القائمة";$x="معلوماتتا";}

bot('answercallbackquery',[
            'callback_query_id'=>$chat_id10,
            'text'=>"▫️⁞ حسناً عزيزي ، $a .",
            'show_alert'=>true,
    ]);
file_put_contents("data/amr.txt","$x $be1 $be2 $be3 $be4 $be5");
MrDGa( $chat_id,$message_id,$mang);
}

$amr = file_get_contents("data/amr.txt");
$exw = explode(" ", $amr);
$aex = $exw[0];
$ex1= $exw[1];
$ex2= $exw[2];
$ex3= $exw[3];
$ex4= $exw[4];
$ex5= $exw[5];
if($text and !$data and $aex == "معلوماتت" and $from_id == $admin){
$msharea= json_decode(file_get_contents("Gmieat/$ex1/$ex2/alagsam/$ex3/msharea.json"),true);

$msharea["add"]["$ex4"]["$ex5"] = $text;
file_put_contents("Gmieat/$ex1/$ex2/alagsam/$ex3/msharea.json", json_encode($msharea));
if($ex4 == "name"){$a ="أسم المشروع";
$numbergm = json_decode(file_get_contents("number/number.json"),true);

$no = $msharea["add"]["$ex4"]["number"];
$numbergm["name"]["$no"] = "$text";
file_put_contents("number/number.json", json_encode($numbergm));
}
if($ex4 == "name2"){$a ="أسم المتبرع";}
if($ex5 == "dolh"){$a ="دولة المتبرع";}
if($ex4  == "tnfeth"){$a ="مكان التنفيذ";}
file_put_contents("data/amr.txt","ا $ex1 $ex2 $ex3 $ex4 $ex5");
MrDGa( $chat_id,$message_id,$mang);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"- تم التعديل $a بنجـاح ✅.
",
'reply_to_message_id'=>$message_id,
]);
}

if(preg_match("/^(year|Month|day) (.*)/s",$data) and $aex == "معلوماتتا"){
$exw1 = explode(" ", $data);
$aex1 = $exw1[0];
$be11= $exw1[1];

$msharea= json_decode(file_get_contents("Gmieat/$ex1/$ex2/alagsam/$ex3/msharea.json"),true);
$data1 = $msharea["add"]["$ex4"]["$ex5"];
if($be11 == "1"){
$alomdh1 = date('Y/m/d',strtotime("$data1 1 $aex1"));
}
if($be11 == "2"){
$alomdh1 = date('Y/m/d',strtotime("$data1 -1 $aex1"));
}
$msharea["add"]["$ex4"]["$ex5"] = $alomdh1;
file_put_contents("Gmieat/$ex1/$ex2/alagsam/$ex3/msharea.json", json_encode($msharea));
MrDGa( $chat_id,$message_id,$mang);

}

if(preg_match("/^(حذفالمشروع|حذففيديو|حذففيديو1) (.*)/s",$data)){

$exw = explode(" ", $data);
$a= $exw[0];
$be1= $exw[1];
$be2= $exw[2];
$be3= $exw[3];
$be4= $exw[4];
$be5= $exw[5];
$midea= json_decode(file_get_contents("Gmieat/$ex1/$ex2/alagsam/$be3/midea.json"),true);
$v= $midea["send"]["$be4"]["$be5"];
if($a == "حذفالمشروع"){$a1="حذفمشروع";

}
if($a == "حذففيديو"){$a1="حذفالفيد";

}
if($a == "حذففيديو1"){$a1="حذففيديوواحد";

}
if($v == "message" ){$s="editMessagetext";}
if($v != "message" ){$s="sendMessage";
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
]);
}
bot("$s",[
'chat_id'=>$chat_id,
'text'=>"
- أضغط خيار نعم لتأكيد.

",
'message_id'=>$message_id,
'disable_web_page_preview'=>'true',
'parse_mode'=>"markdown",
  'reply_markup'=>json_encode([
'inline_keyboard'=>[

[["text"=>"• نعــم.",'callback_data'=>"$a1 $be1 $be2 $be3 $be4 $be5"],["text"=>"• عــــودة 🔙.",'callback_data'=>"التقريرالاعلامي $be1 $be2 $be3 $be4"]],
]
])
  ]);
}

if(preg_match("/^(حذفمشروع|حذفالفيد|حذففيديوواحد) (.*)/s",$data)){

$exw = explode(" ", $data);
$be1= $exw[1];
$be2= $exw[2];
$be3= $exw[3];
$be4= $exw[4];
$be5= $exw[1];
$a = $exw[0];


$msharea= json_decode(file_get_contents("Gmieat/$be1/$be2/alagsam/$be3/msharea.json"),true);
$midea= json_decode(file_get_contents("Gmieat/$be1/$be2/alagsam/$be3/midea.json"),true);
$time= json_decode(file_get_contents("Gmieat/$be1/$be2/alagsam/$be3/time.json"),true);
$numbergm = json_decode(file_get_contents("number/number.json"),true);
$no = $msharea["add"]["$be4"]["number"];
if($a == "حذفمشروع"){
$c = "المشـــروع";
unset($msharea["add"]["$be4"]);
unset($time["add"]["$be4"]);
unset($numbergm["number"]["$no"]);
unset($numbergm["name"]["$no"]);
$xs="القسم $be1 $be2 $be3 $be4";
}
if($a == "حذفمشروع" or $a == "حذفالفيد"){
$adms = $midea["add"]["$be4"];
foreach($adms as $id => $t){
$msg = $midea["msg"]["$be4"]["$id"];
bot("deleteMessage",[
"chat_id"=>$ch,
"message_id"=>$msg,
]);
}

unset($midea["add"]["$be4"]);
unset($midea["send"]["$be4"]);
unset($midea["num"]["$be4"]);
unset($midea["data"]["$be4"]);
unset($midea["yes"]["$be4"]);
unset($midea["data2"]["$be4"]);
unset($midea["msg"]["$be4"]);

if(!$c){$c = "جميع مقاطع الفيديو";
$xs="التقريرالاعلامي $be1 $be2 $be3 $be4";
}
}
if($a == "حذففيديوواحد"){

$be5= $exw[5];
$msg = $midea["msg"]["$be4"]["$be5"];
bot("deleteMessage",[
"chat_id"=>$ch,
"message_id"=>$msg,
]);
unset($midea["add"]["$be4"]["$be5"]);
unset($midea["data"]["$be4"]["$be5"]);
unset($midea["send"]["$be4"]["$be5"]);
unset($midea["data2"]["$be4"]["$be5"]);
unset($midea["msg"]["$be4"]["$be5"]);
$xs="التقريرالاعلامي $be1 $be2 $be3 $be4";
if(!$c){$c = "مقطع الفيديو";}

}
file_put_contents("Gmieat/$be1/$be2/alagsam/$be3/msharea.json", json_encode($msharea));
file_put_contents("Gmieat/$be1/$be2/alagsam/$be3/midea.json", json_encode($midea));
file_put_contents("Gmieat/$be1/$be2/alagsam/$be3/time.json", json_encode($time));
file_put_contents("number/number.json", json_encode($numbergm));
$msharea= json_decode(file_get_contents("Gmieat/$be1/$be2/alagsam/$be3/msharea.json"),true);
$midea= json_decode(file_get_contents("Gmieat/$be1/$be2/alagsam/$be3/midea.json"),true);
$time= json_decode(file_get_contents("Gmieat/$be1/$be2/alagsam/$be3/time.json"),true);

if(!$midea["add"]["$be4"]){
unset($midea["add"]["$be4"]);
unset($midea["send"]["$be4"]);
unset($midea["num"]["$be4"]);
unset($midea["data"]["$be4"]);
unset($midea["yes"]["$be4"]);
unset($midea["data2"]["$be4"]);
unset($midea["msg"]["$be4"]);
unset($msharea["add"]["$be4"]["data1"]);
}
file_put_contents("Gmieat/$be1/$be2/alagsam/$be3/msharea.json", json_encode($msharea));
file_put_contents("Gmieat/$be1/$be2/alagsam/$be3/midea.json", json_encode($midea));
file_put_contents("Gmieat/$be1/$be2/alagsam/$be3/time.json", json_encode($time));

bot('editMessagetext',[
'chat_id'=>$chat_id,
'text'=>"
- تم الحــذف بنجــاح 🗑. 

",
'message_id'=>$message_id,
'disable_web_page_preview'=>'true',
'parse_mode'=>"markdown",
  'reply_markup'=>json_encode([
'inline_keyboard'=>[

[["text"=>"• عــــودة 🔙.",'callback_data'=>"$xs"]],
]
])
  ]);
}

if(preg_match("/^(فيديو|تبديلفيديو|إستبدالف) (.*)/s",$data)){

$exw = explode(" ", $data);
$be1 = $exw[1];
$be2 = $exw[2];
$be3 = $exw[3];
$be4 = $exw[4];
$be5 = $exw[5];
$a = $exw[0];
if($a == "تبديلفيديو"){$a1="تبديلفيديو1";}
if($a == "فيديو"){$a1="فيديوجديد";}
if($a == "إستبدالف"){$a1="إستبدالف";}

$midea= json_decode(file_get_contents("Gmieat/$be1/$be2/alagsam/$be3/midea.json"),true);
$msharea= json_decode(file_get_contents("Gmieat/$be1/$be2/alagsam/$be3/msharea.json"),true);
$data2 = $midea["data2"]["$be4"]["$be5"];
$data1 = $midea["data"]["$be4"]["$be5"];
$msgid = $midea["msg"]["$be4"]["$be5"];
$v= $midea["send"]["$be4"]["$be5"];
$namegmieat = file_get_contents("Gmieat/$be1/data/name.txt");

if($v == "message" or $a == "فيديو"){$s="editMessagetext";}
if($v != "message" and $v){$s="sendMessage";
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
]);
}
if(!$midea["msg"]["$be4"]["$be5"] or $midea["msg"]["$be4"]["$be5"] and $exw[0] == "إستبدالف"){
file_put_contents("data/amr.txt","$a1 $be1 $be2 $be3 $be4 $be5");

bot("$s",[
'chat_id'=>$chat_id,
'text'=>"
- أرسل التوثيق فيديو او صور او رابط او قوم بالعودة للإلغاء.

",

'message_id'=>$message_id,
  'reply_markup'=>json_encode([
'inline_keyboard'=>[

[["text"=>"• عــــودة 🔙.",'callback_data'=>"التقريرالاعلامي $be1 $be2 $be3 $be4"]],
]
])
  ]);

}elseif($midea["msg"]["$be4"]["$be5"]){
bot("$s",[
'chat_id'=>$chat_id, 
'text'=>"- تنبية ⚠.

لقد قمت بإرسال هذا التوثيق للقناة بتاريخ *$data2*.

- إذا كنت تريد إستبدال هذا التوثيق سوف نقوم بإستبداله ايضا في القناة

",
'message_id'=>$message_id,
'parse_mode'=>"markdown",
  'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• إستبدال.",'callback_data'=>"إستبدالف $be1 $be2 $be3 $be4 $be5"],['text'=>"• عــــودة.",'callback_data'=>"التقريرالاعلامي $be1 $be2 $be3 $be4"]],

]
])

  ]);}
}

if(preg_match("/^(جديد1) (.*)/s",$data)){

$exw = explode(" ", $data);
$ex = "$exw[1]";
$ex1 = "$exw[2]";

file_put_contents("data/amr.txt","قسمجديد $ex $ex1");
bot('editMessagetext',[
'chat_id'=>$chat_id,
'text'=>"
- أرسل أسم القسم الجديد.
",
'message_id'=>$message_id,
'disable_web_page_preview'=>'true',
'parse_mode'=>"markdown",
  'reply_markup'=>json_encode([
'inline_keyboard'=>[

[["text"=>"• إلغــاء ❌.",'callback_data'=>"الجمعية $ex $ex1"]],
]
])
  ]);
}
if(preg_match("/^(مشروعجديد) (.*)/s",$data)){
file_put_contents("data/now.txt","$data");
$exw = explode(" ", $data);
bot('editMessagetext',[
'chat_id'=>$chat_id,
'text'=>"
- أرسل بيانات المشروع الجديد على النحو التالي :.
- أسـم المشــروع : 
- أسـم المتبــرع : 
- دولة المتبــرع : 
- مكان التنفيذ :
- المهلة المحدد بالايام:  
",
'message_id'=>$message_id,
'disable_web_page_preview'=>'true',
'parse_mode'=>"markdown",
  'reply_markup'=>json_encode([
'inline_keyboard'=>[

[["text"=>"• إلغــاء ❌.",'callback_data'=>"القسم $exw[1] $exw[2] $exw[3]"]],
]
])
  ]);
}
if(preg_match("/^(كتم|كتم1) (.*)/s",$data)){

$exw = explode(" ", $data);
$time= json_decode(file_get_contents("Gmieat/$exw[1]/$exw[2]/alagsam/$exw[3]/time.json"),true);
if($exw[0] == "كتم"){
$time["add"]["$exw[4]"]["ktm"] = "yes";
file_put_contents("Gmieat/$exw[1]/$exw[2]/alagsam/$exw[3]/time.json", json_encode($time));
bot('answercallbackquery',[
            'callback_query_id'=>$chat_id10,
            'text'=>"▫️⁞ لا يمكنك تلقي إشعارات هذا المشروع ⚠.",
            'show_alert'=>true,
    ]);
return false;
}
if($exw[0] == "كتم1"){
$time["add"]["$exw[4]"]["ktm"] = "no";
file_put_contents("Gmieat/$exw[1]/$exw[2]/alagsam/$exw[3]/time.json", json_encode($time));
bot('answercallbackquery',[
            'callback_query_id'=>$chat_id10,
            'text'=>"▫️⁞ يمكنك تلقي إشعارات هذا المشروع ✅.",
            'show_alert'=>true,
    ]);
}}
$now = file_get_contents("data/now.txt");
$now = explode(" ", $now);

if($text and $now[0] == "مشروعجديد"){
$numbergm = json_decode(file_get_contents("number/number.json"),true);
$msharea= json_decode(file_get_contents("Gmieat/$now[1]/$now[2]/alagsam/$now[3]/msharea.json"),true);
$time= json_decode(file_get_contents("Gmieat/$now[1]/$now[2]/alagsam/$now[3]/time.json"),true);
$gs = file_get_contents("Gmieat/$now[1]/$now[2]/alagsam/$now[3]/add.txt");
$a2 = $gs +1;
$no = file_get_contents("number/number.txt");
$no = $no +1;
file_put_contents("number/number.txt","$no");
file_put_contents("Gmieat/$now[1]/$now[2]/alagsam/$now[3]/add.txt","$a2");
$tx = explode("\n", $text);
$no1 = str_replace(["z","a"] , "", $now[2]);
$no2 = str_replace(["z","a"] , "", $now[3]);
if($no1 < 10){
$no1= "0$no1";}
if($no2 < 10){
$no2= "0$no2";}
if($a2 < 10){
$noa= "0$a2";}
if($a2 > 9){
$a2 = "$a2";
$noa= "$a2";
}

$msharea["add"]["$a2"]["name"] = $tx[0];
$msharea["add"]["$a2"]["name2"] = $tx[1];
$msharea["add"]["$a2"]["dolh"] = $tx[2];
$msharea["add"]["$a2"]["tnfeth"] = $tx[3];
$msharea["add"]["$a2"]["data"] = $tx[4];
$mod = $tx[5];
if(!$tx[5]){
$mod = 0;
}
$alomdh = date('Y/m/d',strtotime("$tx[4] $mod day"));;
$msharea["add"]["$a2"]["almodh"] = "$alomdh";
$dno = str_replace(["20","/"] , "", $tx[4]);
$numbergm["number"]["$no"] = "$now[1]-$now[2]-$now[3]-$a2";
$numbergm["name"]["$no"] = "$tx[0]";
$msharea["add"]["$a2"]["number"]= $no;

file_put_contents("Gmieat/$now[1]/$now[2]/alagsam/$now[3]/msharea.json", json_encode($msharea));
$time["add"]["$a2"]["end"] = "$now_date";
file_put_contents("Gmieat/$now[1]/$now[2]/alagsam/$now[3]/time.json", json_encode($time));
file_put_contents("number/number.json", json_encode($numbergm));

bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$message_id-1,
]);
file_put_contents("data/now.txt","");
$msar = "$now[1]-$now[2]-$now[3]-$a2";

bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"- تم الحفظ بنجـاح ✅.

- رقــم المشـروع : `$msar` 
- أسـم المشــروع : $tx[0]
- أسـم المتبـرع : $tx[1]
- دولـة المتبـرع : $tx[2]
- تاريخ الإعتمـاد : $tx[4]
- مكــان التنفـيــذ : $tx[3]
- مـوعـد التنفيــذ : $alomdh $now_date


",

'disable_web_page_preview'=>'true',
'parse_mode'=>"markdown",
  'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"• حذف المشروع 🗑.",'callback_data'=>"حذفالمشروع $now[1] $now[2] $now[3] $a2"],['text'=>"• تعديل المعلومات ✏.",'callback_data'=>"تعديلالمعلومات $now[1] $now[2] $now[3] $a2"]],

[["text"=>"• عــــودة 🔙.",'callback_data'=>"القسم $now[1] $now[2] $now[3]"]],
]
])
  ]);
}


$amr = file_get_contents("data/amr.txt");
$amx = explode(" ", $amr);
$aex = $amx[0];
$be1 = $amx[1];
$be2 = $amx[2];
$be3 = $amx[3];
$be4 = $amx[4];
$be5 = $amx[5];
if($update->message->video  | $update->message->photo | $update->message->document and !$data  and $aex == "فيديوجديد" | $aex == "تبديلفيديو1" | $aex == "إستبدالف" or  strstr($text,"http://") and !$data  and $aex == "فيديوجديد" | $aex == "تبديلفيديو1" | $aex == "إستبدالف" or strstr($text,"https://") and !$data  and $aex == "فيديوجديد" | $aex == "إستبدالف" | $aex == "تبديلفيديو1" ){
$caption= $update->message->caption;

if($update->message->photo){
bot('sendChatAction',[
 'chat_id'=>$chat_id,
 'action'=>"upload_photo"
 ]);
$file_id = $update->message->photo[1]->file_id;
$v = "photo";
$c= "- تم حفظ الصورة بنجـاح ✅.";
$t = "التقريرالاعلامي1";
}
if($update->message->document){
$file_id = $update->message->document->file_id;
$v = "document";
$c= "- تم حفظ المقطع بنجـاح ✅.";
$t = "التقريرالاعلامي1";
}
if($update->message->video){
bot('sendChatAction',[
 'chat_id'=>$chat_id,
 'action'=>"upload_video"
 ]);
$file_id = $update->message->video->file_id;
$v = "video";
$c= "- تم حفظ المقطع بنجـاح ✅.";
$t = "التقريرالاعلامي1";
}

if(strstr($text,"http://") or strstr($text,"https://")){
$tx = explode("\n", $text);

$file_id = $tx[0];
$caption = $tx[1];

$v = "message";
$c= "- تم حفظ الرابط بنجـاح ✅.";

$t = "التقريرالاعلامي";
}

$midea= json_decode(file_get_contents("Gmieat/$be1/$be2/alagsam/$be3/midea.json"),true);
if($aex == "فيديوجديد"){

$num = $midea["num"]["$be4"];
$a2 = $num + 1;
$midea["nemav"]["$be4"]["$a2"] = $caption;
$midea["add"]["$be4"]["$a2"] = $file_id;
$midea["send"]["$be4"]["$a2"] = $v;
$midea["num"]["$be4"] = $a2;
$midea["yes"]["$be4"] = "✅";


}
if($aex == "تبديلفيديو1"){

$midea["add"]["$be4"]["$be5"] = $file_id;
$midea["send"]["$be4"]["$be5"] = $v;
$midea["nemav"]["$be4"]["$be5"] = $caption;
$c= "- تم التعديل بنجـاح ✅.";
$a2=$be5;


}
file_put_contents("Gmieat/$be1/$be2/alagsam/$be3/midea.json", json_encode($midea));
if($aex == "إستبدالف"){
$midea["add"]["$be4"]["$be5"] = $file_id;
$midea["send"]["$be4"]["$be5"] = $v;
$midea["nemav"]["$be4"]["$be5"] = $caption;
file_put_contents("Gmieat/$be1/$be2/alagsam/$be3/midea.json", json_encode($midea));
$midea= json_decode(file_get_contents("Gmieat/$be1/$be2/alagsam/$be3/midea.json"),true);
$msharea= json_decode(file_get_contents("Gmieat/$be1/$be2/alagsam/$be3/msharea.json"),true);
$namegmieat = file_get_contents("Gmieat/$be1/data/name.txt");

$name = $msharea["add"]["$be4"]["name"];
$name2= $msharea["add"]["$be4"]["name2"];
$tnfeth= $msharea["add"]["$be4"]["tnfeth"];
$data = $msharea["add"]["$be4"]["data"];
$file_id = $midea["add"]["$be4"]["$be5"];
$v= $midea["send"]["$be4"]["$be5"];
$msgid = $midea["msg"]["$be4"]["$be5"];
$dolh= $msharea["add"]["$be4"]["dolh"];
$almodh = $msharea["add"]["$be4"]["almodh"];
$no = $msharea["add"]["$be4"]["number"];
$msar = $numbergm["number"]["$no"];
$msar = strtoupper($msar);
if($v == "message" ){
bot('editMessagetext',[
'chat_id'=>$ch, 
'text'=>"
- LINK : *$file_id*

- رقم المشروع: `$msar`
- أسم المشروع: *$name*.
- أسـم المتبرع: *$name2*.
- دولـة المتبرع: *$dolh*.
- مكان التنفيذ: *$tnfeth*.
- الجهة المـانحة: *$namegmieat*
- تاريخ إعتماد المشروع: *$data*.
- تاريخ تنفيذ المشروع: *$almodh*.
",
'message_id'=>$msgid,
'disable_web_page_preview'=>'true',
'parse_mode'=>"markdown",
  ]);
}
if($v != "message" ){
bot("editmessagemedia",[
'chat_id'=>$ch,
'message_id'=>$msgid,
'parse_mode'=>"markdown",

'media'=>json_encode([
'type'=>"$v",
'media'=>$file_id,
'caption'=>"- رقم المشروع: `$msar`
- أسم المشروع: *$name*.
- أسـم المتبرع: *$name2*.
- دولـة المتبرع: *$dolh*.
- مكان التنفيذ: *$tnfeth*.
- الجهة المـانحة: *$namegmieat*
- تاريخ إعتماد المشروع: *$data*.
- تاريخ تنفيذ المشروع: *$almodh*.
",
]),
'disable_web_page_preview'=>true,
 
  ]);


}
$c= "- تم التعديل بنجـاح ✅.";

}


$msharea= json_decode(file_get_contents("Gmieat/$be1/$be2/alagsam/$be3/msharea.json"),true);
$name = $msharea["add"]["$be4"]["name"];
$name2= $msharea["add"]["$be4"]["name2"];

$tnfeth= $msharea["add"]["$be4"]["tnfeth"];
$data = $msharea["add"]["$be4"]["data"];
$dno = str_replace(["20","/"] , "", $data);
$res['inline_keyboard'][] = [['text'=>"• إرسال للقناة.",'callback_data'=>"ارسالللقناة $be1 $be2 $be3 $be4 $a2"]];
$res['inline_keyboard'][] = [['text'=>"• حذف التقرير 🗑.",'callback_data'=>"حذففيديو1 $be1 $be2 $be3 $be4 $a2"],['text'=>"• تبديل التقرير ♻.",'callback_data'=>"تبديلفيديو $be1 $be2 $be3 $be4 $a2"]];
$res['inline_keyboard'][] = [['text'=>"• إضافة المزيد.",'callback_data'=>"فيديو $be1 $be2 $be3 $be4"],['text'=>"• عــــودة 🔙.",'callback_data'=>"$t $be1 $be2 $be3 $be4"]];

bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$message_id-1,
]);
if($v != "message"){
bot("send$v",[
'chat_id'=>$chat_id, 
"$v"=>"$file_id",
'caption'=>" $c

- رقــم المشـروع : `$msar`
- أسـم المشــروع : $name
- أسـم المتبــرع : $name2
- مكــان التنفـيــذ : $tnfeth

",
'reply_to_message_id'=>$message_id,
'parse_mode'=>markdown,
'disable_web_page_preview'=>true,
  'reply_markup' => json_encode($res)
 
  ]);
}
if($v == "message"){
bot('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>"$c

$file_id

- رقــم المشـروع : `$msar`
- أسـم المشــروع : $name
- أسـم المتبــرع : $name2
- مكــان التنفـيــذ : $tnfeth
",
'reply_to_message_id'=>$message_id,
'disable_web_page_preview'=>true,
  'reply_markup' => json_encode($res)
 
  ]);
}
file_put_contents("data/amr.txt","");
}


if($text and $aex == "قسمجديد" and $from_id == $admin){
$gs = file_get_contents("Gmieat/$be1/$be2/data/addgs.txt");
$be3 = $gs +1;
if($be3 < 10){
$a1 = "a$be3";
}
if($be3 > 9){
$a1 = "z$be3";
}
mkdir("Gmieat/$be1/$be2/alagsam/$a1");
file_put_contents("Gmieat/$be1/$be2/data/addgs.txt","$be3");

file_put_contents("Gmieat/$be1/$be2/alagsam/$a1/name.txt","$text");
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$message_id-1,
]);
file_put_contents("data/amr.txt","");
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"
-  تم إنشاء قسـم جديد : $text .
",

'disable_web_page_preview'=>'true',
'parse_mode'=>"markdown",
  'reply_markup'=>json_encode([
'inline_keyboard'=>[

[["text"=>"• عــــودة 🔙.",'callback_data'=>"الجمعية $be1 $be2"]],
]
])
  ]);
}

if($text and $aex == "القسمتعديل" and $from_id == $admin){


file_put_contents("Gmieat/$be1/$be2/alagsam/$be3/name.txt","$text");
MrDGb( $chat_id,$message_id,$mang);
file_put_contents("data/amr.txt","");
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"
- تم تعديل القسـم الى : $text .
",

'disable_web_page_preview'=>'true',
'parse_mode'=>"markdown",
  'reply_markup'=>json_encode([
'inline_keyboard'=>[

[["text"=>"• عــــودة 🔙.",'callback_data'=>"الجمعية $be1 $be2"]],
]
])
  ]);
}


if($text == 'الملف' and $chat_id == $admin){
 bot('sendDocument',[
 'chat_id'=>$admin,
 'document'=>new CURLFile(__FILE__)
]);
}
$callbackMessage = '';
var_dump(bot('answerCallbackQuery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>$callbackMessage]));
}
