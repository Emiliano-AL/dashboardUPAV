
    @livewireStyles

    @include('layouts.sidebar')
    @include('layouts.header')
    @yield('content')
    @include('layouts.footer')
    @livewireScripts
    @yield('js')
