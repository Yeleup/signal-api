<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class SignalApiService
{
    protected Client $client;
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => config('services.signal.base_url'),
            'timeout'  => 60.0,
            'http_errors' => false,
        ]);
    }

    public function sendRequest(Request $request, $path): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        // Преобразуем путь и метод запроса в имя метода класса
        $method = strtolower($request->method()) . str_replace('/', '', ucwords($path, '/'));

        if (method_exists($this, $method)) {
            return $this->$method($request);
        }
        return $this->genericRequest($request, $path);
    }

    protected function genericRequest(Request $request, $path): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $response = $this->client->request($request->method(), $path, [
            'headers' => $this->filterHeaders($request->header()),
            'query' => $request->query(),
            'body' => $request->getContent(),
        ]);

        return response($response->getBody()->getContents(), $response->getStatusCode())
            ->withHeaders($this->filterHeaders($response->getHeaders()));
    }

    protected function filterHeaders(array $headers): array
    {
        // Фильтрация или модификация заголовков по необходимости
        return collect($headers)->mapWithKeys(function ($value, $key) {
            return [str_replace('_', '-', $key) => $value];
        })->toArray();
    }
}