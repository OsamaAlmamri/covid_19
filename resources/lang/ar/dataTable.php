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

    'sEmptyTable' => "لم يعثر على اية سجل",
    'sInfo' => "اضهار _START_ الى _END_من اصل _TOTAL_ مدخل ",
    "sInfoEmpty" => "يعرض من 0 الى 0 من اصل 0 سجل ",
    "sInfoFiltered" => "(استثنا من مجموع _MAX_ تدخل )",
    "sInfoPostFix" => " Info Post Fix",
    "sInfoThousands" => "Info Thousands",
    "sLengthMenu" => "اظهر مدخلات _MENU_",
    "sLoadingRecords" => "Carregando...",
    "sProcessing" => "جاري التحميل ...",
    "sZeroRecords" => "لا يوجد بيانات ",
    "sSearch" => "بحث",
    "sNext" => "التالي",
    "sPrevious" => "السابق",
    "sFirst" => "الاول",
    "sLast" => "الاخير",
    "sSortAscending" => "ترتيب بحسب الاقدم ",
    "sSortDescending" => "ترتيب بحسب الاحدث ",


    'all' => 'الكل',
    'maxCapacity' => 'الطاقة الاستيعابية ',
    'zone_name' => ' المديرية',
    'government_name' => ' المحافظة',
    'quarantine_area_type' => 'النوع',
    'manager_phone' => ' رقم المدير',
    'manager_name' => ' اسم المدير',


    'username' => ' اسم المستخدم',
    'email' => 'الايميل',
    'w_phone' => 'رقم الهاتف',
    'name' => 'الاسم',
    'role' => 'الدور',
    'permissions' => 'الصلاحيات',
    'manage' => 'ادارة',
    'manageDeleted' => 'ادارة المحذوفات ',
    'deleted_by_name' => 'حذف بواسطة ',
    'created_by_name' => 'انشى بواسطة ',
    'status' => 'الحالة',
    'date' => 'التاريخ ',
    'created_at' => 'انشى بــ  ',
    'zones' => 'عرض المديريات',
    'code' => ' الكود',

    'avatar' => ' الصورة ',
    'tasks' => ' المهام ',
    'team' => ' الفريق ',


    'employee_number' => '  رقم الموظف ',
    'birthDate' => ' تاريخ الميلاد ',
    'join_date' => '  تاريخ الانضمام ',

    'birth_date' => '  تاريخ الميلاد',
    'assign' => '  اسناد الى الفريق',
    'addTotTeam' => '  اضافة  ',
    'country' => '  الدولة   ',
    'job' => '  الوظيفة  ',
    'gender' => '  الجنس  ',

    'other_place_data' => ' العزلة/القرية', //if is county is not yemen
    'ssn_type' => '  البطاقة او الجواز',//
    'ssn' => ' قم البطاقة او الجواز',//قم البطاقة او الجواز
    'job' => 'الوظيفة ',
    'phone' => 'رقم تلفون المريض/الوافد  ',
    'relative_phone' => 'رقم تلفون احد اقارب المريض/الوافد  ',
    'typeStatus' => 'typeStatus ',//checkAndTruckInPort => ' ' ,checkedAndCrossedFromPort => ' ' ,JustChecked => ' ' ,examinedAndQuarantined => ' ' ,noActionTaken
    'check_date' => ' تاريخ الكشف',
    'truck_number' => 'رقم القاطرة ',//رقم القاطرة اذا كان صاحب قاطرة
    'start_date_symptoms' => ' بداية ظهور الاعراض',//
    'sleeping' => ' الرقود',
    'sleep_date' => ' تاريخ الرقود ',
    'insulation_date' => 'تاريخ العزل / الحجر ',
    'status_at_reporting' => 'حالة المريض وقت الإبلاغ ',//stable - critical - healing

    'fever_symptoms' => ' حمى',//حمى
    'sore_throat_symptoms' => ' 	ألم الحلق',         //	ألم الحلق
    'cough_symptoms' => ' سعال',     //سعال
    'descent_from_the_nose_symptoms' => ' نزول من الانف',        //	نزول من الانف
    'breathing_difficulty_symptoms' => 'صعوبة التنفس ',        //صعوبة التنفس
    'headache_symptoms' => 'صداع ',        //صداع
    'pain_in_chest' => 'ألم في الصدر ',        //	ألم في الصدر
    'pain_in_the_joints' => ' الم في المفاصل',        //الم في المفاصل
    'others_symptoms' => ' اعراض اخرى  ',        //	اخرى
    //
    'heart_disease' => 'أمراض القلب ',        //"
    'blood_pressure_disease' => ' ضغط الدم',        //
    'diabetes_disease' => ' السكري',        //"السكري
    'immunodeficiency_diseases' => ' 	امراض نقص  المناعة',        //	"امراض نقص  المناعة
    'liver_diseases' => 'أمراض كبد ',        //	"أمراض كبد
    'chronic_respiratory_disease' => ' امراض  التهاب الجهاز التنفسي المزمن',        //	امراض  التهاب الجهاز التنفسي المزمن
    'kidney_disease' => ' امراض كلى',        //	"امراض كلى
    'other_diseases' => ' أخرى',        //	أخرى(حدد...)
    'is_pregnant' => ' اذا كانت حامل',//	"اذا كانت حامل
    'is_pregnant_in_first_3Month' => 'فترة الثلاثه الأشهر الأولى/الثانية/ الثالثة ',////فترة الثلاثه الأشهر الأولى/الثانية/ الثالثة"
    'after_childbirth' => ' بعدالولاده ( أي اقل من6أسابيع)',//"بعدالولاده ( أي اقل من6أسابيع)


    'is_comming_from_other_country' => 'هل وفد المريض من دولة/ منطقه موبوءة خلال 14 يوم؟ ',
    'come_from_country' => ' حدد الدولة/المنطقه',
    'comming_date' => ' التاريخ ',
    'out_from_country_date' => 'تاريخ الخروج من الدولة ',
    'comming_to_yemen_date' => ' تاريخ الدخول لليمن',


    'is_visit_health_center' => ' هل زارالمريض مرفقاً صحياً خلال 14يوم قبل  بدء الاعراض؟',
    'health_center_name' => '	 اسم المرفق الصحي ',
    'is_mix_other_people' => ' هل خالط المريض حالة COVID-19 مؤكده؟',
    'mix_people_type' => 'مخالطي المريض  ',//family => ' ' ,healthWorker => ' ' ,both => ' ' ,none
    'other_mix_people' => 'اخرين ',
    'is_patientIdentical_standard_definition' => '  هل المريض مطابق للتعريف الفياسي',

    'is_sample_collected' => '  هل تم جمع العينة',
    'is_sample_sent' => ' هل تم إرسال العينة',


    'sample_sent_date' => 'تاريخ ارسال العينة ',//indicates 2- passive 3- hangs 4- indecisive

    'situation_result' => 'نتيجة الحالة',
    'result_of_examining' => 'نتيجه فحص العينة ',//1-Cured//2-Dead //3-Reffered


    'if_dead_date' => ' في حالة الوفاة، حدد التاريخ	',
    'if_transfer_where' => '	في حالة التحويل حدد الي اين؟ ',

    'response_team_interventions' => 'تدخلات فرق الاستجابة  ',//
    'other_response_team_interventions' => ' ملاحظات و معلومات إضافية	',

    'age_year' => ' العمر بالسنين',
    'age_month' => ' العمر بالاشهر',
    'age_day' => ' العمر بالايام',
    'visit_zone' => ' اخر مديرية تم زيارتها',
    'center_zone' => ' اسم المرفق الصح',
    'transfer_zone' => ' المركز الصحي الذي تم نقلة الية ',
    'note' => ' ملاحظة ',
    'workType' => ' نوع العمل  ',
    'quarantine_type' => ' نوع مركز الحجر ',

    'allBlockPeople' => ' العدد التراكمي لمن تم حجرهم  ',
    'allBlockPeopleDead' => ' العدد التراكمي للمتوفين ',
    'allBlockPeopleOut' => 'العدد التراكمي للمغادرين من  المركز ',
    'allBlockPeopleNotOut' => ' العدد التراكمي للمتبقين بالمركز ',
    'allBlockPeopleTransform' => ' العدد التراكمي لمن تم نقلهم  من المركز ',
    'allTypes' => ' اجمالي مراكز الحجر',
    'typeStatus' => ' الاجراء المتخذ  ',
    'personal_info_checked_by' => '  تم فحص المعلومات الشخصية بواسطة',
    'medical_info_checked_by' => ' تم فحص المعلومات الطبية بواسطة',
    'id_issue_address' => ' مكان اصدار الهوية',
    'id_front_photo' => ' صورة امامية للهوية',
    'id_back_photo' => ' صورة خلفية للهوية',
    'id_issue_date' => 'تاريخ اصدار الهوية ',
    'martial_state' => ' الحالة الاجتماعية',
    'kids_number' => ' عدد الاطفال',
    'source_stay_reason' => ' سبب البقاء',
    'source_stay_job' => 'المهنة ',
    'source_how_check_info' => ' كيف التحقق من المعلومات',
    'source_pass_country' => 'قادم من بلد ',
    'source_stay_period' => 'فترة البقاء ',

    'dest_government' => ' المحافظة',
    'dest_zone' => ' المديرية',
    'dest_isolation_neighborhood' => ' العزلة/الحي',
    'dest_lane_village' => ' حارة/قرية',
    'dest_aqel_moaref' => 'العاقل/الشخص المعرف ',
    'dest_aqel_phone' => 'رقم العاقل/المعرف ',
    'dest_reason_of_coming_back' => ' سبب العودة',
    'dest_stay_period' => 'فترة الاقامة المتوقعة ',
    'dest_exit_date' => ' تاريخ الخروج',
    'dest_home_type' => ' نوع المنزل',
    'dest_transportation_owner' => ' ملكية وسيلة النقل',
    'dest_transportation_type' => ' نوع وسيلة النقل',
    'dest_transportation_number' => ' رقم وسيلة النقل',
    'insulation_end_date' => ' تاريخ نهاية العزل',

    'form_id' => ' رقم الاستمارة',//
    'bp_name' => ' الاسم  ',//
    'bp_type' => ' النوع  ',//
    'id_number' => ' رقم الهوية',//
    'id_type' => ' نوع الهوية ',//
    'step' => ' خطوة ',//
    'personal_info' => ' البيانات الشخصية ',//
    'dest_info' => ' بيانات جهة التوجة ',//
    'source_info' => ' بياناات جهة القدوم ',//
    'health_info' => ' البيانات الطبية ',//
    'last_governorate_visit' => ' اخر محافظة تم زيارتها ',//
    'last_zone_visit' => ' المديرية ',//
    'dest_governorate' => ' المحافظة ',//
    'personal' => ' شخصية ',//
    'passport' => ' جواز ',//
    'yes' => ' نعم ',//
    'no' => ' لا ',//
    'single' => ' عازب ',//
    'marrid' => ' المحافظة ',//
    'married' => 'متزوج',
    'divorced' => 'مطلق',
    'indecisive' => 'محجوز',
    'widowed' => 'ارمل',
    'people' => 'شخص ',
    'truck_owner' => 'صاحب قاطرة',
    'rent' => 'ايجار',
    'private' => 'ملك خاص',

    'log_description' => ' نوع التقرير',
    'file_type' => 'نوع الملف ',
    'how_phone' => 'رقم التلفون ',
    'log_created_at' => 'التاريخ ',

    'stable' => 'مستقرة ',
    'critical' => 'حرجة ',
    'healing' => 'شفاء ',
    'family' => 'اسرة المريض  ',
    'healthWorker' => 'العاملين الصحيين ',
    'both' => 'كلاهما ',
    'none' => 'لا احد ',
    'checkAndTruckInPort' => 'تم فحصها ولا تزال الشاحنة بالمنفذ ',
    'checkedAndCrossedFromPort' => 'تم فحصها ومغادرتها المنفذ ',
    'JustChecked' => 'تم فحصها فقط ',
    'examinedAndQuarantined' => 'تم فحصها و احالتها الى الحجر ',
    'runAway' => 'هرب ',
    'noActionTaken' => 'لم يتخذ اي اجراء ',

    'investigation' => 'تم التقصي تحت المتابعة ',
    'file_closed' => ' تمت المتابعة واغلاق الملف ',
    'case_was_lost' => 'فقدت الحالة ',
    'other' => 'أخرى اذكرها ',

    'cured' => 'شفيت ',
    'dead' => 'توفيت ',
    'referred' => 'احالة  ',
    'passive' => 'إيجابية ',
    'indicates' => 'سلبية ',
    'hangs' => 'معلقة ',
    'dest_sub_zone' => 'العزلة  ',
    'quar_government' => 'المحافظة  ',
    'quar_zone' => 'المديرية ',
    'quarantine_area_id' => 'مركز الحجر ',
    'check_point_id' => 'نقطة الفحص او التفتيش ',




    'add' => [
        'user' => 'اضافة مستخدم ',
        'quarantine' => 'اضافة مركز حجر ',
        'check_point' => 'اضافة نقطة تفتيش ',
        'workTeams' => '    اضافة شخص لفريق العمل   ',
        'quarantineType' => '    اضافة   نوع مركز حجر جديد   ',


    ],
    'update' => [
        'user' => 'تعديل المستخدم ',
        'quarantine' => 'تعديل المركز حجر ',
        'check_point' => 'تعديل نقطة التفتيش ',
        'workTeams' => '    تعديل  فريق العمل   ',
        'quarantineType' => '    تعديل المركز حجر الصحي   ',


    ],


    'btn' => [
        'pdf' => 'Pdf',
        'copy' => 'نسخ',
        'excel' => 'اكسل',
        'print' => 'طباعة',

    ],


];
