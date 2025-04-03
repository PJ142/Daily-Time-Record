$(document).ready(function () {
    $(document).on("click", ".delete-btn", function (e) {
        e.preventDefault(); // Stop default behavior (navigation)

        var link = $(this).attr("href");

        Swal.fire({
            title: "Are you sure?",
            text: "Delete This Data?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link; // Redirect if confirmed
            }
        });
    });
});
