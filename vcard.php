<?php

	$link = mysql_connect($config['DB_SERVER'], $config['DB_USER'], $config['DB_PASSWORD']);
	if (!$link) {
    		die('Could not connect: ' . mysql_error());
	}

	// make foo the current db
	$db_selected = mysql_select_db($config['DB_DB', $link);
	if (!$db_selected) {
    		die ('Can\'t use foo : ' . mysql_error());
	}

	$username = $_GET['username'];

	$sql="SELECT * FROM profiles WHERE username='$username'";
  	$result=mysql_fetch_assoc(mysql_query($sql));
  
	// define here all the variable like $name,$image,$company_name & all other
	
	//var_dump($result);
	//die;

	$full_name = $result['full_name'];
	$email = $result['email'];
	$phone_number = $result['phone_number'];
	
 	header('Content-Type: text/x-vcard');  
  	header('Content-Disposition: inline; filename= "'.$username.'.vcf"');  

	// This is if you have a photo
	// we dont so we will comment this out.

  	//if($image!="")
	//{ 
    	//	$getPhoto               = file_get_contents($image);
        //	$b64vcard               = base64_encode($getPhoto);
    	//	$b64mline               = chunk_split($b64vcard,74,"\n");
    	//	$b64final               = preg_replace('/(.+)/', ' $1', $b64mline);
    //		$photo                  = $b64final;
  //	}
  
	$vCard = "BEGIN:VCARD\r\n";
  	$vCard .= "VERSION:3.0\r\n";
  	$vCard .= "FN:" . $full_name . "\r\n";

  	if($email)
	{
    		$vCard .= "EMAIL;TYPE=internet,pref:" . $email . "\r\n";
 	}
  
//	if($getPhoto)
//	{
  //  		$vCard .= "PHOTO;ENCODING=b;TYPE=JPEG:";
    //		$vCard .= $photo . "\r\n";
  //	}

  	if($phone_number)
	{
    		$vCard .= "TEL;TYPE=work,voice:" . $phone_number . "\r\n"; 
  	}
	
	$vCard .= "URL:" . "https://social.rhcp011235.me/" . $username . "\r\n";
  	$vCard .= "END:VCARD\r\n";
  	echo $vCard;

?>
