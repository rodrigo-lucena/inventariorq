<?php
namespace Invent;

/* Configurações exclusivas para o seus sistema */
class Config{
	
	/*Informações do seu BD MySQL */
	public static function getBancoDeDados(){ 
		return array(
			"hostname"=>"",
			"username"=>"",
			"password"=>"",
			"dbname"=>""
		);
	}
	
	/* Informações do email de suporte que enviará emails para o usuário do sistema */
	public static function getEmail(){ 
		return array(
			"username"=>"", // endereço de email (gmail)
			"password"=>"", // senha do email
			"name_from"=>"" // Nome do suporte (nome de identificação nos emails que o usuário receberá ao se cadastrar ou restaurar sua senha) 
		);
	}
	
	/* Chaves secretas de criptografia à sua escolha. Precisam ser de 16 caracteres (podem ser completadas por espaços vazios) */
	public static function getSenha(){ 
		return array(
			"secret_IV"=>"",
			"secret"=>""
		);
	}
}



?>