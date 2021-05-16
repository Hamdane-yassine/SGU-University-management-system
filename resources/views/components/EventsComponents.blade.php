@foreach (\App\Models\Evenement::all()->take(6) as $evt)
        <li>
            <a href="{{ url('/evenement/'.$evt->idEvenement) }}">{{ $evt->titre }}
                <img src="{{ asset('vendors/images/event.svg') }}" alt="event">
                <p class="caption">{{ Str::substr($evt->resume,0,50) }}...</p>
                <span class="caption pull-right" style="color: slategray">{{ $evt->date }}</span>
            </a>
        </li>
@endforeach
