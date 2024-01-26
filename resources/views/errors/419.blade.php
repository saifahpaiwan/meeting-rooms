@extends('layouts.auth')
@section('title', '419 Session has Expired')
@section('content')
<div style="font-size : clamp(2rem, 10vw, 5rem); font-weight: bold;">419 Session has Expired</div>
<div class="mb-3" style="border-bottom: 5px solid; width: 20%;"></div>
<div>Sorry, your session has expired. Please refresh and try again.</div>
<div class="mb-2"> <b class="text-primary">BG</b> Container Glass Public Company Limited </div>
<a href="{{ route('login') }}" class="btn btn-lg btn-outline-primary btn-rounded waves-effect width-md waves-light">Login Now.</a>
@endsection