<?php 
namespace App\Libs;
use App\Models\User;
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
			'exp'=>$issuedAt->modify('+'.static::$token_duration.' seconds')->getTimestamp(),
		];

	}
	public function createJwtToken(){
		$token = JWT::encode($this->data,$this->secretKey,'HS512');
		return $token;
	}

	static function isValid(){
		$ignore_uris = ['/auth','/login'];
		$uri = strtok($_SERVER['REQUEST_URI'], '?');

		if (!in_array('/auth',$ignore_uris)) {
			if (!preg_match('/Bearer\s(\S+)/', $_SERVER['HTTP_AUTHORIZATION'], $matches)) {
				return false;
			}
			else return true;
		}
		return true;
	}

	static function validateLoginParams(){

	}

	static function create(string $username,string $password){

	}


}


 ?>