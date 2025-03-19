let index = 0;
const carouselInnerManual = document.querySelector(".carousel-inner-manual");

if (carouselInnerManual) {
    const manualSlides = carouselInnerManual.querySelectorAll("img");
    const totalManualSlides = manualSlides.length;

    function nextSlideManual() {
        index = (index + 1) % totalManualSlides;
        carouselInnerManual.style.transform = `translateX(-${index * 100}%)`;
    }

    setInterval(nextSlideManual, 3000);
} else {
    console.error("Element .carousel-inner-manual tidak ditemukan.");
}

document.querySelectorAll(".gallery img").forEach((img) => {
    img.addEventListener("click", function () {
        document
            .querySelectorAll(".gallery img")
            .forEach((img) => img.classList.remove("active"));
        this.classList.add("active");
        this.scrollIntoView({
            behavior: "smooth",
            block: "center",
            inline: "center",
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    let ticketOptions = document.querySelectorAll(".ticket-option");
    let totalPriceInput = document.getElementById("totalPrice");

    ticketOptions.forEach((option) => {
        option.addEventListener("change", function () {
            totalPriceInput.value =
                "Rp " + parseInt(this.value).toLocaleString();
        });
    });
});

//ticket-detail
document.addEventListener("DOMContentLoaded", function () {
    const firstTicket = document.querySelector(".ticket-option");
    if (firstTicket) {
        firstTicket.checked = true; // ✅ Paksa pilih yang pertama
    }
    updateTotalPrice();
});
document.addEventListener("DOMContentLoaded", function () {
    const ticketOptions = document.querySelectorAll(".ticket-option");
    const quantityInput = document.getElementById("quantity");
    const totalPriceInput = document.getElementById("totalPrice");
    const totalPriceHidden = document.createElement("input"); // Buat input hidden
    totalPriceHidden.type = "hidden";
    totalPriceHidden.name = "total_price"; // Nama untuk dikirim ke server
    totalPriceInput.parentNode.appendChild(totalPriceHidden);
    const hiddenTicketClass = document.getElementById("hiddenTicketClass");

    function formatRupiah(angka) {
        return "Rp " + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function updateTicketClass() {
        const selectedTicket = document.querySelector(".ticket-option:checked");
        if (!selectedTicket) {
            hiddenTicketClass.value = "";
            console.log("Ticket class kosong");
            return;
        }
        hiddenTicketClass.value =
            selectedTicket.getAttribute("data-class") || "";
        console.log("Updated ticket_class:", hiddenTicketClass.value);
    }

    function updateTotalPrice() {
        const selectedTicket = document.querySelector(".ticket-option:checked");

        if (!selectedTicket) {
            totalPriceInput.value = "Rp 0";
            totalPriceHidden.value = "0"; // Simpan angka murni untuk dikirim
            return;
        }

        let price = parseFloat(selectedTicket.getAttribute("data-price")) || 0;
        let quantity = parseInt(quantityInput.value) || 1;
        let total = price * quantity;

        totalPriceInput.value = formatRupiah(total); // Format tampilan rupiah
        totalPriceHidden.value = total; // Simpan angka murni untuk dikirim
    }
    updateTicketClass();

    // Event listener
    ticketOptions.forEach((option) =>
        option.addEventListener("change", updateTotalPrice)
    );
    quantityInput.addEventListener("input", updateTotalPrice);

    // Panggil saat pertama kali
    updateTotalPrice();
    // Panggil fungsi saat radio button berubah
    document.querySelectorAll(".ticket-option").forEach((radio) => {
        radio.addEventListener("change", updateTotalPrice);
    });

    // Panggil fungsi saat quantity berubah
    document
        .getElementById("quantity")
        .addEventListener("input", updateTotalPrice);

    // Panggil saat halaman pertama kali dimuat
    document.addEventListener("DOMContentLoaded", updateTotalPrice);

    // Event saat memilih kelas tiket
    ticketOptions.forEach((option) => {
        option.addEventListener("change", updateTotalPrice);
    });

    // Event saat mengubah jumlah tiket
    quantityInput.addEventListener("input", updateTotalPrice);

    // Event untuk tombol tambah dan kurang
    btnPlus.addEventListener("click", function () {
        let currentValue = parseInt(quantityInput.value);
        if (currentValue < 3) {
            // Batasi maksimum ke 3
            quantityInput.value = currentValue + 1;
            updateTotalPrice();
        }
    });

    btnMinus.addEventListener("click", function () {
        quantityInput.value = Math.max(1, parseInt(quantityInput.value) - 1);
        updateTotalPrice();
    });

    // Set harga awal saat halaman dimuat
    updateTotalPrice();

    document.addEventListener("DOMContentLoaded", function () {
        const ticketOptions = document.querySelectorAll(".ticket-option");
        const ticketIdDisplay = document.getElementById("ticketIdDisplay");
        const hiddenTicketId = document.getElementById("hiddenTicketId");

        function updateTicketId() {
            const selectedTicket = document.querySelector(
                ".ticket-option:checked"
            );
            if (selectedTicket) {
                ticketIdDisplay.textContent = selectedTicket.value; // Tampilkan ticket_id
                hiddenTicketId.value = selectedTicket.value; // Simpan ke hidden input
            }
        }

        // Jalankan saat halaman dimuat
        setTimeout(updateTicketId, 100); // Delay sedikit agar elemen siap

        // Update saat radio button berubah
        ticketOptions.forEach((option) => {
            option.addEventListener("change", updateTicketId);
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
        function updateTicketClass() {
            const selectedTicket = document.querySelector(
                ".ticket-option:checked"
            );

            if (!selectedTicket) {
                document.getElementById("hiddenTicketClass").value = ""; // Kosongkan jika tidak ada pilihan
                console.log("Ticket class kosong");
                return;
            }

            let ticketClass = selectedTicket.getAttribute("data-class") || "";
            document.getElementById("hiddenTicketClass").value = ticketClass;
            console.log("Updated ticket_class:", ticketClass);
            console.log("Selected ticket:", selectedTicket);
            console.log(
                "Data-class:",
                selectedTicket?.getAttribute("data-class")
            );
            document.getElementById("hiddenTicketClass").value = ticketClass;
        }

        // Event listener saat opsi tiket berubah
        document.querySelectorAll(".ticket-option").forEach((option) => {
            option.addEventListener("change", function () {
                console.log("Radio button berubah:", this.value);
                updateTicketClass();
            });
        });

        // Panggil saat pertama kali halaman dimuat
        updateTicketClass();

        // Pastikan nilai diperbarui sebelum form dikirim
        document.querySelector("form").addEventListener("submit", function () {
            updateTicketClass();
        });
    });

    // <!-- Midtrans Snap Payment -->
    document.getElementById("pay-button").onclick = function () {
        window.snap.pay("{{ $snapToken }}", {
            onSuccess: function (result) {
                alert("Pembayaran berhasil!");
                window.location.href = "/order-success";
            },
            onPending: function (result) {
                alert("Menunggu pembayaran!");
            },
            onError: function (result) {
                alert("Pembayaran gagal!");
            },
        });
    };
});
