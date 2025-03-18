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
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="script.js" defer></script>
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
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="background-color: rgb(84, 84, 84)">
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
                            <h4 class="text-white">Lorem ipsum odor amet, consectetuer adipiscing elit.</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col-4 mt-5 d-flex">
                                    <div><i class="fa-solid fa-calendar-days text-white"></i></div>
                                    <div class="text-white ms-2">15 Maret 2025</div>
                                </div>
                                <div class="col-3 mt-5 d-flex">
                                    <div><i class="fa-solid fa-location-dot text-white"></i></div>
                                    <div class="text-white ms-2">UGM</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="
            ">
                        <div class="row mt-5">
                            <div class="col-3">
                                <div class="btn-group d-flex">
                                    <input type="radio" class="btn-check" name="options" id="option1" autocomplete="off"
                                        checked />
                                    <label class="btn btn-outline-light btn-sm w-100 fw-bold"
                                        for="option1">Reguler</label>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="btn-group d-flex">
                                    <input type="radio" class="btn-check" name="options" id="option2"
                                        autocomplete="off" />
                                    <label class="btn btn-outline-light btn-sm w-100 fw-bold" for="option2">VIP</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-4">
                                <label for="quantity" class="form-label text-white">Quantity</label>
                                <div class="input-group">
                                    <button class="btn btn-outline-secondary" type="button" id="btnMinus">−</button>
                                    <input type="text" class="form-control text-center" id="quantity" value="1"
                                        min="1" />
                                    <button class="btn btn-outline-secondary" type="button" id="btnPlus">+</button>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-3">
                                <label for="totalPrice" class="form-label text-white">Total Harga</label>
                                <input type="text" id="totalPrice" class="form-control text-center" value="10000"
                                    readonly />
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
</body>
<script>
// Ambil semua thumbnail
const thumbnails = document.querySelectorAll(".thumbnail");
const mainImage = document.getElementById("mainImage");

// Tambahkan event listener ke setiap thumbnail
thumbnails.forEach((thumb) => {
    thumb.addEventListener("click", function() {
        // Ganti src gambar utama dengan src thumbnail yang diklik
        mainImage.src = this.src;
    });
});

const pricePerItem = 10000; // Harga satuan
const quantityInput = document.getElementById("quantity");
const totalPriceInput = document.getElementById("totalPrice");

function formatRupiah(amount) {
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        minimumFractionDigits: 0,
    }).format(amount);
}

function updateTotal() {
    totalPriceInput.value = formatRupiah(quantityInput.value * pricePerItem);
}

document.getElementById("btnMinus").addEventListener("click", function() {
    if (quantityInput.value > 1) {
        quantityInput.value--;
        updateTotal();
    }
});

document.getElementById("btnPlus").addEventListener("click", function() {
    quantityInput.value++;
    updateTotal();
});

quantityInput.addEventListener("input", function() {
    if (quantityInput.value < 1) {
        quantityInput.value = 1;
    }
    updateTotal();
});

// Set harga awal
document.getElementById("price").value = formatRupiah(pricePerItem);
updateTotal();
</script>

</html>