<?php

class Utils {
	
	public static function getFileExtension($fileName) {
		return end(explode('.', $fileName));
	}
	
	public static function send_request_via_fsockopen($host,$path,$content)
	{
		$posturl = "ssl://" . $host;
		$header = "Host: $host\r\n";
		$header .= "User-Agent: PHP Script\r\n";
		$header .= "Content-Type: text/xml\r\n";
		$header .= "Content-Length: ".strlen($content)."\r\n";
		$header .= "Connection: close\r\n\r\n";
		$fp = fsockopen($posturl, 443, $errno, $errstr, 30);
		if (!$fp)
		{
			$response = false;
		}
		else
		{
			error_reporting(E_ERROR);
			fputs($fp, "POST $path  HTTP/1.1\r\n");
			fputs($fp, $header.$content);
			fwrite($fp, $out);
			$response = "";
			while (!feof($fp))
			{
				$response = $response . fgets($fp, 128);
			}
			fclose($fp);
			error_reporting(E_ALL ^ E_NOTICE);
		}
		return $response;
	}

	//function to send xml request via curl
	public static function send_request_via_curl($host,$path,$content)
	{
		$posturl = "https://" . $host . $path;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $posturl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml"));
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$response = curl_exec($ch);
		return $response;
	}	
	
	public static function parse_return($content)
	{
		$refId = Utils::substring_between($content,'<refId>','</refId>');
		$resultCode = Utils::substring_between($content,'<resultCode>','</resultCode>');
		$code = Utils::substring_between($content,'<code>','</code>');
		$text = Utils::substring_between($content,'<text>','</text>');
		$subscriptionId = Utils::substring_between($content,'<subscriptionId>','</subscriptionId>');
		$status = Utils::substring_between($content,'<status>','</status>');
		
		return array('refId'=>$refId, 
					 'resultCode'=>$resultCode, 
					 'code'=>$code, 
					 'text'=>$text, 
					 'subscriptionId'=>$subscriptionId, 
					 'status'=>$status);
	}

	//helper function for parsing response
	public static function substring_between($haystack,$start,$end) 
	{
		if (strpos($haystack,$start) === false || strpos($haystack,$end) === false) 
		{
			return false;
		} 
		else 
		{
			$start_position = strpos($haystack,$start)+strlen($start);
			$end_position = strpos($haystack,$end);
			return substr($haystack,$start_position,$end_position-$start_position);
		}
	}
	
	public static function logToPaymentFile($paymentType, $message) {
		if (!$handle = fopen('../paylogs/'.$paymentType.'_'.date('Y-m-d').'.txt', 'a')) {
			echo "Cannot open file ($filename)";
			return;
		}

		// Log to our opened file.
		fwrite($handle, "--------------------------------------------------------------------------\n");

		fwrite($handle, $message);
		
		fwrite($handle, "--------------------------------------------------------------------------\n");
		fclose($handle);
	}
	
	public static function getReferingMediabroker() {
		if(isset($_COOKIE['p_ref']) && $_COOKIE['p_ref'] != '') {
			return $_COOKIE['p_ref'];
		}
		
		return null;
	}

}