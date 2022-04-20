 <!doctype html>
 <html lang='en'>

 <head>
     <title>@yield('title', 'Parking')</title>
     <meta charset='utf-8'>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
         integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

     <link href='/css/parking.css' type='text/css' rel='stylesheet'>
     @yield('head')
 </head>

 <body>

     @if (session('flash-alert'))
         <div class='flash-alert'>
             {{ session('flash-alert') }}
     @endif

     <header>
         <a href='/'><img src='/images/parking2.png' id='logo' alt='Parking Logo'></a>

         <nav>
             <ul>

                 <li><a href='/'>Home</a></li>

                 @if (Auth::user())
                     <li><a href='/parkings'>All Parkings Occupied</a></li>
                     <li><a href='/parkings/create'>Create a Parking Ticket</a></li>
                     <li><a href='/list'>Your Parking list</a></li>
                 @endif

                 <li><a href='/contact'>Contact</a></li>

                 <li>
                     @if (!Auth::user())
                         <a href='/login'>Login</a>
                     @else
                         <form method='POST' id='logout' action='/logout'>
                             {{ csrf_field() }}
                             <a href='#' onClick='document.getElementById("logout").submit();'>Logout</a>
                         </form>
                     @endif
                 </li>


             </ul>
         </nav>
     </header>


     <section id='main'>
         @yield('content')
     </section>

     <footer>
         &copy; YourParking, Inc.
     </footer>

 </body>

 </html>
