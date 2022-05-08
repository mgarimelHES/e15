 <!doctype html>
 <html lang='en'>

 <head>
     <title>@yield('title', 'Bookmark')</title>
     <meta charset='utf-8'>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
         integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

     <link href='/css/bookmark.css' type='text/css' rel='stylesheet'>
     @yield('head')
 </head>

 <body>

     @if (session('flash_alert'))
         <div class='flash-alert'>
             {{ session('flash-alert') }}
         </div>
     @endif

     <header>
         <a href='/'><img src='/images/bookmark-logo@2x.png' id='logo' alt='Bookmark Logo'></a>

         <nav>
             <ul>
                 <li><a href='/'>Home</a></li>

                 @if (Auth::user())
                     <li><a href='/books'>All Books</a></li>
                     <li><a href='/books/create'>Add a Book</a></li>
                     <li><a href='/list'>Your list</a></li>
                 @endif

                 <li><a href='/contact'>Contact</a></li>

                 <li>
                     @if (!Auth::user())
                         <a test='login-link' href='/login'>Login</a>
                     @else
                         <form method='POST' id='logout' action='/logout'>
                             {{ csrf_field() }}

                             {{-- Codeception can’t invoke our JavaScript so instead of a link thta acts as a submit button, we'll use a button that's styled like a link to submit this form.
                        <a href='#' onClick='document.getElementById("logout").submit();'>Logout</a> --}}

                             <button type='submit' class='button-link' test='logout-button'>
                                 Logout
                             </button>

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
         &copy; Bookmark, Inc.
         {{ config('mail.contact_email') }}
     </footer>

 </body>

 </html>
