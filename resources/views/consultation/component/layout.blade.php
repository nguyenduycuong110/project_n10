<!DOCTYPE html>
<html lang="en">
    <head>
        @include('consultation.component.head')
    </head>
    <body>
        <div id="wrapper">
            <div id="page-wrapper" class="gray-bg">
                @include('consultation.component.nav')
                @yield('content')
                @include('consultation.component.footer')
            </div>
        </div>
        @include('consultation.component.script')
    </body>
</html>