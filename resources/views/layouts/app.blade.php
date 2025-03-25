@include('components.head')
@include('components.header', ['user' => auth()->user()])
{{ $slot }}
@include('components.footer')
