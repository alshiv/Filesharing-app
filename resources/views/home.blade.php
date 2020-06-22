@extends('layouts.app')

@section('content')
<file-sharing :auth_user="{{Auth::user()}}"></file-sharing>
@endsection
