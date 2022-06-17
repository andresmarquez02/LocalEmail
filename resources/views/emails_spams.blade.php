@extends("layout.app")
@section('content')
    @extends("layout.asideleft")
    @section("contain")
        @livewire("home-component",["action" => "spam"])
    @endsection
@endsection
