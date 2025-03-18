<div class="container mt-4">
    <h2>Ticket Details</h2>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">{{ $ticket->event->title ?? 'No Event' }}</h3>
            <p>Date: {{ $ticket->event->event_date->format('d F, Y') ?? 'Unknown Date' }}</p>
            <p>Ticket Class: {{ $ticket->ticket_class }}</p>
            <p>Price: Rp {{ number_format($ticket->price, 0, ',', '.') }}</p>
            <p>Stock: {{ $ticket->stock }}</p>
        </div>
    </div>
</div>