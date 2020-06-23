@extends('layouts.app')

@section('content')
<file-sharing :auth-user="{{Auth::user()}}"></file-sharing>
@endsection
