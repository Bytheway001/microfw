<?php 
namespace App\Libs;
use Firebase\JWT\JWT;
class Session{
	static $token_duration = 10;
	private $serverName = "localhost";
	public function __construct(){
		$this->secretKey = $_ENV['SECRET_KEY'];
		$issuedAt = new \DateTimeImmutable();
		$servername = 'www.myserver.com';
		$this->data=[
			'iat'=>$issuedAt,
			'iss'=>$servername,
			'nbf'=>$issuedAt,
			'exp'=>$issuedAt->modify('+'.static::$token_duration.' minutes')->getTimestamp(),
		];

	}
	public function createJwtToken(){
		$token = JWT::encode($this->data,$this->secretKey,'HS512');
		return $token;
	}
}


 ?>