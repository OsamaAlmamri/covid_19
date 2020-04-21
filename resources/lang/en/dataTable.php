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
    'zone_name' => 'zone name',
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


    'other_place_data' => ' other place data', //if is county is not yemen
    'ssn_type' => 'ssn type',//
    'ssn' => ' ssn ',//قم البطاقة او الجواز
    'job' => 'job ',
    'w_phone' => 'phone  ',
    'relative_phone' => 'relative phone  ',
    'typeStatus' => 'typeStatus ',//checkAndTruckInPort => ' ' ,checkedAndCrossedFromPort => ' ' ,JustChecked => ' ' ,examinedAndQuarantined => ' ' ,noActionTaken
    'check_date' => ' check date',
    'truck_number' => 'truck number  ',//رقم القاطرة اذا كان صاحب قاطرة
    'start_date_symptoms' => ' start date symptoms  ',//
    'sleeping' => ' sleeping',
    'sleep_date' => ' sleep date  ',
    'insulation_date' => 'insulation date',
    'status_at_reporting' => 'status at reporting',//stable - critical - healing

    'fever_symptoms' => ' fever symptoms',//حمى
    'sore_throat_symptoms' => ' 	sore throat symptoms',         //	ألم الحلق
    'cough_symptoms' => ' cough symptoms',     //سعال
    'descent_from_the_nose_symptoms' => ' descent from the nose symptoms',        //	نزول من الانف
    'breathing_difficulty_symptoms' => 'صعوبة breathing difficulty symptoms ',        //صعوبة التنفس
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


    'is_comming_from_other_country' => 'is comming from other country ',
    'come_from_country' => ' come from country',
    'comming_date' => ' comming date ',
    'out_from_country_date' => 'out from country date  ',
    'comming_to_yemen_date' => ' comming_to_yemen_date  ',


    'is_visit_health_center' => 'is visit health center',
    'health_center_name' => '	health center name',
    'is_mix_other_people' => 'is mix other people',
    'mix people type' => 'mix people type',//family => ' ' ,healthWorker => ' ' ,both => ' ' ,none
    'other_mix_people' => 'other mix people ',
    'is_patientIdentical_standard_definition' => ' is patientIdentical standard definition',

    'is_sample_collected' => '  is sample collected',
    'is_sample_sent' => ' is sample sent  ',
    'sample_sent_date' => ' sample sent date',
    'result_of_examining' => 'result_of_examining   ',//indicates 2- passive 3- hangs 4- indecisive

    'situation_result' => 'situation result ',//1-Cured//2-Dead //3-Reffered



    'if_dead_date' => 'if dead date	',
    'if_transfer_where' => '	if transfer where',

    'response_team_interventions' => 'response team interventions ',//investigation => ' ' ,file_closed => ' ' ,case_was_lost => ' ' ,other
    'other_response_team_interventions' => 'other response team interventions	',

    'age_year' => 'age by year ',
    'age_month' => ' age by month',
    'age_day' => 'age day ',
    'visit_zone' => 'last visit zone ',
    'center_zone' => ' health center name',
    'mix_people_type' => ' mix people type',
    'transfer_zone' => 'transfer zone ',
    'note' => ' note',
    'workType' => ' work Type   ',





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
    'gender' => ' gender ',
    'avatar' => ' avatar ',
    'tasks' => ' tasks ',
    'team' => ' team ',




    'add' => [
        'User' => 'Add User',
        'quarantine' => 'Add quarantine',
        'check_point' => ' add   check point',
        'workTeams' => ' add team worker  ',

    ],
    'update' => [
        'user' => 'Update User',
        'quarantine' => 'Update quarantine',
        'check_point' => ' Update   check point',
        'workTeams' => ' Update team worker  ',


    ],


    'btn' => [
        'pdf' => 'Pdf',
        'copy' => 'copy',
        'excel' => 'excel',
        'print' => 'print',

    ],













];
