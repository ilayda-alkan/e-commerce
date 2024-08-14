
                 @include('layouts.sidebar')
                @include('layouts.header')
                <section class="content">
                    <div class="container-fluid">
                      @yield('content')
                    </div>
                  </section>
            @include('layouts.footer')

       