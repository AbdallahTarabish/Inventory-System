$(document).ready(function () {
    $(".select_2").select2()

    var Delta = Quill.import('delta');
    var quill = new Quill('#kt_quil_2', {
        modules: {
            toolbar: true
        },
        placeholder: document.getElementById("description").value,
        theme: 'snow'
    });
    var change = new Delta();
    quill.on('text-change', function (delta) {
        change = change.compose(delta);
        document.getElementById("description").value = quill.root.innerHTML;

    });
    setInterval(function () {
        if (change.length() > 0) {
            change = new Delta();
        }
    }, 5 * 1000);
    window.onbeforeunload = function () {
        if (change.length() > 0) {
        }
    }

    $("#form-add").validate({
        rules: {
            email: {
                required: true,
                email: true,
                minlength: 10
            },
            name: {
                required: true
            },
            university_id: {
                required: true
            },
            college_id: {
                required: true
            },
            specialties_id: {
                required: true
            },
            'product[]': {
                required: true
            }
,
            title: {
                required: true
            },
            subject: {
                required: true
            },

            phone: {
                required: true,
            },
            address: {
                required: true
            },
            website: {
                required: true,
                url: true
            },
            country: {
                required: true,
            },
        },
    });


    $('table tbody tr td  #delete_form').click(function (e) {
        e.preventDefault();
        swal.fire({
            text: "هل أنت متأكد من عملية الحذف ؟",
            type: "info",
            buttonsStyling: false,
            confirmButtonText: "<i class='la la-thumbs-up'></i> تأكيد",
            confirmButtonClass: "btn btn-danger",
            showCancelButton: true,
            cancelButtonText: "<i class='la la-thumbs-down'></i> الغاء",
            cancelButtonClass: "btn btn-default"
        }).then((result) => {
            if (result.value) {
                $(this).submit()
            }
        })
    });
    $(".datepicker-date").datepicker({

    });

});



// function counter($id_1 , $id_2 , $slider){
//     var slider = document.getElementById($slider);
//     noUiSlider.create(slider, {
//         start: [0, 20],
//         connect: true,
//         direction: 'rtl',
//         tooltips: [true, wNumb({         decimals: 0, // default is 2
//             thousand: '.', // thousand delimiter
//         })],
//         range: {
//             'min': [0],
//             '10%': [10, 10],
//             '50%': [80, 50],
//             '80%': 150,
//             'max': 1000
//         }
//     });
//     var sliderInput0 = document.getElementById($id_1);
//     var sliderInput1 = document.getElementById($id_2);
//     var sliderInputs = [sliderInput1, sliderInput0];
//     slider.noUiSlider.on('update', function( values, handle ) {
//         sliderInputs[handle].value = values[handle];
//     });
//
// }
