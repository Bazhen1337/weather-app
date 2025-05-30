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
            'weather' => $weatherData,
            //'iconUrl' => $iconUrl
//            'weatherIcon' => '',
//            'temperature' => '',
//            'description' => '',
//            'wind' => '',
//            'atmosphericPressure' => '',
//            'humidity' => '',
//            'rainChanse' => ''
        ]);
    }
}
