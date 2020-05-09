<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Pagination Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the paginator library to build
    | the simple pagination links. You are free to change them to anything
    | you want to customize your views to better match your application.
    |
    */
    'sEmptyTable' => "Info Empty",
    'sInfo' => "Info",
    "sInfoEmpty" => "يعرض من 0 الى 0 من اصل 0 سجل ",
    "sInfoFiltered" => "(استثنا من مجموع _MAX_ تدخل )",
    "sInfoPostFix" => " Info Post Fix",
    "sInfoThousands" => "Info Thousands",
    "sLengthMenu" => "Length Menu _MENU_",
    "sLoadingRecords" => "Carregando...",
    "sProcessing" => "Processing ...",
    "sZeroRecords" => "Zero Records",
    "sSearch" => "search",
    "sNext" => "Next",
    "sPrevious" => "Previous",
    "sFirst" => "First ",
    "sLast" => "Last",
    "sSortAscending" => ": Ordenar colunas de forma ascendente",
    "sSortDescending" => ": Ordenar colunas de forma descendente",
//maxCapacity,zone_name,government_name,quarantine_area_type
    'maxCapacity' => 'max Capacity',
    'zone_name' => 'districts name',
    'government_name' => 'government name',
    'quarantine_area_type' => 'type',
    'manager_phone' => 'manager phone',
    'manager_name' => 'manager name',
    'birth_date' => ' birth date',
    'assign' => ' assign',
    'addTotTeam' => '  add  ',
    'country' => '  country  ',
    'job' => '  job  ',
    'gender' => '  gender  ',


    'other_place_data' => ' Area-village', //if is county is not yemen
    'ssn_type' => 'identifier type ',//
    'ssn' => ' identifier number ',//قم البطاقة او الجواز
    'job' => 'job ',
    'w_phone' => 'phone  ',
    'relative_phone' => 'relative phone  ',
    'typeStatus' => 'typeStatus ',//checkAndTruckInPort => ' ' ,checkedAndCrossedFromPort => ' ' ,JustChecked => ' ' ,examinedAndQuarantined => ' ' ,noActionTaken
    'check_date' => ' check date',
    'truck_number' => 'truck number  ',//رقم القاطرة اذا كان صاحب قاطرة
    'start_date_symptoms' => ' start date symptoms  ',//
    'sleeping' => ' hospitalization',
    'sleep_date' => ' date hospitalization   ',
    'insulation_date' => 'insulation date',
    'status_at_reporting' => 'status at reporting',//stable - critical - healing

    'fever_symptoms' => ' fever symptoms',//حمى
    'sore_throat_symptoms' => ' 	sore throat symptoms',         //	ألم الحلق


    'cough_symptoms' => ' cough symptoms',     //سعال
    'descent_from_the_nose_symptoms' => ' runny nose symptoms',        //	نزول من الانف
    'breathing_difficulty_symptoms' => ' Difficulty of breathing ',        //صعوبة التنفس
    'headache_symptoms' => 'headache symptoms ',        //صداع
    'pain_in_chest' => 'pain in chest   ',        //	ألم في الصدر
    'pain_in_the_joints' => ' pain in the joints  ',        //الم في المفاصل
    'others_symptoms' => ' others symptoms   ',        //	اخرى
    //
    'heart_disease' => 'heart disease  ',        //"
    'blood_pressure_disease' => ' blood pressure disease ',        //
    'diabetes_disease' => ' diabetes disease',        //"السكري
    'immunodeficiency_diseases' => ' 	immunodeficiency diseases   ',        //	"امراض نقص  المناعة
    'liver_diseases' => 'liver diseases  ',        //	"أمراض كبد
    'chronic_respiratory_disease' => ' chronic respiratory disease',        //	امراض  التهاب الجهاز التنفسي المزمن
    'kidney_disease' => '  kidney disease',        //	"امراض كلى
    'other_diseases' => ' other diseases',        //	أخرى(حدد...)
    'is_pregnant' => '   is pregnant',//	"اذا كانت حامل
    'is_pregnant_in_first_3Month' => 'is pregnant in first 3Month ',////فترة الثلاثه الأشهر الأولى/الثانية/ الثالثة"
    'after_childbirth' => ' after childbirth',//"بعدالولاده ( أي اقل من6أسابيع)


    'is_comming_from_other_country' => 'Is  coming from other country ?  ',
    'come_from_country' => ' come from country',
    'comming_date' => ' comming date ',
    'out_from_country_date' => ' exit  from country date  ',
    'comming_to_yemen_date' => ' date of entry to Yemen  ',


    'is_visit_health_center' => 'is visit health center',
    'health_center_name' => '	health center name',
    'is_mix_other_people' => 'is mix other people',
    'mix people type' => 'mix people type',//family => ' ' ,healthWorker => ' ' ,both => ' ' ,none
    'other_mix_people' => 'other mix people ',
    'is_patientIdentical_standard_definition' => ' is patientIdentical standard definition',

    'is_sample_collected' => '  is sample collected',
    'is_sample_sent' => ' is sample sent  ',
    'sample_sent_date' => ' sample sent date',
    'result_of_examining' => 'result of examining   ',//indicates 2- passive 3- hangs 4- indecisive

    'situation_result' => 'situation result ',//1-Cured//2-Dead //3-Reffered


    'if_dead_date' => 'if dead date	',
    'if_transfer_where' => '	if transfer where',

    'response_team_interventions' => 'response team interventions ',//investigation => ' ' ,file_closed => ' ' ,case_was_lost => ' ' ,other
    'other_response_team_interventions' => 'other response team interventions	',

    'age_year' => 'age by year ',
    'age_month' => ' age by month',
    'age_day' => 'age day ',
    'visit_zone' => 'last visit districts ',
    'center_zone' => ' health center name',
    'mix_people_type' => ' mix people type',
    'transfer_zone' => 'transfer districts ',
    'note' => ' note',
    'workType' => ' work Type   ',
    'quarantine_type' => ' َQuarantine ِArea Type  ',


    'username' => 'User Name',
    'email' => 'Email',
    'phone' => 'Phone',
    'name' => 'Name',
    'role' => 'Role',
    'permissions' => 'Permissions',
    'manage' => 'Manage',
    'manageDeleted' => 'Manage Deleted',
    'deleted_by_name' => 'Deleted By ',
    'created_by_name' => 'Created By ',
    'status' => 'Status',
    'date' => 'Date ',
    'created_at' => 'Created At ',
    'code' => ' code',

    'employee_number' => ' employee number ',
    'birthDate' => ' birthDate ',
    'join_date' => ' join date ',
    'avatar' => ' avatar ',
    'tasks' => ' tasks ',
    'team' => ' team ',


    'all' => 'all',

    'zones' => 'show districts ',


    'allBlockPeople' => ' Cumulative number of quarantined persons ',
    'allBlockPeopleDead' => ' Cumulative number of deceased persons',
    'allBlockPeopleOut' => 'The cumulative number of departures from the center ',
    'allBlockPeopleNotOut' => ' The cumulative number of remaining in the center ',
    'allBlockPeopleTransform' => ' The cumulative number of those transferred from the center ',
    'allTypes' => ' Total ',

    'personal_info_checked_by' => ' personal info checked by',
    'medical_info_checked_by' => ' health info checked by',
    'id_issue_address' => ' id issue address  ',
    'id_front_photo' => ' id front photo  ',
    'id_back_photo' => 'id back photo',
    'id_issue_date' => 'id issue date   ',
    'martial_state' => ' martial state ',
    'kids_number' => ' kids number ',
    'source_stay_reason' => ' stay reason ',
    'source_stay_job' => 'job ',
    'source_how_check_info' => ' how check info   ',
    'source_pass_country' => 'Pass country   ',
    'source_stay_period' => 'stay period  ',

    'dest_government' => ' government',
    'dest_zone' => ' districts',
    'dest_sub_zone' => 'town  ',

    'dest_isolation_neighborhood' => ' neighborhood',
    'dest_lane_village' => ' village',
    'dest_aqel_moaref' => 'Aqel/Know Pearson',
    'dest_aqel_phone' => 'phone',
    'dest_reason_of_coming_back' => ' coming back Reason ',
    'dest_stay_period' => 'Expected Stay Period   ',
    'dest_exit_date' => ' exit_date ',
    'dest_home_type' => ' Home Type ',
    'dest_transportation_owner' => ' transportation owner  ',
    'dest_transportation_type' => 'transportation type',
    'dest_transportation_number' => 'transportation number',
    'insulation_end_date' => ' تاريخ نهاية العزل',

    'form_id' => ' form number',//
    'bp_name' => ' name  ',//
    'bp_type' => ' type  ',//
    'id_number' => ' ID Number ',//
    'id_type' => ' ID Type ',//
    'step' => ' Step ',//
    'personal_info' => '  Personal Info ',//
    'dest_info' => ' Destination Info ',//
    'source_info' => 'Source Info ',//
    'health_info' => ' Info Medical ',//
    'last_governorate_visit' => ' Last Government Visited ',//
    'last_zone_visit' => ' District ',//
    'dest_governorate' => ' Government ',//
    'personal' => ' personal ',//
    'passport' => ' passport ',//
    'yes' => ' yes ',//
    'no' => ' no ',//
    'single' => ' single ',//
    'married' => 'divorced',
    'divorced' => 'divorced',
    'indecisive' => 'indecisive',
    'widowed' => 'widowed',
    'people' => 'people ',
    'truck_owner' => 'Truck Owner ',
    'rent' => 'rent',
    'private' => 'private ',

    'stable' => 'stable ',
    'critical' => 'critical ',
    'healing' => 'healing ',
    'family' => 'family   ',
    'healthWorker' => 'health Worker  ',
    'both' => 'both ',

    'log_description' => ' Report Type ',
    'file_type' => 'File Export Type  ',
    'how_phone' => ' Phone ',
    'log_created_at' => 'Export Date ',

    'none' => ' none ',
    'checkAndTruckInPort' => 'check And Truck In Port ',
    'checkedAndCrossedFromPort' => 'Checked And Crossed From Port ',
    'JustChecked' => 'Just Checked   ',
    'examinedAndQuarantined' => 'Examined  And Quarantined',
    'runAway' => 'RunAway ',
    'noActionTaken' => 'No Action Taken ',

    'investigation' => ' investigation',
    'file_closed' => ' file closed ',
    'case_was_lost' => ' case was lost ',
    'other' => 'other  ',

    'bp_from' => 'Nationality ',
    'yemeni' => 'Yemeni ',
    'align' => 'Align ',
    'temporary' => 'Temporary ',
    'military' => 'Military ',
    'card_family' => 'Family ',
    'cured' => 'cured ',
    'dead' => 'dead ',
    'referred' => 'referred  ',
    'passive' => 'passive ',
    'indicates' => 'indicates ',
    'hangs' => 'hangs ',
    'dest_sub_zone' => 'العزلة  ',
    'quar_government' => 'Government  ',
    'quar_zone' => 'District ',
    'quarantine_area_id' => 'Quarantine Area  ',
    'check_point_id' => 'Check Point  ',



    'add' => [
        'User' => 'Add User',
        'quarantine' => 'Add quarantine',
        'check_point' => ' add   check point',
        'workTeams' => ' add team worker  ',
        'quarantineType' => 'Add New quarantine Type',


    ],
    'update' => [
        'user' => 'Update User',
        'quarantine' => 'Update quarantine',
        'check_point' => ' Update   check point',
        'workTeams' => ' Update team worker  ',
        'quarantineType' => ' Update quarantine Type',


    ],


    'btn' => [
        'pdf' => 'Pdf',
        'copy' => 'copy',
        'excel' => 'excel',
        'print' => 'print',

    ],


];
