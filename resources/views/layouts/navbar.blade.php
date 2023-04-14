        <header class="market-header header">

            <div class="container-fluid">
                <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand" href="{{route('posts.home')}}"><img src="{{asset('images/version/market-logo.png')}}" alt=""></a>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('posts.home')}}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('categories.single', ['slug' => 'marketing']) }}">Marketing</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('categories.single', ['slug' => 'make-money']) }}">Make Money</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('categories.single', ['slug' => 'seo-service']) }}">SEO Service</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('categories.single', ['slug' => 'digital-agency']) }}">Digital Agency</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('categories.single', ['slug' => 'blogging']) }}">Blogging</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('categories.single', ['slug' => 'entertaintment']) }}">Entertaintment</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('categories.single', ['slug' => 'video-tuts']) }}">Video Tuts</a>
                            </li>
                        </ul>
                        <form class="form-inline" method="get" action="{{route('search')}}">
                            <input class="form-control mr-sm-2" type="text" placeholder="How may I help?" name="s" required >
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>
                    </div>
                </nav>
            </div><!-- end container-fluid -->
        </header><!-- end market-header -->
