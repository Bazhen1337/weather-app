<x-layout>
    <div class="weather-container">
        <h2>{{ $city }}</h2>
        <div class="weather-info">
            <img src="{{ $iconUrl }}"
                 alt="{{ $description }}"
                 title="{{ $description }}">

            <div class="temperature">
                {{ round($temperature) }}°C
            </div>

            <div class="details">
                <div>Влажность: {{ $humidity }}%</div>
                <div>Ветер: {{ $wind }} м/с, {{ $windDirection }}</div>
                <div>Давление: {{ $pressure }} гПа</div>
{{--                <div>Фаренгейт: {{ round($weather['far']) }} °F</div>--}}
                <div>Вероятность дождя: {{ round($pop) }} %</div>
            </div>
        </div>
    </div>
</x-layout>
