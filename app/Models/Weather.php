<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Weather extends Model
{
    protected $apiKey = 'fd4848476d2090a78d19d44bf13059b9';
    //protected $geoUrl = 'http://api.openweathermap.org/geo/1.0/direct';
    protected $weaterUrl = 'https://api.openweathermap.org/data/2.5/weather';

    protected $iconUrl = 'https://openweathermap.org/img/wn/%s@%s.png';

    /*public function getCoordinates(string $city)
    {
        $response = Http::get($this->geoUrl, [
            'q' => $city,
            'limit' => 1,
            'appid' => $this->apiKey
        ]);

        if ($response->successful()) {
            //$data = $response->json();

            if (!empty($response)) {
                return $response;
            }
        }

        return null;
    }*/

    public function getIcon(string $iconCode): string
    {
        return sprintf($this->iconUrl, $iconCode, '4x');
    }

    public function toFahrenheit(float $temp): float
    {
        return ($temp * 9 / 5 + 32);
    }

    public function getCurrentWeather(string $city, string $units = 'metric'): array
    {
        $weather_response = Http::get($this->weaterUrl, [
            'q' => $city,
            'appid' => $this->apiKey,
            'units' => $units,
            'lang' => 'ru'
        ]);
        $far = $this->toFahrenheit($weather_response['main']['temp']);
        $iconUrl = $this->getIcon($weather_response['weather'][0]['icon']);
        return [
            'weather_response' => $weather_response->json(),
            'iconUrl' => $iconUrl,
            'far' => $far
        ];
    }
}
