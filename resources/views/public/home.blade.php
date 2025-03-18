<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="{{ asset('css/style_index.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="{{ asset('js/js_index.js') }}" defer></script>
</head>

<body>
    <header>
        <!-- @if(Auth::check())
        <p>Login sebagai: {{ Auth::user()->name }}</p>
        @else
        <p>Belum login</p>
        @endif -->

        <div class="container-fluid">
            <div class="row bg-black py-2">
                <div class="col-6 mt-2">
                    <div class="row px-5">
                        <div class="col-3 text-center text-white">Sosial Media</div>
                        <div class="col-3">
                            <a href="#"><i class="fa-brands fa-square-instagram fa-xl text-white"></i></a>
                            <a href="#"><i class="fa-brands fa-square-facebook fa-xl text-white ms-2"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-6 d-flex justify-content-end align-items-center pe-5">
                    <form class="me-3">
                        <input class="form-control form-control-sm w-100 rounded-pill fs-15" type="search"
                            placeholder="Search" aria-label="Search" />
                    </form>

                    <!-- Cek apakah user sudah login -->
                    @if(Auth::check())
                    <div class="dropdown">
                        <button class="btn btn-primary btn-sm rounded-pill dropdown-toggle" type="button"
                            id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="userDropdown">

                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    @else
                    <a href="{{ route('login') }}" class="btn btn-primary btn-sm rounded-pill">Login</a>
                    @endif
                </div>
            </div>
        </div>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid px-5">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto">
                        <li class="nav-item mx-3">
                            <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link" href="#">All event</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>


    <main>
        @php
        // Acak data gallery dan ambil 3 gambar pertama
        $shuffledGallery = $eventGallery->shuffle()->take(3);
        @endphp

        <div id="eventCarousel" class="carousel slide" data-bs-ride="carousel">
            <!-- Indikator (bullets) -->
            <div class="carousel-indicators">
                @foreach($shuffledGallery as $key => $gallery)
                <button type="button" data-bs-target="#eventCarousel" data-bs-slide-to="{{ $key }}"
                    class="{{ $key == 0 ? 'active' : '' }}" aria-current="true"
                    aria-label="Slide {{ $key + 1 }}"></button>
                @endforeach
            </div>

            <!-- Gambar Carousel -->
            <div class="carousel-inner">
                @foreach($shuffledGallery as $key => $gallery)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <img src="{{ asset('storage/' . $gallery->image_url) }}" class="d-block w-100" alt="Event Image">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 class="text-white">{{ $gallery->event->title }}</h5>
                        <p class="text-white">{{ Str::limit($gallery->event->description, 100, '...') }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Tombol Navigasi -->
            <button class="carousel-control-prev" type="button" data-bs-target="#eventCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#eventCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>




        <div class="container-fluid ticket-section mb-5">
            <div class="row mb-4">
                <div class="col-sm-12 mb-3 d-flex align-items-center justify-content-center">
                    <hr class="custom-line flex-grow-1 me-3" />
                    <h3 class="mb-0 text-center">Tiket Terbaru</h3>
                    <hr class="custom-line flex-grow-1 ms-3" />
                </div>
            </div>
            <div class="row g-0 d-flex justify-content-center flex-wrap">
                @foreach($tickets->take(3) as $ticket)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 px-0 d-flex justify-content-center mb-4">
                    <div class="card">
                        @if($ticket->event && $ticket->event->galleries->isNotEmpty())
                        <img src="{{ asset('storage/' . $ticket->event->galleries->first()->image_url) }}"
                            class="card-img-top" alt="{{ $ticket->event->title }}" />
                        @else
                        <img src="{{ asset('default-image.jpg') }}" class="card-img-top" alt="Default Image" />
                        @endif
                        <div class="card-content">
                            <h2 class="text-white">{{ $ticket->event->title ?? 'No Event' }}</h2>
                            <p>
                                {{ $ticket->event->event_date->format('d F, Y') ?? 'Unknown Date' }}
                            </p>
                            <p>Price: Rp {{ number_format($ticket->price, 0, ',', '.') }}</p>

                            @if(isset($ticket))
                            <a href="{{ route('public.ticket-detail', $ticket->id) }}" class="btn">Buy</a>
                            @endif



                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        @php
        // Ambil 3 gambar secara acak dari gallery
        $shuffledGallery = $eventGallery->shuffle()->take(3);
        @endphp

        <div class="container mt-5">
            <div class="gallery-container">
                <div class="gallery d-flex">
                    @foreach($shuffledGallery as $gallery)
                    <img src="{{ asset('storage/' . $gallery->image_url) }}" alt="{{ $gallery->event->title }}"
                        class="img-fluid" />
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Modal Popup -->
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="loginModalLabel">Anda Belum Login</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Silakan login terlebih dahulu untuk membeli tiket.</p>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('login') }}" class="btn btn-primary=">Login</a>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

    </main>

</body>

</html>