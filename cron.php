<?php

require('config.php');

file_get_contents($website."/sendmessage?chat_id=330959283&text=Cron was called");
file_get_contents("https://insulterbot.herokuapp.com/main.php");

date_default_timezone_set('Asia/Kolkata');

$data= getdate();

$month =  $data['month'];
$date  =  $data['mday'];
$hours  = $data['hours'];
$month = ucwords($month);

if($hours!=00)
	return;

$special_days= file_get_contents('Data/specialdays.txt');
$special_days= explode("\n",$special_days);
$date=(string)$date;

foreach( $special_days as $today )
{
      if(strstr($today,$month) && strstr($today,$date))
       {    
          $length=strlen($today);
          $today[$length-1]=" ";
      
            $conn = new mysqli($dbhost, $dbusername, $dbpassword,$dbname);
            $result= $conn->query("select * from `user_details` ");
			
	        		while ($row = $result->fetch_assoc())
			{
			   file_get_contents($website."/sendmessage?chat_id=".$row['chat_id']."&text=Today's special day: $today");
			}
	   }
}

?>