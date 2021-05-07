@extends('layouts.prof')
@section('title','Notifications')
@section('content')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="bg-white border-radius-4 box-shadow mb-30">
                    <div class="pt-20 pl-20 pb-0">
                        <h4 class="h4">Notifications</h4>
                    </div>
                    <hr>
                    <div class="row no-gutters no-footer">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="chat-detail">
                                <div class="chat-box h-100">
                                    <div class="chat-desc customscroll h-100">
                                        <ul>
                                            <li class="clearfix">
                                                @if(Auth::user()->notifications->count())
                                                    @foreach (Auth::user()->notifications as $notification)
                                                        <div class="chat-body clearfix ml-3" id="notif-{{ $notification->id }}">
                                                            <p>
                                                            <span class="d-block text-secondary pb-1">

                                                                <b><u>{{ $notification->data['from'] }}</u> :</b>
                                                            </span>{{ $notification->data['brief'] }}</p>
                                                            <div class="chat_time float-right mb-10"> {{ $notification->created_at }}</div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-wrap pd-20 mb-20 card-box">
                DeskApp - Bootstrap 4 Admin Template By <a href="https://github.com/dropways" target="_blank">Ankit
                    Hingarajiya</a>
            </div>
        </div>
    </div>
    <div id="editor">
        <p>This is the editor content.</p>
    </div>
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'editor' );
    </script>
    @endsection
