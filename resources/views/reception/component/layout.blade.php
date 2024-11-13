<!DOCTYPE html>
<html lang="en">
    <head>
        @include('reception.component.head')
    </head>
    <body>
        <div id="wrapper">
            <div id="page-wrapper" class="gray-bg">
                @include('reception.component.nav')
                @yield('content')
                @include('reception.component.footer')
            </div>
        </div>
        @include('reception.component.script')
    </body>
</html>