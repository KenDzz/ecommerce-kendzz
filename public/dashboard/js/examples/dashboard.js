$(function () {

    new DataTable("#product-data");

    // Dashboard chart colors
    const body_styles = window.getComputedStyle(document.body);
    const colors = {
        primary: $.trim(body_styles.getPropertyValue('--bs-primary')),
        secondary: $.trim(body_styles.getPropertyValue('--bs-secondary')),
        info: $.trim(body_styles.getPropertyValue('--bs-info')),
        success: $.trim(body_styles.getPropertyValue('--bs-success')),
        danger: $.trim(body_styles.getPropertyValue('--bs-danger')),
        warning: $.trim(body_styles.getPropertyValue('--bs-warning')),
        light: $.trim(body_styles.getPropertyValue('--bs-light')),
        dark: $.trim(body_styles.getPropertyValue('--bs-dark')),
        blue: $.trim(body_styles.getPropertyValue('--bs-blue')),
        indigo: $.trim(body_styles.getPropertyValue('--bs-indigo')),
        purple: $.trim(body_styles.getPropertyValue('--bs-purple')),
        pink: $.trim(body_styles.getPropertyValue('--bs-pink')),
        red: $.trim(body_styles.getPropertyValue('--bs-red')),
        orange: $.trim(body_styles.getPropertyValue('--bs-orange')),
        yellow: $.trim(body_styles.getPropertyValue('--bs-yellow')),
        green: $.trim(body_styles.getPropertyValue('--bs-green')),
        teal: $.trim(body_styles.getPropertyValue('--bs-teal')),
        cyan: $.trim(body_styles.getPropertyValue('--bs-cyan')),
        chartTextColor: $('body').hasClass('dark') ? '#6c6c6c' : '#b8b8b8',
        chartBorderColor: $('body').hasClass('dark') ? '#444444' : '#ededed',
    };

    $(document).on('click', '.select-all', function () {
        const that = $(this),
            target = $(that.data('select-all-target')),
            checkbox = target.find('input[type="checkbox"]');

        if (that.prop('checked')) {
            checkbox.closest('tr').addClass('tr-selected');
            checkbox.prop('checked', true);
        } else {
            checkbox.closest('tr').removeClass('tr-selected');
            checkbox.prop('checked', false);
        }
    });

    $(document).on('click', '#recent-products input[type="checkbox"]', function () {
        const that = $(this);

        if (that.prop('checked')) {
            that.closest('tr').addClass('tr-selected');
        } else {
            that.closest('tr').removeClass('tr-selected');
        }
    });

    function totalSales() {
        if ($('#total-sales').length) {
            const options = {
                series: [{
                    data: [25, 66, 41, 89, 63, 30, 50]
                }],
                chart: {
                    type: 'line',
                    width: 100,
                    height: 35,
                    sparkline: {
                        enabled: true
                    }
                },
                theme: {
                    mode: $('body').hasClass('dark') ? 'dark' : 'light',
                },
                colors: [colors.indigo],
                stroke: {
                    width: 4,
                    curve: 'smooth',
                },
                tooltip: {
                    fixed: {
                        enabled: false
                    },
                    x: {
                        show: false
                    },
                    y: {
                        title: {
                            formatter: function (seriesName) {
                                return ''
                            }
                        }
                    },
                    marker: {
                        show: false
                    }
                }
            };

            new ApexCharts(document.querySelector("#total-sales"), options).render();
        }
    }

    totalSales();

    function totalOrders() {
        if ($('#total-orders').length) {
            const options = {
                series: [{
                    data: [25, 66, 41, 89, 63, 30, 50]
                }],
                chart: {
                    type: 'line',
                    width: 100,
                    height: 35,
                    sparkline: {
                        enabled: true
                    }
                },
                theme: {
                    mode: $('body').hasClass('dark') ? 'dark' : 'light',
                },
                colors: [colors.pink],
                stroke: {
                    width: 4,
                    curve: 'smooth',
                },
                tooltip: {
                    fixed: {
                        enabled: false
                    },
                    x: {
                        show: false
                    },
                    y: {
                        title: {
                            formatter: function (seriesName) {
                                return ''
                            }
                        }
                    },
                    marker: {
                        show: false
                    }
                }
            };

            new ApexCharts(document.querySelector("#total-orders"), options).render();
        }
    }

    totalOrders();

    function customerRating() {
        if ($('#customer-rating').length) {
            const options = {
                series: [{
                    name: 'Rate',
                    data: [25, 66, 41, 89, 63, 25, 44, 12, 36]
                }],
                chart: {
                    type: 'line',
                    height: 50,
                    sparkline: {
                        enabled: true
                    }
                },
                stroke: {
                    width: 4,
                    curve: 'smooth',
                },
                theme: {
                    mode: $('body').hasClass('dark') ? 'dark' : 'light',
                },
                colors: [colors.success],
                tooltip: {
                    fixed: {
                        enabled: false
                    },
                    x: {
                        show: false
                    },
                    y: {
                        title: {
                            formatter: function (seriesName) {
                                return seriesName;
                            }
                        }
                    },
                    marker: {
                        show: false
                    }
                }
            };

            new ApexCharts(document.querySelector("#customer-rating"), options).render();
        }
    }

    customerRating();

    function salesChart() {
        if ($('#sales-chart').length) {
            const options = {
                series: [
                    {
                        name: "Sales",
                        data: [65, 60, 62, 69, 71, 65, 68, 67, 60, 61, 59, 64]
                    },
                    {
                        name: 'Orders',
                        data: [78, 75, 73, 78, 75, 73, 77, 74, 75, 77, 71, 75]
                    }
                ],
                theme: {
                    mode: $('body').hasClass('dark') ? 'dark' : 'light',
                },
                chart: {
                    height: 350,
                    type: 'line',
                    foreColor: colors.chartTextColor,
                    zoom: {
                        enabled: false
                    },
                    toolbar: {
                        show: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                colors: [colors.primary, colors.success],
                stroke: {
                    width: 4,
                    curve: 'smooth',
                },
                legend: {
                    show: false
                },
                markers: {
                    size: 0,
                    hover: {
                        sizeOffset: 6
                    }
                },
                xaxis: {
                    categories: ['01 May', '02 May', '03 May', '04 May', '05 May', '06 May', '07 May', '08 May', '09 May', '10 May', '11 May', '12 May'],
                },
                tooltip: {
                    y: [
                        {
                            title: {
                                formatter: function (val) {
                                    return val
                                }
                            }
                        },
                        {
                            title: {
                                formatter: function (val) {
                                    return val
                                }
                            }
                        },
                        {
                            title: {
                                formatter: function (val) {
                                    return val;
                                }
                            }
                        }
                    ]
                },
                grid: {
                    borderColor: colors.chartBorderColor,
                }
            };

            new ApexCharts(document.querySelector("#sales-chart"), options).render();
        }
    }

    salesChart();

    function salesChannels() {
        if ($('#sales-channels').length) {
            const options = {
                chart: {
                    height: 250,
                    type: 'donut',
                    offsetY: 0
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '40%',
                        }
                    }
                },
                stroke: {
                    show: false,
                    width: 0
                },
                colors: [colors.orange, colors.cyan, colors.indigo],
                series: [48, 30, 22],
                labels: ['Social Media', 'Google', 'Email'],
                legend: {
                    show: false
                }
            }

            new ApexCharts(document.querySelector('#sales-channels'), options).render();
        }
    }

    salesChannels();

    function productsSold() {
        if ($('#products-sold').length) {
            const options = {
                series: [{
                    name: 'Sales',
                    data: [30, 25, 35, 25, 35, 20, 30]
                }],
                chart: {
                    type: 'bar',
                    height: 180,
                    foreColor: 'rgba(255,255,255,55%)',
                    toolbar: {
                        show: false
                    }
                },
                theme: {
                    mode: $('body').hasClass('dark') ? 'dark' : 'light',
                },
                plotOptions: {
                    bar: {
                        borderRadius: 6,
                        columnWidth: '35%',
                        dataLabels: {
                            position: 'top', // top, center, bottom
                        },
                    }
                },
                colors: ['rgba(255,255,255,60%)'],
                dataLabels: {
                    enabled: true,
                    formatter: function (val) {
                        return "$" + val;
                    },
                    offsetY: -20,
                    style: {
                        fontSize: '12px',
                        colors: ['rgba(255,255,255,55%)']
                    }
                },
                xaxis: {
                    show: false,
                    categories: ["Mon", "Tue", "Wed", "Thu", "Fri", "Fri", "Sun"],
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                },
                yaxis: {
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false,
                    },
                    labels: {
                        show: false,
                        formatter: function (val) {
                            return "$" + val;
                        }
                    }

                },
                grid: {
                    show: false
                }
            };

            new ApexCharts(document.querySelector('#products-sold'), options).render();
        }
    }

    productsSold();

    if ($('.summary-cards').length) {
        $('.summary-cards').slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            autoplay: true,
            autoplaySpeed: 1500,
            rtl: $('body').hasClass('rtl') ? true : false
        });
    }

});


