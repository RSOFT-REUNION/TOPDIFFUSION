@extends('layouts.frontend')

@section('content')
    <div id="PaylineWidget"
         data-token="the token obtained in doWebPayment Response"
         data-template="tab"
         data-embeddedredirectionallowed="false"
    />
@endsection
