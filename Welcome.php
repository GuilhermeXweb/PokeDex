<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{	
		$id = $this ->input->get('id');
		$data['aleatorio'] = rand(1, 1025);

		if ($id) {
			$resultado = $this->buscarPokemon($id);

			if ($resultado) {
				$data['pokemon'] = $resultado;
			}
			else {
				$data['erro'] = "Não foi possivel encontrar esse pokemon!";
			}
		} 

		$this->load->view('welcome_message', $data);

	}
	private function buscarPokemon($id){
		// 1 montamos a url	
		$url = 'https://pokeapi.co/api/v2/pokemon/'.$id;

		// 2 iniciamos o cURL apontando para aquela url
		$ch = curl_init($url);
		
		// 3 indica para o php não escrever os dados na tela
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		// 4 executa a requisição e coloca a respota na variavel $resposta
		$resposta = curl_exec($ch);

		// 5 buscar status da requisição (200 = ok - 404 = not found)
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		// 6 fecha a conexão (sempre feche depois de usar)
		curl_close($ch);

		// se der erro usamos o fail-fast
		if ($http_code != 200){
			return null;
		}

		// 7 Transformar a resposta em um objeto php
		$pokemon = json_decode($resposta);
		
		// 8 retornar os dados do pokemon
		return [
			'id' =>$pokemon->id ,
			'nome' =>ucfirst($pokemon->name),
			'altura' => $pokemon->height /10,
			'peso' => $pokemon->weight /10,
			'imagem' => $pokemon->sprites->front_default,
			'tipo' => array_map(function($type){
				return ucfirst($type->type->name);
			},$pokemon->types)
		];
	}
}	


