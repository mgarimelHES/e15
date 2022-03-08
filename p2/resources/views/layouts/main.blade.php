 <!doctype html>
 <html lang='en'>

 <head>
     <title>@yield('title')</title>
     <meta charset='utf-8'>
     <link href='/css/parking.css' type='text/css' rel='stylesheet'>
     @yield('head')
 </head>

 <body>

     <header>
         <a href='/'><img src='/images/parking2.png' id='logo' alt='Parking Logo'></a>
     </header>

     <section>
         @yield('content')
     </section>

     <footer>
         &copy; YourParking, Inc.
     </footer>

 </body>

 </html>
