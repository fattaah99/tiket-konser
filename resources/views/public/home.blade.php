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
        <div class="container-fluid">
            <div class="row bg-black py-2">
                <div class="col-6 mt-2">
                    <div class="row px-5">
                        <div class="col-3 text-center">Sosial Media</div>
                        <div class="col-3">
                            <a href=""><i class="fa-brands fa-square-instagram fa-xl"></i></a> <a href=""><i
                                    class="fa-brands fa-square-facebook fa-xl"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-6 d-flex justify-content-center">
                    <form>
                        <input class="form-control form-control-sm w-100 rounded-pill me-2 fs-15" type="search"
                            placeholder="Search" aria-label="Search" />
                    </form>
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
                            <!-- Tambahkan mx-2 -->
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
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
        <div id="carouselExampleCaptions" class="carousel slide carousel-fade mb-5" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="carousel-1.jpg" class="d-block w-100" alt="..." />
                    <div class="carousel-caption d-none d-md-block">
                        <h5>First slide label</h5>
                        <p>Some representative placeholder content for the first slide.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="carousel-2.jpg" class="d-block w-100" alt="..." />
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Second slide label</h5>
                        <p>Some representative placeholder content for the second slide.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="carousel-1.jpg" class="d-block w-100" alt="..." />
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Third slide label</h5>
                        <p>Some representative placeholder content for the third slide.</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="container-fluid special-event-section mb-5">
            <div class="row mb-4">
                <div class="col-sm-12 mb-3 d-flex align-items-center justify-content-center">
                    <hr class="custom-line flex-grow-1 me-3" />
                    <h3 class="mb-0 text-center text-white">Special Event</h3>
                    <hr class="custom-line flex-grow-1 ms-3" />
                </div>
            </div>
            <div class="container d-flex justify-content-center">
                <div class="row px-3 flex-wrap align-items-center justify-content-center"
                    style="border-radius: 10px; background-color: #111; max-width: 100%; width: 60%">
                    <div class="col-12 col-md-6 d-flex justify-content-center">
                        <!-- JavaScript Manual Carousel -->
                        <div class="carousel manual-carousel">
                            <div class="carousel-inner-manual">
                                <img src="carousel-1.jpg" alt="Image 1" />
                                <img src="carousel-2.jpg" alt="Image 2" />

                            </div>
                        </div>
                    </div>
                    <div
                        class="col-12 col-md-6 d-flex flex-column justify-content-center text-center text-md-start mt-4 mt-md-0">
                        <div>
                            <h4>Lorem, ipsum dolor.</h4>
                            <p class="pt-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Blanditiis, aut
                                maiores earum explicabo deleniti alias nihil architecto sit aliquam ut.</p>
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
                    <h3 class="mb-0 text-center">Event Terbaru</h3>
                    <hr class="custom-line flex-grow-1 ms-3" />
                </div>
            </div>
            <div class="row g-0 d-flex justify-content-center flex-wrap">
                @foreach($events->take(3) as $event)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 px-0 d-flex justify-content-center mb-4">
                    <div class="card">
                        @if($event->galleries->isNotEmpty())
                        <img src="{{ asset('storage/' . $event->galleries->first()->image_url) }}" class="card-img-top"
                            alt="{{ $event->title }}" />
                        @else
                        <img src="{{ asset('default-image.jpg') }}" class="card-img-top" alt="Default Image" />
                        @endif
                        <div class="card-content">
                            <h2 class="text-white">{{ $event->title }}</h2>
                            <p>
                                {{ $event->event_date->format('d F, Y') }}
                            </p>
                            <a href="{{ route('event.detail', $event->id) }}" class="btn">Go somewhere</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>


            <!-- <div class="container mt-3">
          <div class="d-flex justify-content-end">
            <a href="#" class="btn btn-primary">More event</a>
          </div>
        </div> -->
        </div>
        <div class="container mt-5">
            <div class="gallery-container">
                <div class="gallery d-flex">
                    <img src="carousel-1.jpg" alt="Gambar 1" />
                    <img src="carousel-2.jpg" alt="Gambar 2" />
                    <img src="carousel-1.jpg" alt="Gambar 3" />
                    <img src="carousel-2.jpg" alt="Gambar 4" />
                    <img src="carousel-1.jpg" alt="Gambar 5" />
                    <img src="carousel-1.jpg" alt="Gambar 6" />
                    <img src="carousel-2.jpg" alt="Gambar 7" />
                    <img src="carousel-1.jpg" alt="Gambar 8" />
                    <img src="carousel-2.jpg" alt="Gambar 9" />
                    <img src="carousel-1.jpg" alt="Gambar 10" />
                    <img src="carousel-2.jpg" alt="Gambar 11" />
                    <img src="carousel-1.jpg" alt="Gambar 12" />
                </div>
            </div>
        </div>
    </main>
</body>

</html>