@foreach (\App\Models\Evenement::latest()->take(6) as $evt)
    <li>
        <a href="{{ url('/evenement/'.$evt->idEvenement) }}">{{ $evt->titre }}
            <img src="{{ asset('vendors/images/event.svg') }}" alt="event">
            <p class="caption">{{ Str::substr($evt->resume,0,50) }}... <small class="pull-right">{{ $evt->date }}</small></p>
        </a>
    </li>
@endforeach
