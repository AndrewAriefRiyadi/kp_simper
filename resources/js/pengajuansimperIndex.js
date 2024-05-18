$(() => {
    const drawer = $("#drawer")
        .dxDrawer({
            // Opsi-opsi lain untuk drawer
        })
        .dxDrawer("instance");

    $.ajax({
        url: "/pengajuansimperAPI", // Sesuaikan dengan path yang benar
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
                    "diterima_tgl",
                    "perihal",
                    {
                        dataField: "id_jenis_pengajuan",
                        caption: "Jenis",
                        alignment: 'left',
                        cellTemplate: function (container, options) {
                            // Mendapatkan nilai id_jenis_pengajuan
                            var avpStatusId = options.data.id_jenis_pengajuan;
                            var statusText = "";
                            switch (avpStatusId) {
                                case 1:
                                    statusText = "Pembuatan";
                                    break;
                                case 2:
                                    
                                    statusText = "Pembaruan";
                                    break;
                            }
                            // Menampilkan teks status dalam cell
                            $(container).text(statusText);
                        },
                    },
                    "nama",
                    "dari",
                    "keterangan",
                    {
                        dataField: "status_avp",
                        caption: "Status AVP",
                        cellTemplate: function (container, options) {
                            // Mendapatkan nilai status_avp
                            var avpStatusId = options.data.status_avp;
                            var backgroundColorClass = "";
                            var statusText = "";
                            switch (avpStatusId) {
                                case 1:
                                    backgroundColorClass = "bg-green-500"; // Approved
                                    statusText = "Approved";
                                    break;
                                case 2:
                                    backgroundColorClass = "bg-yellow-500"; // Revise
                                    statusText = "Revise";
                                    break;
                                case 3:
                                    backgroundColorClass = "bg-red-500"; // Reject
                                    statusText = "Reject";
                                    break;
                                default:
                                    backgroundColorClass = "bg-gray-400"; // Default jika tidak sesuai
                                    statusText = "Review";
                                    break;
                            }

                            // Menetapkan kelas warna ke dalam elemen container
                            $(container).addClass(backgroundColorClass);
                            // Menampilkan teks status dalam cell
                            $(container).text(statusText);
                        },
                    },
                    {
                        dataField: "status_vp",
                        caption: "Status VP",
                        cellTemplate: function (container, options) {
                            // Mendapatkan nilai status_avp
                            var vpStatusId = options.data.status_vp;
                            var backgroundColorClass = "";
                            var statusText = "";
                            switch (vpStatusId) {
                                case 1:
                                    backgroundColorClass = "bg-green-500"; // Approved
                                    statusText = "Approved";
                                    break;
                                case 2:
                                    backgroundColorClass = "bg-yellow-500"; // Revise
                                    statusText = "Revise";
                                    break;
                                case 3:
                                    backgroundColorClass = "bg-red-500"; // Reject
                                    statusText = "Reject";
                                    break;
                                default:
                                    backgroundColorClass = "bg-gray-400"; // Default jika tidak sesuai
                                    statusText = "Review";
                                    break;
                            }

                            // Menetapkan kelas warna ke dalam elemen container
                            $(container).addClass(backgroundColorClass);
                            // Menampilkan teks status dalam cell
                            $(container).text(statusText);
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
                                    window.location.href = `/pengajuansimper/${id}`;
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
