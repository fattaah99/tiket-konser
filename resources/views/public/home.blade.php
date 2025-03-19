@extends('user.layout.master')

@section('content')
<main class="app-main">
    <!--begin::App Content Header-->
    @php
    // Acak data gallery dan ambil 3 gambar pertama
    $shuffledGallery = $eventGallery->shuffle()->take(3);
    @endphp

    <div id="eventCarousel" class="carousel slide" data-bs-ride="carousel">
        <!-- Indikator (bullets) -->
        <div class="carousel-indicators">
            @foreach($shuffledGallery as $key => $gallery)
            <button type="button" data-bs-target="#eventCarousel" data-bs-slide-to="{{ $key }}"
                class="{{ $key == 0 ? 'active' : '' }}" aria-current="true" aria-label="Slide {{ $key + 1 }}"></button>
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


    <div class="container-fluid special-event-section mb-5">
        <div class="row mb-2">
            <div class="col-sm-12 mb-3 d-flex align-items-center justify-content-center">
                <hr class="custom-line flex-grow-1 me-3" />
                <h3 class="mb-0 text-center text-black fw-bold">Special Event</h3>
                <hr class="custom-line flex-grow-1 ms-3" />
            </div>
        </div>
        <div class="container d-flex justify-content-center">
            <div class="row px-3 flex-wrap align-items-center justify-content-center"
                style="border-radius: 10px; background-color: #555555; max-width: 100%; width: 60%">
                <div class="col-12 col-md-6 d-flex justify-content-center">
                    <!-- JavaScript Manual Carousel -->
                    <div class="carousel manual-carousel">
                        <div class="carousel-inner-manual">
                            <img src="../../dist/assets/img/carousel-1.jpg" alt="Image 1" />
                            <img src="../../dist/assets/img/carousel-2.jpg" alt="Image 2" />
                            <img src="https://via.placeholder.com/600x300/3357FF/FFFFFF?text=Image+3" alt="Image 3" />
                        </div>
                    </div>
                </div>
                <div
                    class="col-12 col-md-6 d-flex flex-column justify-content-center text-center text-md-start mt-4 mt-md-0">
                    <div>
                        <h4>Lorem, ipsum dolor.</h4>
                        <p class="pt-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Blanditiis,
                            aut maiores earum explicabo deleniti alias nihil architecto sit aliquam ut.</p>
                        <button class="btn btn-primary mb-4">More</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid event-section mb-5">
        <div class="row mb-4">
            <div class="col-sm-12 mb-3 d-flex align-items-center justify-content-center">
                <hr class="custom-line flex-grow-1 me-3" />
                <h3 class="mb-0 text-center text-black fw-bold">Tiket Terbaru</h3>
                <hr class="custom-line flex-grow-1 ms-3" />
            </div>
        </div>
        <div class="row g-0 d-flex justify-content-center flex-wrap">
            @foreach($tickets->take(3) as $ticket)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 px-0 d-flex justify-content-center mb-4">
                <div class="card-home">
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

                        <!-- Tombol Beli -->
                        @if(isset($ticket))
                        @if(Auth::check())
                        <a href="{{ route('public.ticket-detail', $ticket->id) }}" class="btn btn-primary">Buy</a>
                        @else
                        <button type="button" class="btn btn-primary" onclick="showLoginModal()">Buy</button>
                        @endif
                        @endif

                        <!-- Modal Login -->
                        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="loginModalLabel">Login Required</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Anda harus login terlebih dahulu untuk membeli tiket.
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @php
    // Ambil 3 gambar secara acak dari gallery
    $shuffledGallery = $eventGallery->shuffle();
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

</main>
@endsection