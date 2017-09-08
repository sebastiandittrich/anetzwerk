<html>
    <head>
        @include('layout.includes')
        <script src="http://ricostacruz.com/jquery.transit/jquery.transit.min.js"></script>
        <style>
            #vue {
                transition: filter 1000ms
            }
            .changing {
                filter: blur(20px);
            }
            #profile-background.a-ctive {
                filter: blur(40px);
                opacity: 1.0!important;
            }
        </style>
    </head>
    <body style="background: linear-gradient(45deg, #000BA5 0%, #7781FF 100% );">
        <div id="profile-background" style="
            position: fixed;
            z-index: 0;
            left: -20%;
            top: -20%;
            width: 140%;
            height: 140%;
            transition: background, filter, opacity 2500ms cubic-bezier(0.23,1,0.32,1);
            opacity: 0.0;
        "></div>    
        <div style="
            display: flex;
            justify-content: center;
            align-items: center;
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background: rgba(0,0,0,0)" class="full-screen-message">
            @yield('content')
        </div>
    </body>
</html>