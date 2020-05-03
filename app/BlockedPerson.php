<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;


class BlockedPerson extends Model
{
    use SoftDeletes;
    use LogsActivity;

    //
    protected $fillable = [
        'entry_date',
        'req_id',
        'bp_name',
        'gender',
        'zone_id',//if is county is yemen
        'other_place_data',//if is county is not yemen
        'id_type',//قم البطاقة او الجواز
        'id_number',//قم البطاقة او الجواز
        'typeStatus',//checkAndTruckInPort,checkedAndCrossedFromPort,
        //JustChecked,examinedAndQuarantined,noActionTaken
        'check_point_id',
        'bp_type',//track owner or people
        'bp_from',//yemeni,arabic,//align
        'country',//if is county is not yemen
        'truck_number',//رقم القاطرة اذا كان صاحب قاطرة
        'check_date',
        ////////////////////////////

        'personal_info_checked_by',
        'medical_info_checked_by',
        'id_issue_address',
        'id_front_photo',
        'id_back_photo',
        'id_issue_date',
        'martial_state',
        'kids_number',
        'source_stay_reason',
        'source_stay_job',
        'source_stay_period',
        'source_how_check_info',
        'source_pass_country',

        'dest_zone_id',
        'dest_isolation_neighborhood',
        'dest_lane_village',
        'dest_aqel_moaref',
        'dest_aqel_phone',
        'dest_reason_of_coming_back',
        'dest_stay_period',
        'dest_exit_date',
        'dest_home_type',
        'dest_transportation_owner',
        'dest_transportation_type',
        'dest_transportation_number',
        'insulation_end_date',
        'form_id',//رقم الاستمارة


        ///////////
        'gov_code',
        'district_code',
        'sub_district_code',
        'hara_vill_code',
        'sub_hara_vill_code',


        /******* come_from_country *******/
        'is_comming_from_other_country',
        'come_from_country',
//        'comming_date',
        'out_from_country_date',
        'comming_to_yemen_date',


        'insulation_date',
        'phone',
        'birth_date',
        'job',
        'relative_phone',
        'quarantine_district_id',//############
        'syncStatus',//***********
        'last_zone_visit_id',//
        'start_date_symptoms',//داية ظهور الاعراض
        'status_at_reporting',//stable - critical - healing
        'fever_symptoms',//حمى
        'sore_throat_symptoms',         //	ألم الحلق
        'cough_symptoms',     //سعال
        'descent_from_the_nose_symptoms',        //	نزول من الانف
        'breathing_difficulty_symptoms',        //صعوبة التنفس
        'headache_symptoms',        //صداع
        'pain_in_chest',        //	ألم في الصدر
        'pain_in_the_joints',        //الم في المفاصل
        'others_symptoms',        //	اخرى
        'heart_disease',        //"أمراض القلب
        'blood_pressure_disease',        //	ضغط الدم
        'diabetes_disease',        //"السكري
        'immunodeficiency_diseases',        //	"امراض نقص  المناعة
        'liver_diseases',        //	"أمراض كبد
        'chronic_respiratory_disease',        //	امراض  التهاب الجهاز التنفسي المزمن
        'kidney_disease',        //	"امراض كلى
        'other_diseases',        //	أخرى(حدد...)

        'is_visit_health_center',
        'health_center_name',
        'is_mix_other_people',
        'mix_people_type',//family,healthWorker,both,none
        'other_mix_people',


        'sleeping',
        'sleep_date',

//******************* اذاكان انثى او فيها بعض الاعراض ممكن تتحول الى عمود واحد بالاضافة الى none  ********************//
        'is_pregnant',//	"اذا كانت حامل
        'is_pregnant_in_first_3Month',////فترة الثلاثه الأشهر الأولى/الثانية/ الثالثة"
        'after_childbirth',//"بعدالولاده ( أي اقل من6أسابيع)


        /******* lab info *******/
        'is_patientIdentical_standard_definition',
        'is_sample_collected',
        'is_sample_sent',
        'sample_sent_date',
        'result_of_examining',//indicates 2- passive 3- hangs 4- indecisive


        'situation_result',//1-Cured//2-Dead //3-Reffered
        'if_dead_date',
        'if_transfer_where',
        'out_date',

        'response_team_interventions',//investigation,file_closed,case_was_lost,other
        'other_response_team_interventions',
        'note',
        'deleted_by',
        'created_by',


    ];
}
