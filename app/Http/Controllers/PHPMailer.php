<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\PHPMailerAutoload;

class PHPMailer extends Controller
{

	public static function PHPMailer()
	{
		$mail = new PHPMailer();
		return $mail;
	}

}