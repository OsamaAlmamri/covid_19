0
<script>
    $(document).ready(function () {
        // load_data(1, 5);
        var firstTime = 0;

        // ChangeInput();
        function load_data(government, zone, center) {
            $('#orderdata').DataTable({
                    processing: true,
                    serverSide: true,
                    paging: true,
                    scrollX: true,
                    // responsive: true,
                    searching: true,
                    search: [
                        regex => true,
                    ],
                    info: false,
                    searchDelay: 350,
//                    'language' : ['url' : HostUrl('js/dataTables/language.json')],
                    dom: 'Blfrtip',
                    lengthMenu: [[10, 50, 100, -1], [10, 50, 100, 'all']],
                    buttons:
                        [
                            {
                                extend: 'copyHtml5',
                                text: '<i class="fa fa-copy" ></i> copy',
                                className: 'btn btn-info '
                            },
                            {
                                extend: 'excelHtml5',
                                text: '<i class="fa fa-file-excel-o" ></i> Excel',
                                className: 'btn btn-info '
                            },
                            {
                                extend: 'pdfHtml5',
                                text: '<i class="fa fa-file-pdf-o" ></i> PDF',
                                className: 'btn btn-info '
                            },
                            {
                                extend: 'print',
                                text: '<i class="fa fa-print" ></i> Print',
                                className: 'btn btn-info '
                            }
                        ],
                    ajax:
                        {
                            url: '{{route("block_persons.filterBlockPersons")}}',
                            method: 'post',
                            dataType: 'json',// data type that i want to return
                            data:
                                {
                                    _token: "{{csrf_token()}}",
                                    government: government,
                                    zone: zone,
                                    center: center,
                                },
                        },
                    columns: [
                        {
                            title: '#',
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            'name': 'bp_name',
                            'data': 'bp_name',
                            'title': '{{trans('dataTable.name')}}',
                        },
                        {
                            'name': 'check_date',
                            'data': 'check_date',
                            'title': '{{trans('dataTable.check_date')}}',
                        },
                        {
                            'name': 'gender',
                            'data': 'gender',
                            'title': '{{trans('dataTable.gender')}}',
                        },

                        {
                            'name': 'age_day',
                            'data': 'age_day',
                            'title': '{{trans('dataTable.age_day')}}',
                        },


                        {
                            'name': 'age_month',
                            'data': 'age_month',
                            'title': '{{trans('dataTable.age_month')}}',
                        },
                        {
                            'name': 'age_year',
                            'data': 'age_year',
                            'title': '{{trans('dataTable.age_year')}}',
                        },
                        {
                            'name': 'job',
                            'data': 'job',
                            'title': '{{trans('dataTable.job')}}',
                        },
                        {
                            'name': 'phone',
                            'data': 'phone',
                            'title': "{{trans('dataTable.phone')}}",
                        },

                        {
                            'name': 'relative_phone',
                            'data': 'relative_phone',
                            'title': "{{trans('dataTable.relative_phone')}}",
                        },
                        {
                            'name': 'government_name',
                            'data': 'government_name',
                            'title': "{{trans('dataTable.government_name')}}",
                        },
                        {
                            'name': 'zone_name',
                            'data': 'zone_name',
                            'title': "{{trans('dataTable.zone_name')}}",
                        },
                        {
                            'name': 'other_place_data',
                            'data': 'other_place_data',
                            'title': "{{trans('dataTable.other_place_data')}}",
                        },


                        {
                            'name': 'visit_zone',
                            'data': 'visit_zone',
                            'title': "{{trans('dataTable.visit_zone')}}",
                        },


                        {
                            'name': 'start_date_symptoms',
                            'data': 'start_date_symptoms',
                            'title': "{{trans('dataTable.start_date_symptoms')}}",
                        },

                        {
                            'name': 'sleeping',
                            'data': 'sleeping',
                            'title': "{{trans('dataTable.sleeping')}}",
                        },

                        {
                            'name': 'sleep_date',
                            'data': 'sleep_date',
                            'title': "{{trans('dataTable.sleep_date')}}",
                        },

                        {
                            'name': 'center_zone',
                            'data': 'center_zone',
                            'title': "{{trans('dataTable.center_zone')}}",
                        },

                        {
                            'name': 'insulation_date',
                            'data': 'insulation_date',
                            'title': "{{trans('dataTable.insulation_date')}}",
                        },
                        {
                            'name': 'status_at_reporting',
                            'data': 'status_at_reporting',
                            'title': "{{trans('dataTable.status_at_reporting')}}",
                        },


                        {
                            'name': 'fever_symptoms',
                            'data': 'fever_symptoms',
                            'title': "{{trans('dataTable.fever_symptoms')}}",
                        },
                        {
                            'name': 'sore_throat_symptoms',
                            'data': 'sore_throat_symptoms',
                            'title': "{{trans('dataTable.sore_throat_symptoms')}}",
                        },
                        {
                            'name': 'cough_symptoms',
                            'data': 'cough_symptoms',
                            'title': "{{trans('dataTable.cough_symptoms')}}",
                        },
                        {
                            'name': 'descent_from_the_nose_symptoms',
                            'data': 'descent_from_the_nose_symptoms',
                            'title': "{{trans('dataTable.descent_from_the_nose_symptoms')}}",
                        },
                        {
                            'name': 'headache_symptoms',
                            'data': 'headache_symptoms',
                            'title': "{{trans('dataTable.headache_symptoms')}}",
                        },
                        {
                            'name': 'pain_in_chest',
                            'data': 'pain_in_chest',
                            'title': "{{trans('dataTable.pain_in_chest')}}",
                        },
                        {
                            'name': 'pain_in_the_joints',
                            'data': 'pain_in_the_joints',
                            'title': "{{trans('dataTable.pain_in_the_joints')}}",
                        },
                        {
                            'name': 'others_symptoms',
                            'data': 'others_symptoms',
                            'title': "{{trans('dataTable.others_symptoms')}}",
                        },

                        {
                            'name': 'heart_disease',
                            'data': 'heart_disease',
                            'title': "{{trans('dataTable.heart_disease')}}",
                        },
                        {
                            'name': 'blood_pressure_disease',
                            'data': 'blood_pressure_disease',
                            'title': "{{trans('dataTable.blood_pressure_disease')}}",
                        },

                        {
                            'name': 'diabetes_disease',
                            'data': 'diabetes_disease',
                            'title': "{{trans('dataTable.diabetes_disease')}}",
                        },
                        {
                            'name': 'immunodeficiency_diseases',
                            'data': 'immunodeficiency_diseases',
                            'title': "{{trans('dataTable.immunodeficiency_diseases')}}",
                        },

                        {
                            'name': 'liver_diseases',
                            'data': 'liver_diseases',
                            'title': "{{trans('dataTable.liver_diseases')}}",
                        },
                        {
                            'name': 'chronic_respiratory_disease',
                            'data': 'chronic_respiratory_disease',
                            'title': "{{trans('dataTable.chronic_respiratory_disease')}}",
                        },

                        {
                            'name': 'kidney_disease',
                            'data': 'kidney_disease',
                            'title': "{{trans('dataTable.kidney_disease')}}",
                        },
                        {
                            'name': 'other_diseases',
                            'data': 'other_diseases',
                            'title': "{{trans('dataTable.other_diseases')}}",
                        },

                        {
                            'name': 'is_pregnant',
                            'data': 'is_pregnant',
                            'title': "{{trans('dataTable.is_pregnant')}}",
                        },

                        {
                            'name': 'is_pregnant_in_first_3Month',
                            'data': 'is_pregnant_in_first_3Month',
                            'title': "{{trans('dataTable.is_pregnant_in_first_3Month')}}",
                        },
                        {
                            'name': 'after_childbirth',
                            'data': 'after_childbirth',
                            'title': "{{trans('dataTable.after_childbirth')}}",
                        },

                        {
                            'name': 'is_comming_from_other_country',
                            'data': 'is_comming_from_other_country',
                            'title': "{{trans('dataTable.is_comming_from_other_country')}}",
                        },

                        {
                            'name': 'come_from_country',
                            'data': 'come_from_country',
                            'title': "{{trans('dataTable.come_from_country')}}",
                        },
                        {
                            'name': 'comming_date',
                            'data': 'comming_date',
                            'title': "{{trans('dataTable.comming_date')}}",
                        },
                        {
                            'name': 'out_from_country_date',
                            'data': 'out_from_country_date',
                            'title': "{{trans('dataTable.out_from_country_date')}}",
                        },

                        {
                            'name': 'breathing_difficulty_symptoms',
                            'data': 'breathing_difficulty_symptoms',
                            'title': "{{trans('dataTable.breathing_difficulty_symptoms')}}",
                        },
                        {
                            'name': 'comming_to_yemen_date',
                            'data': 'comming_to_yemen_date',
                            'title': "{{trans('dataTable.comming_to_yemen_date')}}",
                        }, {
                            'name': 'is_visit_health_center',
                            'data': 'is_visit_health_center',
                            'title': "{{trans('dataTable.is_visit_health_center')}}",
                        },

                        {
                            'name': 'health_center_name',
                            'data': 'health_center_name',
                            'title': "{{trans('dataTable.health_center_name')}}",
                        },
                        {
                            'name': 'is_mix_other_people',
                            'data': 'is_mix_other_people',
                            'title': "{{trans('dataTable.is_mix_other_people')}}",
                        },

                        {
                            'name': 'mix_people_type',
                            'data': 'mix_people_type',
                            'title': "{{trans('dataTable.mix_people_type')}}",
                        },
                        {
                            'name': 'other_mix_people',
                            'data': 'other_mix_people',
                            'title': "{{trans('dataTable.other_mix_people')}}",
                        },


                        {
                            'name': 'is_patientIdentical_standard_definition',
                            'data': 'is_patientIdentical_standard_definition',
                            'title': "{{trans('dataTable.is_patientIdentical_standard_definition')}}",
                        },
                        {
                            'name': 'is_sample_collected',
                            'data': 'is_sample_collected',
                            'title': "{{trans('dataTable.is_sample_collected')}}",
                        },


                        {
                            'name': 'is_sample_sent',
                            'data': 'is_sample_sent',
                            'title': "{{trans('dataTable.is_sample_sent')}}",
                        },
                        {
                            'name': 'sample_sent_date',
                            'data': 'sample_sent_date',
                            'title': "{{trans('dataTable.sample_sent_date')}}",
                        },
                        {
                            'name': 'result_of_examining',
                            'data': 'result_of_examining',
                            'title': "{{trans('dataTable.result_of_examining')}}",
                        },
                        {
                            'name': 'situation_result',
                            'data': 'situation_result',
                            'title': "{{trans('dataTable.situation_result')}}",
                        }, {
                            'name': 'if_dead_date',
                            'data': 'if_dead_date',
                            'title': "{{trans('dataTable.if_dead_date')}}",
                        },
                        {
                            'name': 'transfer_zone',
                            'data': 'transfer_zone',
                            'title': "{{trans('dataTable.transfer_zone')}}",
                        },
                        {
                            'name': 'situation_result',
                            'data': 'situation_result',
                            'title': "{{trans('dataTable.situation_result')}}",
                        },
                        {
                            'name': 'response_team_interventions',
                            'data': 'response_team_interventions',
                            'title': "{{trans('dataTable.response_team_interventions')}}",
                        },
                        {
                            'name': 'other_response_team_interventions',
                            'data': 'other_response_team_interventions',
                            'title': "{{trans('dataTable.other_response_team_interventions')}}",
                        },
                        {
                            'name': 'note',
                            'data': 'note',
                            'title': "{{trans('dataTable.note')}}",
                        },

                    ]
                }
            )
            ;
        }

        $('#filter').click(function () {

            ChangeInput();
        });

        function ChangeInput() {
            var government = $('#government_id').val();
            var zone = $('#zone_id').val();
            var center = $('#pointOrCenter_id').val();
            if (government != '' && zone != '') {
                if (firstTime != 0)
                    $('#orderdata').DataTable().destroy();
                firstTime = 1;
                load_data(government, zone, center);

            } else {
                alert('Both Input is required');
            }
        }

        // var today = new Date();
        // var dd = String(today.getDate()).padStart(2, '0');
        // var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        // var yyyy = today.getFullYear();
        // today = yyyy + '-' + mm + '-' + dd;
        // load_data('all', 'all', today, today, 'male', 'point');

    })
    ;
</script>
