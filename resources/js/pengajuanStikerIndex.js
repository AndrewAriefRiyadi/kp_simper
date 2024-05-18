$(() => {
    const drawer = $("#drawer").dxDrawer({
        // Opsi-opsi lain untuk drawer
    }).dxDrawer("instance");

    $.ajax({
        url: "/pengajuanStikerAPI", // Sesuaikan dengan path yang benar
        dataType: "json",
        success: function (data) {
            // Data JSON berhasil diambil
            console.log("Data JSON:", data);

            // Inisialisasi grid dengan data yang diperoleh
            $("#gridContainer").dxDataGrid({
                dataSource: data,
                columnAutoWidth: true,
                columns: [
                    "id",
                    "nama",
                    "diterima_tgl",
                    "dari",
                    "perihal",
                    "no_surat",
                    "no_agenda",
                    "keterangan",
                    {
                        dataField: "status_avp",
                        caption: "Status AVP",
                        cellTemplate: function (container, options) {
                            // Mendapatkan nilai status_avp
                            var avpStatusId = options.data.status_avp;
                            var backgroundColorClass = "";
                            switch (avpStatusId) {
                                case 1:
                                    backgroundColorClass = "bg-green-500"; // Approved
                                    break;
                                case 2:
                                    backgroundColorClass = "bg-yellow-500"; // Revise
                                    break;
                                case 3:
                                    backgroundColorClass = "bg-red-500"; // Reject
                                    break;
                                default:
                                    backgroundColorClass = "bg-gray-400"; // Default jika tidak sesuai
                                    break;
                            }

                            // Menetapkan kelas warna ke dalam elemen container
                            $(container).addClass(backgroundColorClass);
                            // Memanggil API untuk mendapatkan status berdasarkan ID
                            $.ajax({
                                url: `api/vl_status/${avpStatusId}`,
                                dataType: "text",
                                success: function (statusData) {
                                    // Menampilkan teks status dalam cell
                                    console.log(statusData);
                                    $(container).text(statusData);
                                },
                                error: function (error) {
                                    console.error("Error:", error);
                                },
                            });
                        },
                    },
                    {
                        dataField: "status_vp",
                        caption: "Status VP",
                        cellTemplate: function (container, options) {
                            // Mendapatkan nilai status_avp
                            var vpStatusId = options.data.status_vp;
                            var backgroundColorClass = "";
                            switch (vpStatusId) {
                                case 1:
                                    backgroundColorClass = "bg-green-500"; // Approved
                                    break;
                                case 2:
                                    backgroundColorClass = "bg-yellow-500"; // Revise
                                    break;
                                case 3:
                                    backgroundColorClass = "bg-red-500"; // Reject
                                    break;
                                default:
                                    backgroundColorClass = "bg-gray-400"; // Default jika tidak sesuai
                                    break;
                            }

                            // Menetapkan kelas warna ke dalam elemen container
                            $(container).addClass(backgroundColorClass);
                            // Memanggil API untuk mendapatkan status berdasarkan ID
                            $.ajax({
                                url: `api/vl_status/${vpStatusId}`,
                                dataType: "text",
                                success: function (statusData) {
                                    // Menampilkan teks status dalam cell
                                    console.log(statusData);
                                    $(container).text(statusData);
                                },
                                error: function (error) {
                                    console.error("Error:", error);
                                },
                            });
                        },
                    },
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
                                    window.location.href = `/pengajuanstiker/${id}`;
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
