@extends('layouts.auth')
@section('title', '404 Not Found')
@section('content')
<div style="font-size : clamp(2rem, 10vw, 5rem); font-weight: bold;">404 Not Found</div>
<div class="mb-3" style="border-bottom: 5px solid; width: 20%;"></div>
<div>The page you are looking for could not be found.</div>
<div class="mb-2"> <b class="text-primary">BG</b> Container Glass Public Company Limited </div>
<a href="{{ route('home') }}" class="btn btn-lg btn-outline-primary btn-rounded waves-effect width-md waves-light">Go Home</a>
@endsection