@if(\App\Models\Evenement::orderBy('created_at','DESC')->count())
@foreach (\App\Models\Evenement::orderBy('created_at','DESC')->take(5)->get() as $evt)
    <li>
        <a href="{{ url('/evenement/'.$evt->idEvenement) }}">{{ $evt->titre }}
            <img src="{{ asset('vendors/images/event.svg') }}" alt="event">
            <p class="caption" style="word-break: break-all">{{ Str::substr($evt->resume,0,50) }}... <small class="pull-right">{{ $evt->date->format('Y M D') }}</small></p>
            {{-- {{ dd($evt->date->format('Y-M-D')) }} --}}
        </a>
    </li>
@endforeach
@else
<div class="chat-body clearfix ml-3">
    <p style="word-wrap: break-word"><span class="d-block text-secondary pb-1">
    </span class="align-self-center" ><i class="fa fa-info-circle mr-1"></i>Aucun évènements n'est trouvé pour le moment</span>
    <div class="chat_time float-right mb-10"> </div>
</div>
@endif
