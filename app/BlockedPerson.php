<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlockedPerson extends Model
{
    use SoftDeletes;

    //
    protected $fillable = [
        'bp_name',
        'gender',
        'birth_date',
        'zone_id',//if is county is yemen
        'country',//if is county is not yemen
        'other_place_data',//if is county is not yemen
        'ssn_type',//قم البطاقة او الجواز
        'ssn',//قم البطاقة او الجواز
        'job',
        'phone',
        'relative_phone',
        'typeStatus',//checkAndTruckInPort,checkedAndCrossedFromPort,JustChecked,examinedAndQuarantined,noActionTaken
        'check_date',
        'check_point_id',
        'quarantine_area_id',
        'bp_type',//track owner or people
        'bp_from',//yemeni,arabic,//align
        'truck_number',//رقم القاطرة اذا كان صاحب قاطرة
        'last_zone_visit_id',//
        'start_date_symptoms',//داية ظهور الاعراض
        'sleeping',
        'sleep_date',
        'insulation_date',
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
        //
        'heart_disease',        //"أمراض القلب
        'blood_pressure_disease',        //	ضغط الدم
        'diabetes_disease',        //"السكري
        'immunodeficiency_diseases',        //	"امراض نقص  المناعة
        'liver_diseases',        //	"أمراض كبد
        'chronic_respiratory_disease',        //	امراض  التهاب الجهاز التنفسي المزمن
        'kidney_disease',        //	"امراض كلى
        'other_diseases',        //	أخرى(حدد...)
        'is_pregnant',//	"اذا كانت حامل
        'is_pregnant_in_first_3Month',////فترة الثلاثه الأشهر الأولى/الثانية/ الثالثة"
        'after_childbirth',//"بعدالولاده ( أي اقل من6أسابيع)
        'is_comming_from_other_country',
        'come_from_country',
        'comming_date',
        'out_from_country_date',
        'comming_to_yemen_date',

        'is_visit_health_center',
        'health_center_name',
        'is_mix_other_people',
        'mix_people_type',//family,healthWorker,both,none
        'other_mix_people',

        'is_patientIdentical_standard_definition',
        'is_sample_collected',
        'is_sample_sent',
        'sample_sent_date',
        'result_of_examining',//indicates 2- passive 3- hangs 4- indecisive

        'situation_result',//1-Cured//2-Dead //3-Reffered
        'if_dead_date',
        'if_transfer_where',

        'response_team_interventions',//investigation,file_closed,case_was_lost,other
        'other_response_team_interventions',
        'note',
        'deleted_by',
        'created_by',
    ];
}
