@extends('user.layout.master')

@section('content')
<main class="app-main">
    <div class="container-fluid mt-5 text-black">
        <div class="row">
            <!-- Kolom kiri dengan border putih di kanan -->
            <div class="col-6 border-end border-black">
                <div class="row">
                    <!-- Gambar utama -->
                    <div class="col-12">
                        @if($ticket->event && $ticket->event->galleries->isNotEmpty())
                        <img id="mainImage"
                            src="{{ asset('storage/' . $ticket->event->galleries->first()->image_url) }}" alt=""
                            class="img-fluid w-100" />
                        @else
                        <img id="mainImage" src="{{ asset('default-image.jpg') }}" alt="Default Image"
                            class="img-fluid w-100" />
                        @endif
                    </div>

                    <div class="col-12 mt-2">
                        <div class="row g-1">
                            @if($ticket->event && $ticket->event->galleries->isNotEmpty())
                            @foreach($ticket->event->galleries as $gallery)
                            <div class="col-3">
                                <img src="{{ asset('storage/' . $gallery->image_url) }}" alt=""
                                    class="img-fluid w-100 thumbnail" onclick="changeMainImage(this)" />
                            </div>
                            @endforeach
                            @else
                            <div class="col-3">
                                <img src="{{ asset('default-image.jpg') }}" alt="Default Image"
                                    class="img-fluid w-100 thumbnail" />
                            </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

            <!-- Kolom kanan -->
            <div class="col-5 ms-1">
                <div class="row">
                    <div class="col mt-3">
                        <h3 class="fw-bold">{{ $ticket->event->title ?? 'No Event' }}</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col-4 mt-5 d-flex">
                                <div><i class="fa-solid fa-calendar-days text-white"></i></div>
                                <div class=" ms-2">
                                    {{ $ticket->event->event_date->format('d F, Y') ?? 'Unknown Date' }}</div>
                            </div>
                            <div class="col-5 mt-5 d-flex">
                                <div><i class="fa-solid fa-location-dot text-white"></i></div>
                                <div class=" ms-2">{{ $ticket->event->event_date }}</div>
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
                    <input type="hidden" name="email" class="form-control" value="{{ Auth::user()->email }}" readonly>

                    <!-- Quantity -->
                    <div class="row mt-3">
                        <div class="col-4">
                            <label for="quantity" class="form-label ">Quantity</label>
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
                            <label for="totalPrice" class="form-label ">Total Harga</label>
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
    <script>
    function changeMainImage(element) {
        document.getElementById("mainImage").src = element.src;
    }
    </script>
</main>
@endsection