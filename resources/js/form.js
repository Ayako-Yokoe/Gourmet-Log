// $(document).ready(function () {
//     // Submit form
//     $("#form").submit(function (e) {
//         e.preventDefault();

//         let formData = $(this).serialize();

//         $.post("/restaurants/confirm", formData, function (response) {
//             $("body").html(response);
//             window.location.href = "/restaurants/confirm";
//         });
//     });

//     // Handle Edit Button
//     $(document).on("click", "#editButton", function () {
//         window.location.href = "/";
//     });
// });
