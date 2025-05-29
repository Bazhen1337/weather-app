<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.openweather.key'); // FIXME: регнуться на сайте с апи и получить ключ
    }

    public function getCurrentWeather(string $city): array
    {
        $response = '{
        "lat": 52.2297,
  "lon": 21.0122,
  "timezone": "Europe/Warsaw",
  "timezone_offset": 3600,
  "data": [
    {
        "dt": 1645888976,
      "sunrise": 1645853361,
      "sunset": 1645891727,
      "temp": 279.13,
      "feels_like": 276.44,
      "pressure": 1029,
      "humidity": 64,
      "dew_point": 272.88,
      "uvi": 0.06,
      "clouds": 0,
      "visibility": 10000,
      "wind_speed": 3.6,
      "wind_deg": 340,
      "weather": [
        {
            "id": 800,
          "main": "Clear",
          "description": "clear sky",
          "icon": "01d"
        }
      ]
    }
  ]
}';
/*        $response = Http::get("/", [
            'q' => $city,
            'appid' => $this->apiKey,
            'units' => 'metric',
            'lang' => 'ru'
        ]);*/
        // FIXME: узнать о работе данного апи
        //return $response->json();
        return json_decode($response, true);
    }
}
