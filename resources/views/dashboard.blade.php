@extends('layouts.dashboard.dashboard')
@include('layouts.dashboard.nav')
@section('content')
<div>
<div class="container-full mx-auto">
    <div class="flex md:flex-row justify-start items-center">
        @include('layouts.dashboard.sidebar',array('page'=> isset($page) ? $page: ''))
        <div class="sidebar w-5/6 h-screen">
            
            @if(isset($page) && $page === 'create')
                @include('layouts.dashboard.create')
            @endif
            @if(isset($page) && $page === 'manage')
                @include('layouts.dashboard.manage')
            @endif
            @if(isset($page) && $page === 'settings')
                @include('layouts.dashboard.settings')
            @endif
            @if(isset($page) && $page === 'statistics')
                @include('layouts.dashboard.statistics')
            @endif
        </div>
    </div>
</div>
</div>
@endsection
