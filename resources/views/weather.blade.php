<x-layout>
    <div class="weather-container">
        <h2>Погода в {{ $weather['weather_response']['name'] }}</h2>
        <div class="weather-info">
            <img src="{{ $weather['iconUrl'] }}"
                 alt="{{ $weather['weather_response']['weather'][0]['description'] }}"
                 title="{{ $weather['weather_response']['weather'][0]['description'] }}">

            <div class="temperature">
                {{ round($weather['weather_response']['main']['temp']) }}°C
                <div class="feels-like">
                    Ощущается как {{ round($weather['weather_response']['main']['feels_like']) }}°C
                </div>
            </div>

            <div class="details">
                <div>Влажность: {{ $weather['weather_response']['main']['humidity'] }}%</div>
                <div>Ветер: {{ $weather['weather_response']['wind']['speed'] }} м/с, {{ $weather['direction'] }}</div>
                <div>Давление: {{ $weather['weather_response']['main']['pressure'] }} гПа</div>
                <div>Фаренгейт: {{ round($weather['far']) }} °F</div>
            </div>
        </div>
    </div>
    @dd($weather)
</x-layout>
