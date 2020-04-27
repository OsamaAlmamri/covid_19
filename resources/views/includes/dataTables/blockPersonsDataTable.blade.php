<script>
    function load_data(government, zone, center, from_date, to_date, gender,) {
        // Function to convert an img URL to data URL
        var bloclkTabelColumn = [
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
                'title': '{{trans('dataTable.gender')}}',
                'name': 'gender',
                'data': "gender",
                'render': function (data, type, row) {
                    return (data == 'male') ? 'ذكر ' : 'انثى';
                }
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
                'render': function (data, type, row) {
                    return (data == '1') ? 'نعم ' : 'لا';
                }
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
                'render': function (data, type, row) {
                    switch (data) {
                        case 'stable':
                            return 'مستقرة';
                            break;
                        case 'critical':
                            return 'حرجة';
                            break;
                        case 'healing':
                            return 'شفاء';
                            break;
                        default:
                            return ' '
                    }
                }
            },


            {
                'name': 'fever_symptoms',
                'data': 'fever_symptoms',
                'title': "{{trans('dataTable.fever_symptoms')}}",
                'render': function (data, type, row) {
                    return (data == '1') ? 'نعم ' : 'لا';
                }
            },
            {
                'name': 'sore_throat_symptoms',
                'data': 'sore_throat_symptoms',

                'title': "{{trans('dataTable.sore_throat_symptoms')}}",
                'render': function (data, type, row) {
                    return (data == '1') ? 'نعم ' : 'لا';
                }
            },

            {
                'name': 'cough_symptoms',
                'data': 'cough_symptoms',
                'title': "{{trans('dataTable.cough_symptoms')}}",
                'render': function (data, type, row) {
                    return (data == '1') ? 'نعم ' : 'لا';
                }
            },
            {
                'name': 'descent_from_the_nose_symptoms',
                'data': 'descent_from_the_nose_symptoms',
                'title': "{{trans('dataTable.descent_from_the_nose_symptoms')}}",
                'render': function (data, type, row) {
                    return (data == '1') ? 'نعم ' : 'لا';
                }
            },
            {
                'name': 'headache_symptoms',
                'data': 'headache_symptoms',
                'title': "{{trans('dataTable.headache_symptoms')}}",
                'render': function (data, type, row) {
                    return (data == '1') ? 'نعم ' : 'لا';
                }
            },
            {
                'name': 'pain_in_chest',
                'data': 'pain_in_chest',
                'title': "{{trans('dataTable.pain_in_chest')}}",
                'render': function (data, type, row) {
                    return (data == '1') ? 'نعم ' : 'لا';
                }
            },
            {
                'name': 'pain_in_the_joints',
                'data': 'pain_in_the_joints',
                'title': "{{trans('dataTable.pain_in_the_joints')}}",
                'render': function (data, type, row) {
                    return (data == '1') ? 'نعم ' : 'لا';
                }
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
                'render': function (data, type, row) {
                    return (data == '1') ? 'نعم ' : 'لا';
                }
            },
            {
                'name': 'blood_pressure_disease',
                'data': 'blood_pressure_disease',
                'title': "{{trans('dataTable.blood_pressure_disease')}}",
                'render': function (data, type, row) {
                    return (data == '1') ? 'نعم ' : 'لا';
                }
            },

            {
                'name': 'diabetes_disease',
                'data': 'diabetes_disease',
                'title': "{{trans('dataTable.diabetes_disease')}}",
                'render': function (data, type, row) {
                    return (data == '1') ? 'نعم ' : 'لا';
                }
            },
            {
                'name': 'immunodeficiency_diseases',
                'data': 'immunodeficiency_diseases',
                'title': "{{trans('dataTable.immunodeficiency_diseases')}}",
                'render': function (data, type, row) {
                    return (data == '1') ? 'نعم ' : 'لا';
                }
            },

            {
                'name': 'liver_diseases',
                'data': 'liver_diseases',
                'title': "{{trans('dataTable.liver_diseases')}}",
                'render': function (data, type, row) {
                    return (data == '1') ? 'نعم ' : 'لا';
                }
            },
            {
                'name': 'chronic_respiratory_disease',
                'data': 'chronic_respiratory_disease',
                'title': "{{trans('dataTable.chronic_respiratory_disease')}}",
                'render': function (data, type, row) {
                    return (data == '1') ? 'نعم ' : 'لا';
                }
            },

            {
                'name': 'kidney_disease',
                'data': 'kidney_disease',
                'title': "{{trans('dataTable.kidney_disease')}}",
                'render': function (data, type, row) {
                    return (data == '1') ? 'نعم ' : 'لا';
                }
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
                'render': function (data, type, row) {
                    return (data == '1') ? 'نعم ' : 'لا';
                }
            },

            {
                'name': 'is_pregnant_in_first_3Month',
                'data': 'is_pregnant_in_first_3Month',
                'title': "{{trans('dataTable.is_pregnant_in_first_3Month')}}",
                'render': function (data, type, row) {
                    return (data == '1') ? 'نعم ' : 'لا';
                }
            },
            {
                'name': 'after_childbirth',
                'data': 'after_childbirth',
                'title': "{{trans('dataTable.after_childbirth')}}",
                'render': function (data, type, row) {
                    return (data == '1') ? 'نعم ' : 'لا';
                }
            },

            {
                'name': 'is_comming_from_other_country',
                'data': 'is_comming_from_other_country',
                'title': "{{trans('dataTable.is_comming_from_other_country')}}",
                'render': function (data, type, row) {
                    return (data == '1') ? 'نعم ' : 'لا';
                }
            },

            {
                'name': 'come_from_country',
                'data': 'come_from_country',
                'title': "{{trans('dataTable.come_from_country')}}",
                'render': function (data, type, row) {
                    return (data == '1') ? 'نعم ' : 'لا';
                }
            },

            {
                'name': 'out_from_country_date',
                'data': 'out_from_country_date',
                'title': "{{trans('dataTable.out_from_country_date')}}",
                'render': function (data, type, row) {
                    return (data == '1') ? 'نعم ' : 'لا';
                }
            },

            {
                'name': 'breathing_difficulty_symptoms',
                'data': 'breathing_difficulty_symptoms',
                'title': "{{trans('dataTable.breathing_difficulty_symptoms')}}",
                'render': function (data, type, row) {
                    return (data == '1') ? 'نعم ' : 'لا';
                }
            },
            {
                'name': 'comming_to_yemen_date',
                'data': 'comming_to_yemen_date',
                'title': "{{trans('dataTable.comming_to_yemen_date')}}",

            }, {
                'name': 'is_visit_health_center',
                'data': 'is_visit_health_center',
                'title': "{{trans('dataTable.is_visit_health_center')}}",
                'render': function (data, type, row) {
                    return (data == '1') ? 'نعم ' : 'لا';
                }
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
                'render': function (data, type, row) {
                    return (data == '1') ? 'نعم ' : 'لا';
                }
            },

            {
                'name': 'mix_people_type',
                'data': 'mix_people_type',
                'title': "{{trans('dataTable.mix_people_type')}}",
                'render': function (data, type, row) {
                    //   -  -
                    switch (data) {
                        case 'healthWorker':
                            return 'العاملين الصحيين';
                            break;
                        case 'family':
                            return 'اسرة المريض';
                            break;
                        case 'both':
                            return 'كلاهم';
                            break;
                        default:
                            return ' '
                    }
                }
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
                'render': function (data, type, row) {
                    return (data == '1') ? 'نعم ' : 'لا';
                }
            },
            {
                'name': 'is_sample_collected',
                'data': 'is_sample_collected',
                'title': "{{trans('dataTable.is_sample_collected')}}",
                'render': function (data, type, row) {
                    return (data == '1') ? 'نعم ' : 'لا';
                }
            },


            {
                'name': 'is_sample_sent',
                'data': 'is_sample_sent',
                'title': "{{trans('dataTable.is_sample_sent')}}",
                'render': function (data, type, row) {
                    return (data == '1') ? 'نعم ' : 'لا';
                }
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
                //investigation => ' ' ,file_closed => ' ' ,case_was_lost => ' ' ,other
                'name': 'response_team_interventions',
                'data': 'response_team_interventions',
                'title': "{{trans('dataTable.response_team_interventions')}}",
                'render': function (data, type, row) {
                    switch (data) {
                        case 'investigation':
                            return '  تم التقصي تحت المتابعة';
                            break;
                        case 'file_closed':
                            return 'تمت المتابعة واغلاق الملف ';
                            break;
                        case 'case_was_lost':
                            return 'فقدت الحالة';
                            break;
                        default:
                            return ' '
                    }
                }
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

        ];
        var driverColumn = [
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
                'name': 'age_day',
                'data': 'age_day',
                'title': '{{trans('dataTable.age_day')}}',
            },
            {
                'name': 'phone',
                'data': 'phone',
                'title': "{{trans('dataTable.phone')}}",
            },
            {
                'name': 'truck_number',
                'data': 'truck_number',
                'title': "{{trans('dataTable.truck_number')}}",
            },
            {
                'name': 'typeStatus',
                'data': 'typeStatus',
                'title': "{{trans('dataTable.typeStatus')}}",
                'render': function (data, type, row) {
                    switch (data) {
                        case 'checkAndTruckInPort':
                            return 'لم يتم فحصهم وما زالت الشاحنات متوقفة في المنفذ';
                            break;
                        case 'checkedAndCrossedFromPort':
                            return 'تم فحصهم وعبورهم من المنفذ';
                            break;
                        case 'JustChecked':
                            return 'تم فحصهم فقط';
                            break;
                        case 'examinedAndQuarantined':
                            return '  تم فحصهم وحجرهم';
                            break;
                        case 'noActionTaken':
                            return 'لم يتم اتخاذ أي إجراء تجاههم';
                            break;
                        default:
                            return ' '
                    }
                }
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
                'name': 'is_comming_from_other_country',
                'data': 'is_comming_from_other_country',
                'title': "{{trans('dataTable.is_comming_from_other_country')}}",
                'render': function (data, type, row) {
                    return (data == '1') ? 'نعم ' : 'لا';
                }
            },
            {
                'name': 'come_from_country',
                'data': 'come_from_country',
                'title': "{{trans('dataTable.come_from_country')}}",
                'render': function (data, type, row) {
                    return (data == '1') ? 'نعم ' : 'لا';
                }
            },
            {
                'name': 'comming_to_yemen_date',
                'data': 'comming_to_yemen_date',
                'title': "{{trans('dataTable.comming_to_yemen_date')}}",

            },
            {
                'name': 'out_from_country_date',
                'data': 'out_from_country_date',
                'title': "{{trans('dataTable.out_from_country_date')}}",
                'render': function (data, type, row) {
                    return (data == '1') ? 'نعم ' : 'لا';
                }
            },


        ];
        var people_in_port = [
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
                'name': 'age_day',
                'data': 'age_day',
                'title': '{{trans('dataTable.age_day')}}',
            },
            {
                'title': '{{trans('dataTable.gender')}}',
                'name': 'gender',
                'data': "gender",
                'render': function (data, type, row) {
                    return (data == 'male') ? 'ذكر ' : 'انثى';
                }
            },
            {
                'name': 'phone',
                'data': 'phone',
                'title': "{{trans('dataTable.phone')}}",
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
                'name': 'typeStatus',
                'data': 'typeStatus',
                'title': "{{trans('dataTable.typeStatus')}}",
                'render': function (data, type, row) {
                    switch (data) {
                        case 'checkAndTruckInPort':
                            return 'لم يتم فحصهم وما زالت الشاحنات متوقفة في المنفذ';
                            break;
                        case 'checkedAndCrossedFromPort':
                            return 'تم فحصهم وعبورهم من المنفذ';
                            break;
                        case 'JustChecked':
                            return 'تم فحصهم فقط';
                            break;
                        case 'examinedAndQuarantined':
                            return '  تم فحصهم وحجرهم';
                            break;
                        case 'noActionTaken':
                            return 'لم يتم اتخاذ أي إجراء تجاههم';
                            break;
                        default:
                            return ' '
                    }
                }
            },
            {
                'name': 'is_comming_from_other_country',
                'data': 'is_comming_from_other_country',
                'title': "{{trans('dataTable.is_comming_from_other_country')}}",
                'render': function (data, type, row) {
                    return (data == '1') ? 'نعم ' : 'لا';
                }
            },
            {
                'name': 'come_from_country',
                'data': 'come_from_country',
                'title': "{{trans('dataTable.come_from_country')}}",
                'render': function (data, type, row) {
                    return (data == '1') ? 'نعم ' : 'لا';
                }
            },
            {
                'name': 'comming_to_yemen_date',
                'data': 'comming_to_yemen_date',
                'title': "{{trans('dataTable.comming_to_yemen_date')}}",

            },
            {
                'name': 'out_from_country_date',
                'data': 'out_from_country_date',
                'title': "{{trans('dataTable.out_from_country_date')}}",
                'render': function (data, type, row) {
                    return (data == '1') ? 'نعم ' : 'لا';
                }
            },


        ];
        var sumBlockPeopleAccordingByCenter = [
            {
                title: '#',
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            // ,,,,
            {
                'name': 'name',
                'data': 'name',
                'title': '{{trans('dataTable.name')}}',
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
                'name': 'allBlockPeople',
                'data': 'allBlockPeople',
                'title': "{{trans('dataTable.allBlockPeople')}}",
            },

            {
                'name': 'allBlockPeopleDead',
                'data': 'allBlockPeopleDead',
                'title': "{{trans('dataTable.allBlockPeopleDead')}}",
            },

            {
                'name': 'allBlockPeopleTransform',
                'data': 'allBlockPeopleTransform',
                'title': "{{trans('dataTable.allBlockPeopleTransform')}}",
            },

            {
                'name': 'allBlockPeopleOut',
                'data': 'allBlockPeopleOut',
                'title': "{{trans('dataTable.allBlockPeopleOut')}}",
            },

            {
                'name': 'allBlockPeopleNotOut',
                'data': 'allBlockPeopleNotOut',
                'title': "{{trans('dataTable.allBlockPeopleNotOut')}}",
            },


        ];
        var sumBlockPeopleAccordingByZone = [
            {
                title: '#',
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
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
                'name': 'allBlockPeople',
                'data': 'allBlockPeople',
                'title': "{{trans('dataTable.allBlockPeople')}}",
            },

            {
                'name': 'allBlockPeopleDead',
                'data': 'allBlockPeopleDead',
                'title': "{{trans('dataTable.allBlockPeopleDead')}}",
            },

            {
                'name': 'allBlockPeopleTransform',
                'data': 'allBlockPeopleTransform',
                'title': "{{trans('dataTable.allBlockPeopleTransform')}}",
            },

            {
                'name': 'allBlockPeopleOut',
                'data': 'allBlockPeopleOut',
                'title': "{{trans('dataTable.allBlockPeopleOut')}}",
            },

            {
                'name': 'allBlockPeopleNotOut',
                'data': 'allBlockPeopleNotOut',
                'title': "{{trans('dataTable.allBlockPeopleNotOut')}}",
            },


        ];
        var sumBlockPeopleAccordingByGov = [
            {
                title: '#',
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },


            {
                'name': 'name_ar',
                'data': 'name_ar',
                'title': "{{trans('dataTable.government_name')}}",
            },

            {
                'name': 'allBlockPeople',
                'data': 'allBlockPeople',
                'title': "{{trans('dataTable.allBlockPeople')}}",
            },

            {
                'name': 'allBlockPeopleDead',
                'data': 'allBlockPeopleDead',
                'title': "{{trans('dataTable.allBlockPeopleDead')}}",
            },

            {
                'name': 'allBlockPeopleTransform',
                'data': 'allBlockPeopleTransform',
                'title': "{{trans('dataTable.allBlockPeopleTransform')}}",
            },

            {
                'name': 'allBlockPeopleOut',
                'data': 'allBlockPeopleOut',
                'title': "{{trans('dataTable.allBlockPeopleOut')}}",
            },

            {
                'name': 'allBlockPeopleNotOut',
                'data': 'allBlockPeopleNotOut',
                'title': "{{trans('dataTable.allBlockPeopleNotOut')}}",
            },


        ];
        var quarantines_zone = [
            {
                title: '#',
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
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
            }
            @foreach( getAllQuarantineTypeInfo() as $t)
            , {
                'name': 'type_{{$t->id}}',
                'data': 'type_{{$t->id}}',
                'title': "{{$t->name}}",
            }
            @endforeach
            , {
                'name': 'allTypes',
                'data': 'allTypes',
                'title': "{{trans('dataTable.allTypes')}}"
            }, {
                'name': 'allTypes',
                'data': 'allTypes',
                'title': "{{trans('dataTable.allTypes')}}"
            }

        ];
        var quarantines_gov = [
            {
                title: '#',
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },

            {
                'name': 'government_name',
                'data': 'government_name',
                'title': "{{trans('dataTable.government_name')}}",
            }
            @foreach( getAllQuarantineTypeInfo() as $t)
            , {
                'name': 'type_{{$t->id}}',
                'data': 'type_{{$t->id}}',
                'title': "{{$t->name}}",
            }
            @endforeach
            , {
                'name': 'allTypes',
                'data': 'allTypes',
                'title': "{{trans('dataTable.allTypes')}}"
            }, {
                'name': 'allTypes',
                'data': 'allTypes',
                'title': "{{trans('dataTable.allTypes')}}"
            }

        ];
        var column = [];
        if ('{{$type}}' == 'truck_driver')
            column = driverColumn;
        else if ('{{$type}}' == 'people_in_port')
            column = people_in_port;
        else if ('{{$type}}' == 'sumBlockPersons')
            column = sumBlockPeopleAccordingByCenter;
        else if ('{{$type}}' == 'sumBlockPersons_zone')
            column = sumBlockPeopleAccordingByZone;
        else if ('{{$type}}' == 'sumBlockPersons_gov')
            column = sumBlockPeopleAccordingByGov;
        else if ('{{$type}}' == 'quarantines_zone')
            column = quarantines_zone;
        else if ('{{$type}}' == 'quarantines_gov')
            column = quarantines_gov;
        else
            column = bloclkTabelColumn;


        function getBase64FromImageUrl(url) {
            var img = new Image();
            img.crossOrigin = "anonymous";
            img.onload = function () {
                var canvas = document.createElement("canvas");
                canvas.width = this.width;
                canvas.height = this.height;
                var ctx = canvas.getContext("2d");
                ctx.drawImage(this, 0, 0);
                var dataURL = canvas.toDataURL("image/png");
                return dataURL.replace(/^data:image\/(png|jpg);base64,/, "");
            };
            img.src = url;
        }

        $('#orderdata').DataTable({
                @include('includes.dataTables.btns')
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
                                type_query: '{{$type}}',
                                bb: '{{$type}}',
                                from_date: from_date,
                                to_date: to_date,
                                gender: gender,
                            },
                    },
                columns: column
            }
        )
        ;
    }

    $(document).ready(function () {
        // load_data(1, 5);
        var firstTime = 0;

        // ChangeInput();

        $('#filter').click(function () {

            ChangeInput();

        });

        function ChangeInput() {
            var government = $('#government_id').val();
            var zone = $('#zone_id').val();

            var center = $('#pointOrCenter_id').val();
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            var gender = $('#gender').val();
            if (government != '' && zone != '') {
                if (firstTime != 0)
                    $('#orderdata').DataTable().destroy();
                firstTime = 1;
                load_data(government, zone, center, from_date, to_date, gender);

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
