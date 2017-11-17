@extends('layouts.app-panel')

@section('title')
	<a href="{{ URL::previous() }}" class="btn btn-xs btn-default">Back</a>

   <div class="pull-right">

    <form class="button-form" method="post" action="/messages/{{ $message->id }}">
      {{ csrf_field() }}
      {{ method_field('DELETE') }}
      <button class="btn btn-xs btn-default">
        <i class="fa fa-trash" aria-hidden="true"></i>
      </button>
    </form>


  </div>

@endsection

@section('content')

  <form class="form-horizontal" method="post" action="/messages/{{ $message->id }}">
  	 {{ csrf_field() }}
     {{ method_field('PUT') }}

    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="form-group">
      <label for="recipients" class="col-sm-2 control-label">Recipients</label>
      <div class="col-sm-10">
        <select multiple name="recipients[]" value="{{ $message->recipients }}" class="form-control" required>

@foreach ($recipients as $recipient)

      @if ($message->recipients->contains('id', $recipient->id))
        <option value="{{ $recipient->id }}" selected> {{ $recipient->name }}</option>
      @else
        <option value="{{ $recipient->id }}"> {{ $recipient->name }}</option>
      @endif

@endforeach

        </select>
      </div>
    </div>

    <div class="form-group">
      <label for="subject" class="col-sm-2 control-label">Subject</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="subject" id="subject" value="{{ $message->subject }}" placeholder="Subject">
      </div>
    </div>

    <hr />

    <div class="form-group">
      <div class="col-sm-12">
        <textarea class="form-control" rows="10" name="body" id="body"  placeholder="Blah blah blah...">{{ $message->body }}</textarea>
      </div>
    </div>


    <div class="form-group">
      <div class="col-sm-12 text-center">
        <button type="submit" name="button" value="save" class="btn btn-xs btn-default">Save</button>
        <button type="submit" name="button" value="send" class="btn btn-xs btn-default">Send</button>
      </div>
    </div>

  </form>

@endsection