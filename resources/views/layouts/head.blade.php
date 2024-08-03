<!-- Title -->
<title>@yield("title")</title>

<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon" />

<!-- Font -->
<link rel="stylesheet"
href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

<link href="{{ asset('css/wizard.css') }}" rel="stylesheet" id="bootstrap-css">


@yield('css')
<!--- Style css -->
<!--- Style css -->
@if (App::getLocale() == 'en')
<link href="{{ asset('assets/css/ltr.css') }}" rel="stylesheet">
@else
<link href="{{ asset('assets/css/rtl.css') }}" rel="stylesheet">
@endif
{{-- <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script> --}}
<link rel="stylesheet" href="{{ asset('assets/dropzonejs/min/dropzone.min.css') }}">
<script src="{{ asset('assets/dropzone.min.js') }}"></script>
