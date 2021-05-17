@foreach (\App\Models\Evenement::orderBy('created_at','DESC')->take(5)->get() as $evt)
    <li>
        <a href="{{ url('/evenement/'.$evt->idEvenement) }}">{{ $evt->titre }}
            <img src="{{ asset('vendors/images/event.svg') }}" alt="event">
            <p class="caption" style="word-break: break-all">{{ Str::substr($evt->resume,0,50) }}... <small class="pull-right">{{ $evt->date }}</small></p>
            {{-- {{ dd($evt->date->format('Y-M-D')) }} --}}
        </a>
    </li>
@endforeach
