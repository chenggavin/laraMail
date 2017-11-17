@extends('layouts.app-panel')

@section('title')

  {{ $title }}

@endsection

@section('content')

  <table class="table">
    <thead>
      <tr>
        <th></th>
        <th>From</th>
        <th>Subject</th>
        <th>Date</th>
        <th></th>

      </tr>
    </thead>
    <tbody>

    @foreach ($messages as $message)
      <tr onclick="document.location='/messages/{{ $message->id }}'" class="{{ $message->pivot->is_read == true ? '' : 'unread' }}">
        <td style="width: 30px">
          @if ($message->pivot->is_starred)
            <strong>&#9734;</strong>
          @endif
        </td>
        <td>{{ $message->sender->name }}</td>
        <td>{{ $message->subject }}</td>
        <td>{{ $message->prettySent() }}</td>
        <td>
          <form class="button-form" method="post" action="/messages/{{ $message->id }}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button class="btn btn-xs btn-default">
              <i class="fa fa-trash" aria-hidden="true"></i>
            </button>
          </form>
          <form class="button-form" method="post" action="/messages/{{ $message->id }}/starInbox">
            {{ csrf_field() }}
            <button class="btn btn-xs btn-default"><strong>&#9734;</strong></button>
          </form> 
        </td>
      </tr>
    @endforeach

  </table>

@endsection