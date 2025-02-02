$(document).ready(function () {

    // Phone masking
    $('#phone').mask('999-999-999', {placeholder: 'x'});
    $('#dest_aqel_phone').mask('999-999-999', {placeholder: 'x'});
    $('#relative_phone').mask('999-999-999', {placeholder: 'x'});

    /***************************************/
    /* Datepicker */
    /***************************************/

    // Start date
    function dateFrom(date_from, date_to) {
        $(date_from).datepicker({
            dateFormat: 'mm/dd/yy',
            prevText: '<i class="fa fa-caret-left"></i>',
            nextText: '<i class="fa fa-caret-right"></i>',
            onClose: function (selectedDate) {
                $(date_to).datepicker('option', 'minDate', selectedDate);
            }
        });
    }

    // Start date
    function afterSubmit() {
        console.log('ssssssss');
        alert('dsd');
    }

    // Finish date
    function dateTo(date_from, date_to) {
        $(date_to).datepicker({
            dateFormat: 'mm/dd/yy',
            prevText: '<i class="fa fa-caret-left"></i>',
            nextText: '<i class="fa fa-caret-right"></i>',
            onClose: function (selectedDate) {
                $(date_from).datepicker('option', 'maxDate', selectedDate);
            }
        });
    }// Finish date
    function dateInit(date) {
        $(date).datepicker({
            dateFormat: 'mm-dd-yy',


        });
    }

    // Destroy date
    function destroyDate(date) {
        $(date).datepicker('destroy');
    }

    dateInit('#birth_date');
    dateInit('#id_issue_date');
    dateInit('#out_from_country_date');
    dateInit('#comming_to_yemen_date');
    dateInit('#dest_exit_date');
    dateInit('#check_date');
    dateInit('#start_date_symptoms');
    dateInit('#check_date');
    dateInit('#insulation_date');
    dateInit('#sleep_date');
    dateInit('#start_date_symptoms');
    dateInit('#insulation_end_date');
    dateInit('#sample_sent_date');

    // Initialize date range
    dateFrom('#date_from', '#date_to');
    dateTo('#date_from', '#date_to');
    /***************************************/
    /* end datepicker */
    /***************************************/

    // Validation
    $("#j-pro").justFormsPro({
        rules: {
            bp_name: {
                required: true
            },
            check_date: {
                required: true
            },
            id_number: {
                required: true
            },
            job: {
                required: true
            },

            phone: {
                required: true
            },
            country: {
                required: true
            },
            quarantine_area_id: {
                required: true
            },
            check_point_id: {
                required: true
            },

            // children: {
            //     required: true,
            //     integer: true,
            //     minvalue: 0
            // },
            birth_date: {
                required: true
            },

        },
        messages: {
            bp_name: {
                required: "الاسم مطلوب"
            },
            birth_date: {
                required: "تاريخ الميلاد مطلوب"
            },
            check_date: {
                required: "تاريخ الفحص مطلوب"
            },
            id_number: {
                required: "رقم المعرف  مطلوب"
            },
            job: {
                required: "نوع الوظيفة  مطلوب"
            },
            country: {
                required: "الدولة    مطلوبة"
            },

            phone: {
                required: "رقم التلفون مطلوب"
            },
            quarantine_area_id: {
                required: "يجب تحديد مركز  "
            },
            check_point_id: {
                required: "يجب تحديد نقطة الفحص او التفتيش  "
            },

            // children: {
            //     required: "Field is required",
            //     integer: "Only integer allowed",
            //     minvalue: "Value not less than 0"
            // },

        },
        formType: {
            multistep: true
        },
        afterSuccessSubmit: function (data) {
            // alert('sss');
            toastr.success(' تم الاضافة بنجاح');
            location.reload();
            return true;
        },
        afterSubmitHandler: function () {
            afterSubmit();
            // console.log(data);
            // Destroy date range
            // destroyDate("#date_from");
            // destroyDate("#date_to");
            // //
            // // Initialize date range
            // dateFrom("#date_from", "#date_to");
            // dateTo("#date_from", "#date_to");

            return true;
        }
    });
});