$(document).ready(function () {


    $(".form-add-product").submit(function (e) {
        e.preventDefault();
    });
    $("#price-dashboard").keyup(function () {
        var totalPrice = $(this).val();
        if (isNumeric(totalPrice)) {
            $(".label-price").html(
                "(" +
                    totalPrice
                        .toString()
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ".") +
                    " VNĐ )"
            );
        }
    });

    function isNumeric(value) {
        return /^-?\d+$/.test(value);
    }

    $("#file-upload").on("change", function () {
        var fileInput = $(this)[0].files[0];
        var id = $("#id-product").val();
        var formData = new FormData();
        formData.append("upload", fileInput);
        formData.append("id", id);
        $.ajax({
            url: "/dashboard/seller/product/add/media",
            type: "POST",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            contentType: false,
            processData: false,

            beforeSend: function () {
                Notiflix.Loading.standard();
            },
            complete: function () {
                Notiflix.Loading.remove();
            },
            success: function (response) {
                console.log(response);
                if (response["result"] == true) {
                    $("#lightgalleryImgProduct").append(
                        '<div class="card col-md-4 m-2" style="width:18rem"><img class="card-img-top" src="'+ response["path"] +'"><div class="card-body"><button type="button" attr-id="'+ response["id"] +'" class="btn btn-danger btn-action-delete-imgage">Xóa ảnh</button></div></div>'
                    );
                } else {
                    Notiflix.Notify.failure("Lỗi! Ảnh không được tải lên");
                }
            },
            error: function (data) {
                var errors = $.parseJSON(data.responseText);
                Notiflix.Notify.failure(errors["message"]);
            },
        });
    });

    $(document).on("click", ".btn-action-delete-imgage", function () {
        var id = $(this).attr("attr-id");
        $.ajax({
            url: "/dashboard/seller/product/delete/media",
            method: "post",
            dataType: "json",
            data: {
                id: id,
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            beforeSend: function () {
                Notiflix.Loading.standard();
            },
            complete: function () {
                Notiflix.Loading.remove();
            },
            success: function (response) {
                console.log(response);
                if (response["result"] == true) {
                    $("#lightgalleryImgProduct").html("");
                    var data = response["data"];
                    data.forEach((element) => {
                        $("#lightgalleryImgProduct").append(
                            '<div class="card col-md-4 m-2" style="width:18rem"><img class="card-img-top" src="'+ response["path"] +'"><div class="card-body"><button type="button" attr-id="'+ response["id"] +'" class="btn btn-danger btn-action-delete-imgage">Xóa ảnh</button></div></div>'
                        );
                    });
                }
            },
            error: function (data) {
                var errors = $.parseJSON(data.responseText);
                Notiflix.Notify.failure(errors["message"]);
            },
        });
    });

    $(".btn-add-product").click(function () {
        var formData = new FormData($(".form-add-product")[0]);
        formData.append("describes", theEditor.getData());
        $.ajax({
            url: "/dashboard/seller/product/add/detail",
            method: "post",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            beforeSend: function () {
                Notiflix.Loading.standard();
            },
            complete: function () {
                Notiflix.Loading.remove();
            },
            success: function (response) {
                console.log(response);
                if (response["result"] == true) {
                    Swal.fire({
                        icon: "success",
                        title: "Thêm dữ liệu thành công!",
                        text: "Bạn có muốn tiếp tục thêm hình ảnh sản phẩm không?",
                        showDenyButton: true,
                        showCancelButton: false,
                        confirmButtonText: "Có",
                        denyButtonText: `Không`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "/dashboard/seller/product/update/"+response["id"];
                        }
                    });
                } else {
                    Notiflix.Notify.failure(
                        "Lỗi! Không thể cập nhật vui lòng kiểm tra lại thông tin!"
                    );
                }
            },
            error: function (data) {
                var errors = $.parseJSON(data.responseText);
                Notiflix.Notify.failure(errors["message"]);
            },
        });
    });
});


