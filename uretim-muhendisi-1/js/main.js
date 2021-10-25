
function isNumericInputPhone(event) {
    var key = event.keyCode;
    return ((key >= 48 && key <= 57) || // Allow number line
        (key >= 96 && key <= 105) // Allow number pad
    );
};

function isModifierKey(event) {
    var key = event.keyCode;
    return (event.shiftKey === true || key === 35 || key === 36) || // Allow Shift, Home, End
        (key === 8 || key === 9 || key === 13 || key === 46) || // Allow Backspace, Tab, Enter, Delete
        (key > 36 && key < 41) || // Allow left, up, right, down
        (
            // Allow Ctrl/Command + A,C,V,X,Z
            (event.ctrlKey === true || event.metaKey === true) &&
            (key === 65 || key === 67 || key === 86 || key === 88 || key === 90)
        )
};

function enforceFormat(event) {
    if (!isNumericInputPhone(event) && !isModifierKey(event)) {
        event.preventDefault();
    }
};

function formatToPhone(event) {
    if (isModifierKey(event)) {
        return;
    }
    var target = event.target;
    var input = event.target.value.replace(/\D/g, '').substring(0, 10);
    var zip = input.substring(0, 3);
    var middle = input.substring(3, 6);
    var last = input.substring(6, 10);
    if (zip.charAt(0) === "0") {
        target.value = ``;
    } else if (!(zip.charAt(0) === "(" || zip.charAt(0) === "5")) {
        target.value = ``;
    } else if (input.length >= 6) {
        target.value = `(${zip}) ${middle} - ${last}`;
    } else if (input.length >= 3) {
        target.value = `(${zip}) ${middle}`;
    } else if (input.length >= 0) {
        target.value = `(${zip}`;
    }
};

$(document).on("keydown", "#phoneNumber", function (e) {
    enforceFormat(e);
});

$(document).on("keyup", "#phoneNumber", function (e) {
    formatToPhone(e);
});

function MailKontrol(email) {
    var kontrol = new RegExp(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
    return kontrol.test(email);
};

Dropzone.autoDiscover = false;

$(document).ready(function () {

    $("#applyForm").validate({
        // Specify validation rules
        rules: {
            nameSurname: "required",
            emailAddress: {
                required: true,
                email: true
            },
            phoneNumber: {
                required: true,
                minlength: 16
            },
            university: "required",
            department: "required",
            graduationYear: {
                required: true,
                min: 1981,
                max: 2021
            }
        },
        // Specify validation error messages
        messages: {
            nameSurname: "Ad-Soyad Gerekli!",
            emailAddress: "Geçersiz email adresi!",
            phoneNumber: {
                required: "Telefon numarası boş geçilemez!",
                minlength: "Telefon numarası 11 haneli olmalı!"
            },
            university: "Üniversite seçmelisiniz!",
            department: "Bölüm boş geçilemez!!",
            graduationYear: {
                required: "Mezuniyet yılı boş geçilemez!",
                min: "Mezuniyet yılı 1980'den büyük olmalı!",
                max: "Mezuniyet yılı 2022'den küçük olmalı!"
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });


    // var selectStudentType = "Mezun";

    // $('input[type=radio][name=radio4]').change(function () {

    //     if (this.value == 'ogrenci') {
    //         $("#classArea").show("slow", function () {
    //             $("#graduatedArea").hide(100);
    //             $("#selectClass").prop('required', true);
    //             $("#graduationYear").prop('required', false);
    //             selectStudentType = "Öğrenci";
    //         });
    //     } else if (this.value == 'mezun') {
    //         $("#graduatedArea").show(100, function () {
    //             $("#classArea").hide("slow");
    //             $("#selectClass").prop('required', false);
    //             $("#graduationYear").prop('required', true);
    //             selectStudentType = "Mezun";
    //         });
    //     }
    // });

    $(function () {
        var dz = null;
        $("#applyDropzone").dropzone({
            autoProcessQueue: false,
            paramName: "file",
            maxFilesize: 2,
            maxThumbnailFilesize: 2,
            maxFiles: 1,
            parallelUploads: 1,
            acceptedFiles: ".pdf",
            uploadMultiple: false,
            addRemoveLinks: true,
            dictDefaultMessage: "CV Ekle",
            dictRemoveFile: "Kaldır",
            dictFileTooBig: "Dosya boyutu fazla(Max:2Mb)",
            dictCancelUpload:"İptal et",
            dictUploadCanceled: "Yükleme iptal edildi",
            dictCancelUploadConfirmation: "Yüklemeyi iptal etmek istiyor musunuz?",
            init: function () {

                this.on("sending", function (file, xhr, formData) {
                    formData.append("email", $("#emailAddress").val());
                });

                dz = this;
                $("#applyButton").click(function (e) {

                    e.preventDefault();

                    if ($("#applyForm").valid() === false) {
                        $("#applyForm").valid();
                        swal("Uyarı", "Eksik alanlar mevcut!", "warning");
                        return false;
                    }
                    else if ($('#checkbox-1')[0].checked === false) {
                        swal("Uyarı", "Gizlilik metnini işaretlemelisiniz!", "warning");
                        return false;
                    }

                    $("#applyButton").prop("disabled", true);

                    if (dz.files.length == 0) {
                        swal("Uyarı", "CV yüklemelisiniz!", "warning");
                        $("#applyButton").prop("disabled", false);
                        return false;
                    }

                    var emailAddress2 = $('#emailAddress').val();
                    var phoneNumber2 = $('#phoneNumber').val();

                    if (MailKontrol(emailAddress2) === false) {
                        swal("Uyarı", "Uygun bir e-mail adresi giriniz!", "warning");
                        $("#applyButton").prop("disabled", false);
                        return false;
                    }
                    else if (phoneNumber2 === null || phoneNumber2 === "" || phoneNumber2.length < 16) {
                        swal("Uyarı", "Uygun bir telefon numarası giriniz!", "warning");
                        $("#applyButton").prop("disabled", false);
                        return false;
                    }

                    var _uni = $("#university option:selected").text();
                    var _gradudated = $("#graduationYear").val();
                    var values = $("#applyForm").serialize();

                    values += "&university=" + encodeURIComponent(_uni);
                    values += "&graduatedYear=" + encodeURIComponent(_gradudated);

                    $.ajax({
                        type: 'POST',
                        dataType: "json",
                        url: 'apply.php',
                        data: values // getting filed value in serialize form
                    })
                        .done(function (data) { // if getting done then call.

                            if (data.status === "ok") {
                                dz.processQueue();
                                $("#applyButton").prop("disabled", false);

                            } else {
                                console.log(data.result);
                                $("#applyButton").prop("disabled", false);
                                swal({
                                    title: data.result,
                                    icon: 'warning'
                                });
                            }
                        })
                        .fail(function () { // if fail then getting message
                            $("#applyButton").prop("disabled", false);
                            swal("Hata", "Başvuru başarısız! Lütfen tekrar deneyin.", "error");
                        });

                    return false;
                });

            },
            error: function (file, response, xhr) {
                swal("Hata", "Başvuru başarısız!", "error");
                $("#applyButton").prop("disabled", false);
                setTimeout(() => {
                    this.removeFile(file);
                }, 3000);
            },
            success: function (file, response, xhr) {
                this.removeFile(file);
                swal({
                    title: 'Başvurunuz Kaydedildi',
                    icon: 'success'
                }).then(function () {
                    location.reload();
                });
            },
            queuecomplete: function (file) {
                // this.removeFile(file);
            }
        });

    });

});
