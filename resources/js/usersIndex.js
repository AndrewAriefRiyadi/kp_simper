$(() => {
    const drawer = $("#drawer")
        .dxDrawer({
            // Opsi-opsi lain untuk drawer
        })
        .dxDrawer("instance");

    $.ajax({
        url: "/usersAPI", // Sesuaikan dengan path yang benar
        dataType: "json",
        success: function (data) {
            // Data JSON berhasil diambil
            console.log("Data JSON:", data);

            // Inisialisasi grid dengan data yang diperoleh
            $("#gridContainer").dxDataGrid({
                dataSource: data,
                columnAutoWidth: true,
                columns: [
                    {
                        caption: "No",
                        calculateCellValue: function (rowData) {
                            // Mengambil indeks (urutan) dari data di dalam dataSource
                            return data.indexOf(rowData) + 1;
                        }
                    },
                    "id",
                    "name",
                    "instansi",
                    "email",
                    "no_badge",
                    {
                        caption: "Action",
                        cellTemplate: function (container, options) {
                            $("<a>")
                                .text("Detail")
                                .addClass("dx-link")
                                .on("dxclick", function () {
                                    // Handle klik tombol di sini
                                    // Gantilah '/route-web' dengan route yang sesuai
                                    var id = options.data.id;
                                    window.location.href = `/users/${id}`;
                                })
                                .appendTo(container);
                        },
                    },
                ],
                showBorders: true,
                onContentReady: function (e) {
                    // Callback ini akan dipanggil setelah semua data terload
                    window.updateDrawerHeight(); // Panggil fungsi updateDrawerHeight dari file drawer.js
                },
            });
        },
        error: function (error) {
            console.error("Error:", error);
        },
    });
});
