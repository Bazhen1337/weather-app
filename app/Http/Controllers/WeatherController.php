<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Weather;

class WeatherController extends Controller
{
    public function show(string $city = 'Воронеж')
    {
        $weatherModel = new Weather();
        $weatherData = $weatherModel->getCurrentWeather($city);

        return view('weather', [
            'city' => $city,
            'iconUrl' => $weatherData['iconUrl'],
            'temperature' => $weatherData['weather_response']['main']['temp'],
            'description' => $weatherData['weather_response']['weather'][0]['description'],
            'wind' => $weatherData['weather_response']['wind']['speed'],
            'windDirection' => $weatherData['direction'],
            'pressure' => $weatherData['weather_response']['main']['pressure'],
            'humidity' => $weatherData['weather_response']['main']['humidity'],
            'pop' => $weatherData['weather_forecast_response']
        ]);
    }
}
