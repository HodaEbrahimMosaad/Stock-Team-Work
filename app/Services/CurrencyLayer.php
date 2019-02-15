<?php

namespace App\Services;

use GuzzleHttp\Client;


class CurrencyLayer
{
	public $client = null;
	private $apiKey = null;
	private $baseUrl= null;

	public function __construct($apiKey)
	{
		$this->client = new Client();
		$this->apiKey = $apiKey;
		$this->baseUrl = env('BASE_URL', 'http://apilayer.net/api/');
	}

	public function live($currencies)
	{
		$currencies = implode(',', $currencies);
		return $this->get('live', ['currencies'=>$currencies]);
	}
	
	public function historical($date, $currencies)
	{
		$currencies = implode(',', $currencies);
		return $this->get('historical', ['date'=>$date, 'currencies'=>$currencies]);
	}

	private function get($request, Array $attributes = [])
	{
		$query = "$this->baseUrl$request?access_key=$this->apiKey";
		foreach ($attributes as $key => $value) {
			echo $key, $value;
			$query .= "&$key=$value";
		}
		$response = $this->client->get($query);
		return $this->getBodyOrFail($response);
	}

	private function getBodyOrFail($response)
	{
		return json_decode($response->getBody()->getContents());
	}
}













?>