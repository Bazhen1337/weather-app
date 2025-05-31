<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Weather extends Model
{
    protected $apiKey = 'fd4848476d2090a78d19d44bf13059b9';
    protected $weatherUrl = 'https://api.openweathermap.org/data/2.5/weather';

    protected $forecastWeatherUrl = 'https://api.openweathermap.org/data/2.5/forecast';

    protected $iconUrl = 'https://openweathermap.org/img/wn/%s@%s.png';

    public function getCurrentWeather(string $city, string $units = 'metric', string $lang = 'ru'): array
    {
        $weather_response = $this->getApiResponse($this->weatherUrl, $city, $units, $lang);
        $weather_forecast_response = $this->getApiResponse($this->forecastWeatherUrl, $city, $units, $lang, 1);

        $direction = $this->getWindDirection($weather_response['wind']['deg']);
        $far = $this->toFahrenheit($weather_response['main']['temp']);
        $iconUrl = $this->getIcon($weather_response['weather'][0]['icon']);
        return [
            'weather_response' => $weather_response,
            'weather_forecast_response' => $weather_forecast_response['list'][0]['pop'] * 100,
            'iconUrl' => $iconUrl,
            'far' => $far,
            'direction' => $direction
        ];
    }

    public function getIcon(string $iconCode): string
    {
        return sprintf($this->iconUrl, $iconCode, '4x');
    }

    public function toFahrenheit(float $temp): float
    {
        return ($temp * 9 / 5 + 32);
    }

    public function getWindDirection(int $degrees): string
    {
        $directions = [
            'северный', 'северо-восточный', 'восточный', 'юго-восточный',
            'южный', 'юго-западный', 'западный', 'северо-западный'
        ];

        $index = round(($degrees % 360) / 45) % 8;
        return $directions[$index];
    }

    public function getApiResponse(string $url, string $city, string $units = 'metric', $lang = 'ru', $cnt = '')
    {
        $weather_response = Http::get($url, [
            'q' => $city,
            'appid' => $this->apiKey,
            'units' => $units,
            'lang' => $lang,
            'cnt' => $cnt
        ]);

        return $weather_response->json();
    }

}
