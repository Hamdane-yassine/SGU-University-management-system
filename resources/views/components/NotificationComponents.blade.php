@if(Auth::User()->notifications->count())
@foreach (Auth::User()->UnreadNotifications->take(50) as $notification)
<li>
    @if($notification->type === 'App\Notifications\NotifyEvent' )
    <a href="{{ url('/evenement/'.$notification->data['idEvent']) .'?idNotif='.$notification->data['idNotif']}}" target="_blank">
    @else <a href="{{ url('/notifications?idNotif='.$notification->data['idNotif']) }}">
    @endif
        <img src="{{ $notification->data['image'] }}" alt="profile image">
        <h3>{{$notification->data['from']}}</h3>
        <p style="word-wrap: break-word">{{Str::substr($notification->data['brief'], 0, 50) }}...</p>
    </a>
</li>

@endforeach
@endif

