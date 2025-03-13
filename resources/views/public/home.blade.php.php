<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script src="{{ asset('script.js') }}" defer></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid px-5">
                <a class="navbar-brand" href="#">Event</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">All Event</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container mt-5">
        <h2 class="text-center mb-4">Event Terbaru</h2>
        <div class="row">
            @foreach($events as $event)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top" alt="{{ $event->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $event->title }}</h5>
                        <p class="card-text">{{ $event->date }} - {{ $event->location }}</p>
                        <a href="#" class="btn btn-primary">Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <h2 class="text-center mt-5">Gallery</h2>
        <div class="row">
            @foreach($eventGallery as $gallery)
            <div class="col-md-3">
                <img src="{{ asset('storage/' . $gallery->image) }}" class="img-fluid rounded mb-3">
            </div>
            @endforeach
        </div>

        <h2 class="text-center mt-5">Tickets</h2>
        <ul class="list-group">
            @foreach($tickets as $ticket)
            <li class="list-group-item">
                {{ $ticket->name }} - Rp{{ number_format($ticket->price, 0, ',', '.') }}
            </li>
            @endforeach
        </ul>
    </main>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        &copy; {{ date('Y') }} Event Organizer. All Rights Reserved.
    </footer>
</body>

</html>