<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\EventGalleryController;
use App\Http\Controllers\Admin\TicketsController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\MidtransController;
use App\Models\Admin;

Route::get('/tickets', [PublicController::class, 'tickets']);
Route::get('/ticket/{id}', [PublicController::class, 'show'])->name('public.ticket-detail');
Route::get('/events', [PublicController::class, 'events']);
Route::get('/event-gallery', [PublicController::class, 'eventGallery']);
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/all-tiket', [PublicController::class, 'allTiket'])->name('all-tiket');
Route::get('/events/{id}', [PublicController::class, 'show'])->name('event.detail');
Route::get('/login', [UserAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserAuthController::class, 'login'])->name('login.post');
Route::post('/logout', [UserAuthController::class, 'logout'])->name('logout');

// Route::get('/order/{id}', [OrderController::class, 'show'])->name('order.show')->middleware('auth');
Route::get('/ticket/print/{id}', [TicketController::class, 'printTicket'])->name('ticket.print');

Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders.myOrders')->middleware('auth');

Route::post('/order', [OrderController::class, 'store'])->name('order.store');
Route::get('/order/success/{id}', [OrderController::class, 'success'])->name('order.success');

Route::get('/register', [UserAuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [UserAuthController::class, 'register'])->name('register.post');



// Route::get('/midtrans/check-status/{orderId}', [MidtransController::class, 'checkPaymentStatus']);


// Route::middleware(['auth'])->group(function () {
//     Route::get('/ticket/{id}', [OrderController::class, 'show']);
//     Route::post('/order', [OrderController::class, 'store']);
// });


Route::prefix('admin')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AuthController::class, 'login'])->name('admin.login.submit');
    
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout');
        Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
        Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
        Route::post('/users/bulk-delete', [UserController::class, 'bulkDelete'])->name('admin.users.bulkDelete');
        Route::get('/events', [EventController::class, 'index'])->name('admin.events.index');
        Route::get('/events/{id}/edit', [EventController::class, 'edit'])->name('admin.events.edit');
        Route::put('/events/{id}', [EventController::class, 'update'])->name('admin.events.update');
        Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('admin.events.destroy');
        Route::post('/events', [EventController::class, 'store'])->name('admin.events.store');
        Route::post('/events/bulk-delete', [EventController::class, 'bulkDelete'])->name('admin.events.bulkDelete');
        Route::get('/event-gallery', [EventGalleryController::class, 'index'])->name('admin.event_gallery.index');
        Route::post('/event-gallery', [EventGalleryController::class, 'store'])->name('admin.event_gallery.store');
        Route::delete('/event-gallery/{gallery}', [EventGalleryController::class, 'destroy'])->name('admin.event_gallery.destroy');
        Route::post('/event-gallery/bulk-delete', [EventGalleryController::class, 'bulkDelete'])->name('admin.gallery.bulkDelete');
        Route::get('/event-gallery/{id}/edit', [EventGalleryController::class, 'edit'])->name('admin.event_gallery.edit');
        Route::put('/event-gallery/{id}', [EventGalleryController::class, 'update'])->name('admin.event_gallery.update');
        Route::get('/tickets', [TicketsController::class, 'index'])->name('admin.tickets.index');
        Route::post('/tickets', [TicketsController::class, 'store'])->name('admin.tickets.store');
        Route::delete('/tickets/{ticket}', [TicketsController::class, 'destroy'])->name('admin.tickets.destroy');
        Route::post('/tickets/bulk-delete', [TicketsController::class, 'bulkDelete'])->name('admin.tickets.bulkDelete');
        Route::get('/tickets/{id}/edit', [TicketsController::class, 'edit'])->name('admin.tickets.edit');
        Route::put('/tickets/{id}', [TicketsController::class, 'update'])->name('admin.tickets.update');
        
        Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
        Route::post('/orders', [AdminOrderController::class, 'store'])->name('admin.orders.store');
        Route::put('/orders/{order}', [AdminOrderController::class, 'update'])->name('admin.orders.update');
        Route::delete('/orders/{order}', [AdminOrderController::class, 'destroy'])->name('admin.orders.destroy');

    });
});