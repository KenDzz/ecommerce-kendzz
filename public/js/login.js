$(document).ready(function () {
    var message = $("#message").val();
    if (message && message != "") {
        Notiflix.Report.failure("Thông báo", message, "Đồng ý");
    }
    $("#btn-forget-password").on("click", function () {
        var email = $("#email-forgot-password").val();
        if (email && email != "") {
            $.ajax({
                url: "forgotpassword/select/",
                method: "post",
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                data: {
                    email: email,
                },
                beforeSend: function () {
                    Notiflix.Block.standard("#forgot-password");
                },
                complete: function () {
                    Notiflix.Block.remove("#forgot-password");
                },
            })
                .done(function (data) {
                    console.log(data['status']);
                    if(data['status'] == 'true'){
                        $(".title-forget").hide();
                        $(".form-forgot-password-email").css("display", "none");;
                        $(".form-forgot-password-select").css("display", "block");
                        $(".select-forget-password").append(data['content']);
                        $("#btn-forget-password").hide();
                        $("#btn-forget-password-pass").css("display", "block");
                        $(this).prop('id', 'btn-forget-password-second');
                    }else{
                        Notiflix.Notify.failure(
                            data['content']
                        );
                    }
                })
                .fail(function (jqXHR, ajaxOptions, thrownError) {
                    Notiflix.Notify.failure(
                        "Lỗi hệ thống! Vui lòng quay lại sao"
                    );
                });
        }
    });


    $("#btn-forget-password-pass").on("click", function () {
        var email = $("#email-forgot-password").val();
        var selectedValue = $('input[name="option-forgot"]:checked').val();
        console.log(selectedValue);
        if (email && email != "") {
            $.ajax({
                url: "forgotpassword/pass/",
                method: "post",
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                data: {
                    email: email,
                    value: selectedValue
                },
                beforeSend: function () {
                    Notiflix.Block.standard("#forgot-password");
                },
                complete: function () {
                    Notiflix.Block.remove("#forgot-password");
                },
            })
                .done(function (data) {
                    console.log(data['status']);
                    if(data['status'] == "true"){
                        $(".login-container").hide();
                        $(".confirm-container").css("display", "flex");;
                    }else{
                        Notiflix.Notify.failure(
                            data['content'],
                        );
                    }
                })
                .fail(function (jqXHR, ajaxOptions, thrownError) {
                    Notiflix.Notify.failure(
                        "Lỗi hệ thống! Vui lòng quay lại sao"
                    );
                });
        }
    });

});

function checkRepassword() {
    var password1 = $("#password").val();
    var password2 = $("#repassword").val();
    if (password1 != null && password2 != null && password1 != password2) {
        Notiflix.Notify.failure("Mật khẩu đã nhập không khớp. Hãy thử lại");
        return false;
    }
    return true;
}

function checkParams(name, email, phone, password, rePassword) {
    if (
        name == null &&
        email == null &&
        phone == null &&
        password == null &&
        rePassword == null
    ) {
        Notiflix.Notify.failure("Vui lòng điền đầy đủ thông tin!");
        return false;
    }
    return true;
}

function checkParamsLogin(email, password) {
    if (email == null && password == null) {
        Notiflix.Notify.failure("Vui lòng điền đầy đủ thông tin!");
        return false;
    }
    return true;
}

function checkTerms() {
    if ($("#check-terms").is(":checked")) {
        return true;
    }
    Notiflix.Notify.failure("Bạn chưa chấp nhận điều khoản dịch vụ!");
    return false;
}

$("#btn-reg").click(function () {
    var name = $("#name").val();
    var email = $("#email").val();
    var phone = $("#phone").val();
    var password = $("#password").val();
    var rePassword = $("#repassword").val();
    if (
        checkParams(name, email, phone, password, rePassword) &&
        checkRepassword() &&
        checkTerms()
    ) {
        $.ajax({
            url: "/auth/adduser",
            method: "post",
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                name: name,
                email: email,
                phone: phone,
                password: password,
            },
            beforeSend: function () {
                Notiflix.Block.standard("#form-reg");
            },
            complete: function () {
                Notiflix.Block.remove("#form-reg");
            },
        })
            .done(function (data) {
                if (data["status"] == "true") {
                    Notiflix.Report.success(
                        "Thông báo",
                        data["message"],
                        "Đồng ý",
                        function cb() {
                            window.location.href = "/";
                        }
                    );
                } else {
                    Notiflix.Report.failure(
                        "Thông báo",
                        data["message"],
                        "Đồng ý"
                    );
                }
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {
                Notiflix.Notify.failure("Lỗi hệ thống! Vui lòng quay lại sao");
            });
    }
});

$("#btn-login").click(function () {
    var email = $("#email").val();
    var password = $("#password").val();
    if (checkParamsLogin(email, password)) {
        $.ajax({
            url: "/auth/login",
            method: "post",
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                email: email,
                password: password,
            },
            beforeSend: function () {
                Notiflix.Block.standard("#form-login");
            },
            complete: function () {
                Notiflix.Block.remove("#form-login");
            },
        })
            .done(function (data) {
                if (data["status"] == "true") {
                    window.location.href = "/";
                } else {
                    Notiflix.Report.failure(
                        "Thông báo",
                        data["message"],
                        "Đồng ý"
                    );
                }
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {
                Notiflix.Notify.failure("Lỗi hệ thống! Vui lòng quay lại sao");
            });
    }
});

// Criando uma variável para "pegar" todos os inputs
const inputs = document.querySelectorAll(".input");

// Função para adicionar o label dinâmico nos inputs
function focusFunc() {
    let parent = this.parentNode.parentNode;
    parent.classList.add("focus");
}

// Função para recolher o label dinâmico quando houver um clique do mouse fora do form
function blurFunc() {
    let parent = this.parentNode.parentNode;
    if (this.value == "") {
        parent.classList.remove("focus");
    }
}

// Função para adicionar os eventos
inputs.forEach((input) => {
    input.addEventListener("focus", focusFunc);
    input.addEventListener("blur", blurFunc);
});

// Pegando o modal
var modal = document.getElementById("modal-terms");

// Pegando o botão que dispara o modal
var btn = document.getElementById("action-modal");

// Pegando o elemento <span> que fecha o modal
var span = document.getElementsByClassName("close")[0];

// Quando o usuário clicar no botão, o modal será exibido
btn.onclick = function () {
    modal.style.display = "block";
};

// Quando o usuário clicar no <span> (x), o modal será fechado
span.onclick = function () {
    modal.style.display = "none";
};

// Quando o usuário clicar em qualquer lugar fora do modal, ele será fechado
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
};
