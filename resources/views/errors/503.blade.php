@extends('layouts.auth')
@section('title', '503 Service Unavailable')
@section('content')
<div style="font-size : clamp(2rem, 10vw, 5rem); font-weight: bold;">503 Service Unavailable</div>
<div class="mb-3" style="border-bottom: 5px solid; width: 20%;"></div>
<div>Sorry, the service is temporarily unavailable. Please try again later.</div>
<div class="mb-2"> <b class="text-primary">BG</b> Container Glass Public Company Limited </div>
<a href="{{ route('home') }}" class="btn btn-lg btn-outline-primary btn-rounded waves-effect width-md waves-light">Go Home</a>
@endsection