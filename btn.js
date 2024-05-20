document.addEventListener("DOMContentLoaded", function () {
    var editButtons = document.querySelectorAll(".btn-edit");

    editButtons.forEach(function (button) {
        button.addEventListener("click", function (event) {
            event.preventDefault();

            var id = button.getAttribute("data-id");
            
            // Munculkan konfirmasi
            var confirmEdit = confirm("Apakah Anda ingin mengedit data?");

            // Jika pengguna menekan "OK", arahkan ke halaman edit.php dengan parameter id
            if (confirmEdit) {
                window.location.href = 'edit.php?edit=' + id;
            }
        });
    });
});

document.addEventListener('click', function(e) {
  if (e.target && e.target.classList.contains('btn-delete')) {
     e.preventDefault();
     var confirmation = confirm('Apakah Anda yakin ingin menghapus produk ini?');
     if (confirmation) {
        var productId = e.target.getAttribute('data-id');
        window.location.href = 'index.php?delete=' + productId;
     }
  }
});