@extends('user.layout.master')

@section('content')
<main class="app-main" style="background-color: #787878;">
    <div class="container-fluid event-section mb-2">
        <div class="row mb-5">
            <div class="col-sm-12 d-flex justify-content-end gap-3">
                <input type="text" id="searchBox" class="form-control" style="max-width: 300px;" placeholder="Search..."
                    onkeyup="filterCards()">
            </div>
        </div>
        <div class="row g-0 d-flex justify-content-center flex-wrap">

            @foreach($tickets as $ticket)
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
                        <p>{{ optional($ticket->event->event_date)->format('d F, Y') ?? 'Unknown Date' }}</p>
                        <p>{{ $ticket->ticket_class }}</p>
                        <p>Price: Rp {{ number_format($ticket->price, 0, ',', '.') }}</p>
                        @if(isset($ticket))
                        @if(Auth::check())
                        <a href="{{ route('public.ticket-detail', $ticket->id) }}" class="btn btn-primary">Buy</a>
                        @else
                        <button type="button" class="btn btn-primary" onclick="showLoginModal()">Buy</button>
                        @endif
                        @endif

                        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-black" id="loginModalLabel">Login Required</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-black">
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
    <script>
    function filterCards() {
        var input = document.getElementById("searchBox");
        var filter = input.value.toLowerCase();
        var cards = document.querySelectorAll(".col-12.col-sm-6.col-md-4.col-lg-3");

        cards.forEach(function(card) {
            var text = card.textContent.toLowerCase();
            if (text.includes(filter)) {
                card.classList.remove("d-none");
            } else {
                card.classList.add("d-none");
            }
        });
    }
    </script>
</main>

@endsection