// This sample still does not showcase all CKEditor 5 features (!)
// Visit https://ckeditor.com/docs/ckeditor5/latest/features/index.html to browse all the features.
var editor = CKEDITOR.ClassicEditor.create(document.querySelector("#editor"), {
    // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
    toolbar: {
        items: [
            "exportPDF",
            "exportWord",
            "|",
            "findAndReplace",
            "selectAll",
            "|",
            "heading",
            "|",
            "bold",
            "italic",
            "strikethrough",
            "underline",
            "code",
            "subscript",
            "superscript",
            "removeFormat",
            "|",
            "bulletedList",
            "numberedList",
            "todoList",
            "|",
            "outdent",
            "indent",
            "|",
            "undo",
            "redo",
            "-",
            "fontSize",
            "fontFamily",
            "fontColor",
            "fontBackgroundColor",
            "highlight",
            "|",
            "alignment",
            "|",
            "link",
            "insertImage",
            "blockQuote",
            "insertTable",
            "mediaEmbed",
            "codeBlock",
            "htmlEmbed",
            "|",
            "specialCharacters",
            "horizontalLine",
            "pageBreak",
            "|",
            "textPartLanguage",
            "|",
            "sourceEditing",
        ],
        shouldNotGroupWhenFull: true,
    },
    // Changing the language of the interface requires loading the language file using the <script> tag.
    // language: 'es',
    list: {
        properties: {
            styles: true,
            startIndex: true,
            reversed: true,
        },
    },
    ckfinder: {
        uploadUrl:
            "/dashboard/seller/upload?_token=" +
            $('meta[name="csrf-token"]').attr("content"),
    },
    // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
    heading: {
        options: [
            {
                model: "paragraph",
                title: "Paragraph",
                class: "ck-heading_paragraph",
            },
            {
                model: "heading1",
                view: "h1",
                title: "Heading 1",
                class: "ck-heading_heading1",
            },
            {
                model: "heading2",
                view: "h2",
                title: "Heading 2",
                class: "ck-heading_heading2",
            },
            {
                model: "heading3",
                view: "h3",
                title: "Heading 3",
                class: "ck-heading_heading3",
            },
            {
                model: "heading4",
                view: "h4",
                title: "Heading 4",
                class: "ck-heading_heading4",
            },
            {
                model: "heading5",
                view: "h5",
                title: "Heading 5",
                class: "ck-heading_heading5",
            },
            {
                model: "heading6",
                view: "h6",
                title: "Heading 6",
                class: "ck-heading_heading6",
            },
        ],
    },
    // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
    placeholder: "Welcome to CKEditor 5!",
    // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
    fontFamily: {
        options: [
            "default",
            "Arial, Helvetica, sans-serif",
            "Courier New, Courier, monospace",
            "Georgia, serif",
            "Lucida Sans Unicode, Lucida Grande, sans-serif",
            "Tahoma, Geneva, sans-serif",
            "Times New Roman, Times, serif",
            "Trebuchet MS, Helvetica, sans-serif",
            "Verdana, Geneva, sans-serif",
        ],
        supportAllValues: true,
    },
    // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
    fontSize: {
        options: [10, 12, 14, "default", 18, 20, 22],
        supportAllValues: true,
    },
    // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
    // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
    htmlSupport: {
        allow: [
            {
                name: /.*/,
                attributes: true,
                classes: true,
                styles: true,
            },
        ],
    },
    // Be careful with enabling previews
    // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
    htmlEmbed: {
        showPreviews: true,
    },
    // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
    link: {
        decorators: {
            addTargetToExternalLinks: true,
            defaultProtocol: "https://",
            toggleDownloadable: {
                mode: "manual",
                label: "Downloadable",
                attributes: {
                    download: "file",
                },
            },
        },
    },
    // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
    mention: {
        feeds: [
            {
                marker: "@",
                feed: [
                    "@apple",
                    "@bears",
                    "@brownie",
                    "@cake",
                    "@cake",
                    "@candy",
                    "@canes",
                    "@chocolate",
                    "@cookie",
                    "@cotton",
                    "@cream",
                    "@cupcake",
                    "@danish",
                    "@donut",
                    "@dragée",
                    "@fruitcake",
                    "@gingerbread",
                    "@gummi",
                    "@ice",
                    "@jelly-o",
                    "@liquorice",
                    "@macaroon",
                    "@marzipan",
                    "@oat",
                    "@pie",
                    "@plum",
                    "@pudding",
                    "@sesame",
                    "@snaps",
                    "@soufflé",
                    "@sugar",
                    "@sweet",
                    "@topping",
                    "@wafer",
                ],
                minimumCharacters: 1,
            },
        ],
    },
    // The "super-build" contains more premium features that require additional configuration, disable them below.
    // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
    removePlugins: [
        // These two are commercial, but you can try them out without registering to a trial.
        // 'ExportPdf',
        // 'ExportWord',
        "CKBox",
        "CKFinder",
        "EasyImage",
        // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
        // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
        // Storing images as Base64 is usually a very bad idea.
        // Replace it on production website with other solutions:
        // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
        // 'Base64UploadAdapter',
        "RealTimeCollaborativeComments",
        "RealTimeCollaborativeTrackChanges",
        "RealTimeCollaborativeRevisionHistory",
        "PresenceList",
        "Comments",
        "TrackChanges",
        "TrackChangesData",
        "RevisionHistory",
        "Pagination",
        "WProofreader",
        // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
        // from a local file system (file://) - load this site via HTTP server if you enable MathType
        "MathType",
    ],
})
    .then((editor) => {
        if (editor){
            theEditor = editor;

        }
    })
    .catch((error) => {
        console.error(error);
    });
