@extends('frontend.master')
@section('content') 
<div class="container">
    <div class="col-md-4 col-md-offset-3">
        <h4 class="text-center">Chat box</h4>
        <div class="form-group">
            <input type="text" name="" class="form-control" id="input" placeholder="Enter your message...">
        </div>
        <div class="form-group">
            <button type="button" class="btn btn-primary" id="send">Send</button>
        </div>
    </div>
</div>
@endsection
