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
        <div class="container-fluid mt-5">
            <div class="row">
                <!-- Kolom kiri dengan border putih di kanan -->
                <div class="col-6 border-end border-white">
                    <div class="row">
                        <!-- Gambar utama -->
                        <div class="col-12">
                            <img id="mainImage" src="carousel-1.jpg" alt="" class="img-fluid w-100" />
                        </div>
                        <!-- Gambar thumbnail -->
                        <div class="col-12 mt-2">
                            <div class="row">
                                <div class="col-3">
                                    <img src="carousel-1.jpg" alt="" class="img-fluid w-100 thumbnail" />
                                </div>
                                <div class="col-3">
                                    <img src="carousel-2.jpg" alt="" class="img-fluid w-100 thumbnail" />
                                </div>
                                <div class="col-3">
                                    <img src="carousel-2.jpg" alt="" class="img-fluid w-100 thumbnail" />
                                </div>
                                <div class="col-3">
                                    <img src="carousel-2.jpg" alt="" class="img-fluid w-100 thumbnail" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kolom kanan -->
                <div class="col-5 ms-1">
                    <div class="row">
                        <div class="col mt-3">
                            <h4 class="text-white">{{ $ticket->event->title ?? 'No Event' }}</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col-4 mt-5 d-flex">
                                    <div><i class="fa-solid fa-calendar-days text-white"></i></div>
                                    <div class="text-white ms-2">
                                        {{ $ticket->event->event_date->format('d F, Y') ?? 'Unknown Date' }}</div>
                                </div>
                                <div class="col-5 mt-5 d-flex">
                                    <div><i class="fa-solid fa-location-dot text-white"></i></div>
                                    <div class="text-white ms-2">{{ $ticket->event->event_date }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('order.store') }}
            " method="post">
                        @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        @if ($ticket)
                        <div class="row mt-5">
                            @foreach ($ticketClasses as $t)
                            <div class="col-3">
                                <div class="btn-group d-flex">
                                    <input type="radio" class="btn-check ticket-option" name="ticket_id"
                                        id="option{{ $loop->index }}" value="{{ $t->id }}"
                                        data-class="{{ isset($t->ticket_class) ? $t->ticket_class : '' }}" data-price="
                                        {{ $t->price }}" {{ $loop->first ? 'checked' : '' }} />
                                    <label class="btn btn-outline-light btn-sm w-100 fw-bold"
                                        for="option{{ $loop->index }}">{{ $t->ticket_class }} (Rp
                                        {{ number_format($t->price, 0, ',', '.') }})</label>
                                </div>
                            </div>
                            @endforeach


                        </div>
                        @else
                        <div class="alert alert-warning text-center text-dark">Tiket tidak ditemukan.</div>
                        @endif
                        @csrf


                        <input type="hidden" name="ticket_class" id="hiddenTicketClass" value="">

                        <!-- Informasi Pembeli -->
                        <input type="hidden" name="buyer_name" class="form-control" value="{{ Auth::user()->name }}"
                            readonly>
                        <!-- <p class="text-white">Selected Ticket ID: <span id="ticketIdDisplay">-</span></p> -->
                        <input type="hidden" name="email" class="form-control" value="{{ Auth::user()->email }}"
                            readonly>

                        <!-- Quantity -->
                        <div class="row mt-3">
                            <div class="col-4">
                                <label for="quantity" class="form-label text-white">Quantity</label>
                                <div class="input-group">
                                    <button class="btn btn-outline-secondary" type="button" id="btnMinus">−</button>
                                    <input type="number" name="quantity" class="form-control text-center" id="quantity"
                                        value="1" min="1" readonly />
                                    <button class="btn btn-outline-secondary" type="button" id="btnPlus">+</button>
                                </div>
                            </div>
                        </div>

                        <!-- Total Harga -->
                        <div class="row mt-3">
                            <div class="col-3">
                                <label for="totalPrice" class="form-label text-white">Total Harga</label>
                                <input type="text" id="totalPrice" name="total_price" class="form-control text-center"
                                    value=" 0" readonly />
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-3">
                                <button type="submit" class="btn btn-primary w-100"><i
                                        class="fa-solid fa-cart-shopping"></i> Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <!-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        const ticketOptions = document.querySelectorAll(".ticket-option");
        const ticketIdDisplay = document.getElementById("ticketIdDisplay");

        function updateTicketId() {
            const selectedTicket = document.querySelector(".ticket-option:checked");
            if (selectedTicket) {
                ticketIdDisplay.textContent = selectedTicket.value; // Tampilkan ticket_id
            } else {
                ticketIdDisplay.textContent = "None"; // Debugging jika tetap kosong
            }
        }

        // Jalankan saat halaman selesai dimuat
        setTimeout(updateTicketId, 200);

        // Jalankan saat radio button berubah
        ticketOptions.forEach(option => {
            option.addEventListener("change", updateTicketId);
        });
    });
    </script> -->
</body>


</html>