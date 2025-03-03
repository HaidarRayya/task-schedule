<?php

namespace App\Services;


class TaskRequestService
{
    /**
     *  get array of  TaskRrquestService attributes 
     *
     * @return array   of attributes
     */
    public function attributes()
    {
        return  [
            'title' => 'العنوان',
            'description' => 'الوصف',
            'priority' => 'الاولوية',
            'type' =>  'النوع',
            'due_date' => 'تاريخ انتهاء المهمة',
            'employee_id' => 'رقم الموظف'
        ];
    }
    /**
     *  
     * @param $validator
     *
     * throw a exception
     */
    public function failedValidation($validator)
    {
        return  $validator->errors();
    }
    /**
     *  get array of  TaskRrquestService messages 
     * @return array   of messages
     */
    public function messages()
    {
        return  [
            'string' => 'حقل :attribute  يجب ان يكون نص ',
            'title.min' => 'حقل :attribute يجب ان  يكون على الاقل 3 محرف',
            'description.min' => 'حقل :attribute يجب ان  يكون على الاقل 25 محرف',
            'max' => 'حقل :attribute يجب ان  يكون على الاكثر 255 محرف',
            'date_format' => 'حقل :attribute هو حقل تاريخ من الشكل سنة-شهر-يوم ساعة:دقيقة:ثانية',
            'after' => 'تاريخ المدخل خاطئ يجيب ان يكون اكبر من الوقت الحالي',
            'exists' =>  'حقل :attribute خاطئ يرجى التأكد من الرقم المدخل',
            'in' => 'ASC,DESC' . 'حقل :attribute يجب ان  يكون على احد القيم  ',
        ];
    }
}
