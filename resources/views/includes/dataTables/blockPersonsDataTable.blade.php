<script>
    function load_data(government, zone, center, from_date, to_date, gender, nationality,isQuarantine) {
        // Function to convert an img URL to data URL
		//alert('gov: '+government+' '+'zon: '+zone+' '+'cen: '+center+' '+'fda: '+from_date+' '+'tda: '+to_date+' '+'gen: '+gender+' '+'nat: '+nationality);
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
                'name': 'quarantine_area_name',
                'data': 'quarantine_area_name',
                'title': '{{trans('dataTable.quarantine_area_name')}}',
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
                'name': 'age_year',
                'data': 'age_year',
                'title': '{{trans('dataTable.age_year')}}',
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
                        case 'runAway':
                            return 'هارب     ';
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
        else if ('{{$type}}' == 'runAway_block_peoples')
            column = people_in_port;
        else
            column = bloclkTabelColumn;

        @include('includes.how')
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
                {{--                'language': "{{json_encode(datatable_lang(),1)}}",--}}
                dom: 'Blfrtip',
                lengthMenu: [[10, 50, 100, -1], [10, 50, 100, 'all']],
                buttons:
                    [
                            {{--                        {--}}
                            {{--                            text: '<i class="fa fa-file-pdf-o" ></i> pdf',--}}
                            {{--                            extend: 'pdfHtml5',--}}


                            {{--// orientation: $('#pageOrientation').val(),// 'landscape', //portrait--}}
                            {{--// pageSize: $('#pageSize').val(),//'A3', //A3 , A5 , A6 , legal , letter--}}
                            {{--                            exportOptions: {--}}
                            {{--                                columns: ':visible',--}}
                            {{--// columns: [0, 1],--}}
                            {{--                                search: 'applied',--}}
                            {{--                                order: 'applied',--}}


                            {{--                            },--}}
                            {{--                            customize: function (doc) {--}}
                            {{--//Remove the title created by datatTables--}}
                            {{--                                doc.content.splice(0, 1);--}}


                            {{--//Create a date string that we use in the footer. Format is dd-mm-yyyy--}}
                            {{--                                var now = new Date();--}}
                            {{--                                var titleText = $('#titleText').val();--}}
                            {{--                                var centerTitleText = $('#centerTitleText').val();--}}
                            {{--                                var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();--}}
                            {{--// Logo converted to base64--}}
                            {{--// var logo = getBase64FromImageUrl('https://datatables.net/media/images/logo.png');--}}
                            {{--// The above call should work, but not when called from codepen.io--}}
                            {{--// So we use a online converter and paste the string in.--}}
                            {{--// Done on http://codebeautify.org/image-to-base64-converter--}}
                            {{--// It's a LONG string scroll down to see the rest of the code !!!--}}
                            {{--                                var logo = 'data:image/jpeg;base64,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';--}}
                            {{--// A documentation reference can be found at--}}
                            {{--// https://github.com/bpampuch/pdfmake#getting-started--}}
                            {{--// Set page margins [left,top,right,bottom] or [horizontal,vertical]--}}
                            {{--// or one number for equal spread--}}
                            {{--// It's important to create enough space at the top for a header !!!--}}
                            {{--// a string or { width: number, height: number }--}}
                            {{--                                doc.pageSize = $('#pageSize').val();--}}
                            {{--                                doc.filename = $('#pageName').val();--}}


                            {{--// by default we use portrait, you can change it to landscape if you wish--}}
                            {{--                                doc.pageOrientation = $('#pageOrientation').val();--}}

                            {{--// [left, top, right, bottom] or [horizontal, vertical] or just a number for equal margins--}}
                            {{--                                doc.pageMargins = [20, 60, 20, 30];--}}
                            {{--// Set the font size fot the entire document--}}
                            {{--                                doc.defaultStyle.fontSize = 7;--}}
                            {{--                                doc.defaultStyle.font = 'Amiri';--}}
                            {{--// Set the fontsize for the table header--}}

                            {{--                                how('pdf', '{{trans('menu.'.$type)}}','{{$type}}');--}}
                            {{--                                doc.styles.tableHeader.fontSize = 7;--}}
                            {{--// Create a header object with 3 columns--}}
                            {{--// Left side: Logo--}}
                            {{--// Middle: brandname--}}
                            {{--// Right side: A document title--}}
                            {{--                                doc['header'] = (function () {--}}
                            {{--                                    return {--}}
                            {{--                                        columns: [--}}

                            {{--                                            {--}}
                            {{--                                                --}}{{--alignment: 'left',--}}
                            {{--                                                    --}}{{--alignment: 'right',--}}
                            {{--                                                direction: 'rtl',--}}
                            {{--                                                italics: true,--}}
                            {{--                                                text: titleText,--}}
                            {{--                                                fontSize: 18,--}}
                            {{--                                                font: 'Amiri',--}}
                            {{--                                                margin: [10, 0]--}}
                            {{--                                            },--}}
                            {{--                                            {--}}
                            {{--                                                alignment: 'left',--}}
                            {{--                                                fontSize: 14,--}}
                            {{--                                                font: 'Amiri',--}}

                            {{--                                                text: centerTitleText--}}
                            {{--                                            },--}}
                            {{--                                            {--}}
                            {{--                                                alignment: 'right',--}}
                            {{--                                                image: logo,--}}
                            {{--                                                width: 130--}}
                            {{--                                            }--}}
                            {{--                                        ],--}}
                            {{--                                        margin: 20--}}
                            {{--                                    }--}}
                            {{--                                });--}}
                            {{--// Create a footer object with 2 columns--}}
                            {{--// Left side: report creation date--}}
                            {{--// Right side: current page and total pages--}}
                            {{--                                doc['footer'] = (function (page, pages) {--}}
                            {{--                                    return {--}}
                            {{--                                        columns: [--}}
                            {{--                                            {--}}
                            {{--                                                alignment: 'left',--}}
                            {{--                                                text: ['Created on: ', {text: jsDate.toString()}]--}}
                            {{--                                            },--}}
                            {{--                                            {--}}
                            {{--                                                alignment: 'right',--}}
                            {{--                                                text: ['page ', {text: page.toString()}, ' of ', {text: pages.toString()}]--}}
                            {{--                                            }--}}
                            {{--                                        ],--}}
                            {{--                                        margin: 20--}}
                            {{--                                    }--}}
                            {{--                                });--}}
                            {{--// Change dataTable layout (Table styling)--}}
                            {{--// To use predefined layouts uncomment the line below and comment the custom lines below--}}
                            {{--// doc.content[0].layout = 'lightHorizontalLines'; // noBorders , headerLineOnly--}}
                            {{--                                var objLayout = {};--}}
                            {{--                                objLayout['hLineWidth'] = function (i) {--}}
                            {{--                                    return .5;--}}
                            {{--                                };--}}
                            {{--                                objLayout['vLineWidth'] = function (i) {--}}
                            {{--                                    return .5;--}}
                            {{--                                };--}}
                            {{--                                objLayout['hLineColor'] = function (i) {--}}
                            {{--                                    return '#aaa';--}}
                            {{--                                };--}}
                            {{--                                objLayout['vLineColor'] = function (i) {--}}
                            {{--                                    return '#aaa';--}}
                            {{--                                };--}}
                            {{--                                objLayout['paddingLeft'] = function (i) {--}}
                            {{--                                    return 4;--}}
                            {{--                                };--}}
                            {{--                                objLayout['paddingRight'] = function (i) {--}}
                            {{--                                    return 4;--}}
                            {{--                                };--}}
                            {{--                                doc.content[0].layout = objLayout;--}}
                            {{--                            }--}}
                            {{--                        },--}}
                        {
                            extend: 'excelHtml5',
                            text: '<i class="fa fa-file-excel-o" ></i> Excel',

                            exportOptions: {
                                columns: ':visible'
                            },
                            customize: function () {
                                how('excel', '{{trans('menu.'.$type)}}', '{{$type}}');

                            }
                        },
                        , 'colvis'
                    ],
                columnDefs: [{
                    targets: -1,
                    visible: false
                }],

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
                                isQuarantine: isQuarantine,
                                type_query: '{{$type}}',
                                bb: '{{$type}}',
                                from_date: from_date,
                                to_date: to_date,
                                gender: gender,
                                nationality: nationality,
                            }

                    },
                columns: column
            }
        )
        ;
    }

    $(document).ready(function () {
        // load_data(1, 5);
        var firstTime = 1;


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
            var nationality = $('#nationality').val();
            var isQuarantine = $('#isQuarantine').val();
            if (government != '' && zone != '') {
                if (firstTime != 0)
                    $('#orderdata').DataTable().destroy();
                firstTime = 1;
                load_data(government, zone, center, from_date, to_date, gender, nationality,isQuarantine);

            } else {
                alert('Both Input is required');
            }
        }


        // var today = new Date();
        // var dd = String(today.getDate()).padStart(2, '0');
        // var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        // var yyyy = today.getFullYear();
        // today = yyyy + '-' + mm + '-' + dd;
        load_data($('#government_id').val(), $('#zone_id').val(),
            $('#pointOrCenter_id').val(), '', '', $('#gender').val(),$('#nationality').val(),$('#isQuarantine').val());

    })
    ;
</script>
