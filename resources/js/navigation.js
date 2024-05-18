$(() => {
    const drawer = $("#drawer")
        .dxDrawer({
            opened: true,
            height: Math.max($("html").height(), 500),
            closeOnOutsideClick: false,
            template() {
                const $list = $("<div>")
                    .width(300)
                    .addClass("panel-list bg-gray-200");

                // Buat daftar item sesuai peran pengguna
                let dataSource = [
                    { id: 1, text: "SIMPER / SIO", icon: "description" },
                    { id: 2, text: "Stiker", icon: "folder" },
                ];

                // Periksa peran pengguna
                if (userIsAVP || userIsVP) {
                    // Gantilah userHasUserRole dengan logika yang benar untuk memeriksa peran pengguna
                    // Jika pengguna tidak memiliki peran "user", tambahkan item "UJIAN"
                    dataSource.push({
                        id: 3,
                        text: "Ujian",
                        icon: "background",
                    });
                    dataSource.push({
                        id: 4,
                        text: "Users",
                        icon: "group",
                    });
                }
                dataSource.push({
                    id: 5,
                    text: "My Profile",
                    icon: "user",
                });

                return $list.dxList({
                    dataSource: dataSource,
                    hoverStateEnabled: false,
                    focusStateEnabled: false,
                    activeStateEnabled: false,
                    onItemClick(e) {
                        console.log(e.itemData.id);
                        const id = e.itemData.id;
                        if (id === 1) {
                            window.location.href = "/pengajuansimper";
                        } else if (id === 2) {
                            window.location.href = "/pengajuanstiker";
                        } else if (id === 3) {
                            window.location.href = "/ujian";
                        } else if (id === 4) {
                            window.location.href = "/users";
                        } else if (id === 5) {
                            window.location.href = "/users/"+userId;
                        } else {
                            // Logika default
                            window.location.href = `/`;
                        }
                    },
                });
            },
        })
        .dxDrawer("instance");

    $(".dx-list").css("padding-top", "1.5rem");
    $(".dx-list-item").addClass(
        "mb-2 font-semibold font-sans text-md py-2 bg-blue-500 rounded rounded-r-full hover:bg-blue-600 hover:text-orange-300 pl-2"
    );

    $(document).ready(function () {
        const updateDrawerHeight = () => {
            const contentHeight = $("#content").height(); // Gantilah 'content' dengan ID atau selector yang sesuai
            console.log(contentHeight);
            const additionalHeight = 6; // Sesuaikan dengan margin atau padding tambahan yang dibutuhkan
            const theHeight = Math.max(
                $("html").height() + additionalHeight,
                200 + additionalHeight
            ); // Pilih tinggi yang lebih besar dari contentHeight atau 200px

            drawer.option("height", theHeight);
        };

        window.updateDrawerHeight = updateDrawerHeight;

        // Panggil fungsi untuk mengatur tinggi drawer saat window di-resize
        // $(window).on('resize', function() {
        //     updateDrawerHeight();
        // });
    });
    $("#toolbar").dxToolbar({
        elementAttr: {
            class: "dx-theme-background-color",
        },
        items: [
            {
                widget: "dxButton",
                location: "before",
                options: {
                    icon: "menu",
                    stylingMode: "text",
                    onClick() {
                        console.log("Sebelum toggle");
                        drawer.toggle();
                        console.log("Setelah toggle");
                    },
                },
            },
            {
                location: "before",
                template: function () {
                    return "<a href='/' class='font-sans font-bold text-lg'>Pupuk Kaltim Simper</a>";
                },
            },
            {
                location: "after",
                template: function () {
                    return (
                        "<p class='font-sans font-bold text-lg px-2'>" +
                        userName +
                        "</p>"
                    );
                },
            },
            {
                location: "after",
                widget: "dxButton",
                options: {
                    text: "Logout",
                    onClick: function () {
                        // Mendapatkan token CSRF dari elemen meta
                        const csrfToken = $('meta[name="csrf-token"]').attr(
                            "content"
                        );

                        // Mengirim permintaan POST ke rute logout dengan menyertakan token CSRF
                        $.ajax({
                            url: "/logout",
                            type: "POST",
                            headers: {
                                "X-CSRF-TOKEN": csrfToken,
                            },
                            success: function (data) {
                                console.log("Logout successful");
                                window.location.href = "/";
                            },
                            error: function (error) {
                                console.error("Logout error:", error);
                            },
                        });
                    },
                },
            },
        ],
    });

    document.addEventListener("DOMContentLoaded", function () {
        updateDrawerHeight();
    });
});
