@include('components.Headadmin')
@include('components.HeaderAdmin')
@include('components.sidebar')
<main id="main" class="main">
{{ $slot }}
</main>
@include('components.FooterAdmin')
