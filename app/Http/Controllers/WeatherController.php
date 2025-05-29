<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Weather;

class WeatherController extends Controller
{
    public function show(string $city = 'Voronezh')
    {
        $weatherModel = new Weather();
        $weatherData = $weatherModel->getCurrentWeather($city);

        return view('weather', [
            'weatherIcon' => '',
            'temperature' => '',
            'description' => '',
            'wind' => '',
            'atmosphericPressure' => '',
            'humidity' => '',
            'rainChanse' => ''
        ]);
    }
}
