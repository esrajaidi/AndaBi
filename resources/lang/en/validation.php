<?php


return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'يجب قبول الحقل :attribute',
    'accepted_if' => 'الحقل :attribute مقبول في حال ما إذا كأن :other يساوي :value.',
    'active_url' => 'الحقل :attribute لا يُمثّل رابطًا صحيحًا',
    'after' => 'يجب على الحقل :attribute أن يكون تاريخًا لاحقًا للتاريخ :date.',
    'after_or_equal' => 'الحقل :attribute يجب أن يكون تاريخاً لاحقاً أو مطابقاً للتاريخ :date.',
    'alpha' => 'يجب أن لا يحتوي الحقل :attribute سوى على حروف',
    'alpha_dash' => 'يجب أن لا يحتوي الحقل :attribute على حروف، أرقام ومطّات.',
    'alpha_num' => 'يجب أن يحتوي :attribute على حروفٍ وأرقامٍ فقط',
    'array' => 'يجب أن يكون الحقل :attribute ًمصفوفة',
    'before' => 'يجب على الحقل :attribute أن يكون تاريخًا سابقًا للتاريخ :date.',
    'before_or_equal' => 'الحقل :attribute يجب أن يكون تاريخا سابقا أو مطابقا للتاريخ :date',
    'between' => [
        'array' => 'يجب أن يحتوي :attribute على عدد من العناصر بين :min و :max',
        'file' => 'يجب أن يكون حجم الملف :attribute بين :min و :max كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة :attribute بين :min و :max.',
        'string' => 'يجب أن يكون عدد حروف النّص :attribute بين :min و :max',
    ],
    'boolean' => 'يجب أن تكون قيمة الحقل :attribute إما true أو false ',
    'confirmed' => 'حقل التأكيد غير مُطابق للحقل :attribute',
    'current_password' => 'كلمة المرور غير صحيحة',
    'date' => 'الحقل :attribute ليس تاريخًا صحيحًا',
    'date_equals' => 'لا يساوي الحقل :attribute مع :date.',
    'date_format' => 'لا يتوافق الحقل :attribute مع الشكل :format.',
    'declined' => 'يجب رفض الحقل :attribute',
    'declined_if' => 'الحقل :attribute مرفوض في حال ما إذا كأن :other يساوي :value.',
    'different' => 'يجب أن يكون الحقلأن :attribute و :other مُختلفأن',
    'digits' => 'يجب أن يحتوي الحقل :attribute على :digits رقمًا/أرقام',
    'digits_between' => 'يجب أن يحتوي الحقل :attribute بين :min و :max رقمًا/أرقام',
    'dimensions' => 'الـ :attribute يحتوي على أبعاد صورة غير صالحة.',
    'distinct' => 'للحقل :attribute قيمة مُكرّرة.',
    'email' => 'يجب أن يكون :attribute عنوان بريد إلكتروني صحيح البُنية',
    'ends_with' => 'الـ :attribute يجب أن ينتهي بأحد القيم الأتية :value.',
    'enum' => 'الحقل :attribute غير صحيح',
    'exists' => 'الحقل :attribute لاغٍ',
    'file' => 'الـ :attribute يجب أن يكون من ملفا.',
    'filled' => 'الحقل :attribute إجباري',
    'gt' => [
        'array' => 'الـ :attribute يجب أن يحتوي على أكثر من :value عناصر/عنصر.',
        'file' => 'الـ :attribute يجب أن يكون اكبر من :value كيلو بايت.',
        'numeric' => 'الـ :attribute يجب أن يكون اكبر من :value.',
        'string' => 'الـ :attribute يجب أن يكون اكبر من :value حروفٍ/حرفًا.',
    ],
    'gte' => [
        'array' => 'الـ :attribute يجب أن يحتوي على :value عناصر/عنصر او أكثر.',
        'file' => 'الـ :attribute يجب أن يكون اكبر من او يساوي :value كيلو بايت.',
        'numeric' => 'الـ :attribute يجب أن يكون اكبر من او يساوي :value.',
        'string' => 'الـ :attribute يجب أن يكون اكبر من او يساوي :value حروفٍ/حرفًا.',
    ],
    'image' => 'يجب أن يكون الحقل :attribute صورةً',
    'in' => 'الحقل :attribute لاغٍ',
    'in_array' => 'الحقل :attribute غير موجود في :other.',
    'integer' => 'يجب أن يكون الحقل :attribute عددًا صحيحًا',
    'ip' => 'يجب أن يكون الحقل :attribute عنوان IP ذا بُنية صحيحة',
    'ipv4' => 'يجب أن يكون الحقل :attribute عنوان IPv4 ذا بنية صحيحة.',
    'ipv6' => 'يجب أن يكون الحقل :attribute عنوان IPv6 ذا بنية صحيحة.',
    'json' => 'يجب أن يكون الحقل :attribute نصا من نوع JSON.',
    'lt' => [
        'array' => 'الـ :attribute يجب أن يحتوي على اقل من :value عناصر/عنصر.',
        'file' => 'الـ :attribute يجب أن يكون اقل من :value كيلو بايت.',
        'numeric' => 'الـ :attribute يجب أن يكون اقل من :value.',
        'string' => 'الـ :attribute يجب أن يكون اقل من :value حروفٍ/حرفًا.',
    ],
    'lte' => [
        'array' => 'الـ :attribute يجب أن يحتوي على أكثر من :value عناصر/عنصر.',
        'file' => 'الـ :attribute يجب أن يكون اقل من او يساوي :value كيلو بايت.',
        'numeric' => 'الـ :attribute يجب أن يكون اقل من او يساوي :value.',
        'string' => 'الـ :attribute يجب أن يكون اقل من او يساوي :value حروفٍ/حرفًا.',
    ],
    'mac_address' => 'يجب أن يكون الحقل :attribute عنوان MAC ذا بنية صحيحة.',
    'max' => [
        'array' => 'يجب أن لا يحتوي الحقل :attribute على أكثر من :max عناصر/عنصر.',
        'file' => 'يجب أن لا يتجاوز حجم الملف :attribute :max كيلوبايت',
        'numeric' => 'يجب أن تكون قيمة الحقل :attribute مساوية أو أصغر لـ :max.',
        'string' => 'يجب أن لا يتجاوز طول نص :attribute :max حروفٍ/حرفًا',
    ],
    'mimes' => 'يجب أن يكون الحقل ملفًا من نوع : :values.',
    'mimetypes' => 'يجب أن يكون الحقل ملفًا من نوع : :values.',
    'min' => [
        'array' => 'يجب أن يحتوي الحقل :attribute على الأقل على :min عُنصرًا/عناصر',
        'file' => 'يجب أن يكون حجم الملف :attribute على الأقل :min كيلوبايت',
        'numeric' => 'يجب أن تكون قيمة الحقل :attribute مساوية أو أكبر لـ :min.',
        'string' => 'يجب أن يكون طول نص :attribute على الأقل :min حروفٍ/حرفًا',
    ],
    'multiple_of' => 'The :attribute must be a multiple of :value.',
    'not_in' => 'الحقل :attribute لاغٍ',
    'not_regex' => 'الحقل :attribute نوعه لاغٍ',
    'numeric' => 'يجب على الحقل :attribute أن يكون رقمًا',
    'password' => 'كلمة المرور غير صحيحة.',
    'present' => 'يجب تقديم الحقل :attribute',
    'prohibited' => 'الحقل :attribute محظور',
    'prohibited_if' => 'الحقل :attribute محظور في حال ما إذا كأن :other يساوي :value.',
    'prohibited_unless' => 'الحقل :attribute محظور في حال ما لم يكون :other يساوي :value.',
    'prohibits' => 'الحقل :attribute يحظر :other من اي يكون موجود',
    'regex' => 'صيغة الحقل :attribute .غير صحيحة',
    'required' => 'الحقل :attribute مطلوب.',
    'required_array_keys' => 'الحقل :attribute يجب أن يحتوي على مدخلات للقيم الأتية :values.',
    'required_if' => 'الحقل :attribute مطلوب في حال ما إذا كأن :other يساوي :value.',
    'required_unless' => 'الحقل :attribute مطلوب في حال ما لم يكن :other يساوي :values.',
    'required_with' => 'الحقل :attribute إذا توفّر :values.',
    'required_with_all' => 'الحقل :attribute إذا توفّر :values.',
    'required_without' => 'الحقل :attribute إذا لم يتوفّر :values.',
    'required_without_all' => 'الحقل :attribute إذا لم يتوفّر :values.',
    'same' => 'يجب أن يتطابق الحقل :attribute مع :other',
    'size' => [
        'array' => 'يجب أن يحتوي الحقل :attribute على :size عنصرٍ/عناصر بالظبط',
        'file' => 'يجب أن يكون حجم الملف :attribute :size كيلوبايت',
        'numeric' => 'يجب أن تكون قيمة الحقل :attribute مساوية لـ :size',
        'string' => 'يجب أن يحتوي النص :attribute على :size حروفٍ/حرفًا بالظبط',
    ],
    'starts_with' => 'الحقل :attribute يجب أن يبدأ بأحد القيم الأتية: :values.',
    'string' => 'يجب أن يكون الحقل :attribute نصآ.',
    'timezone' => 'يجب أن يكون :attribute نطاقًا زمنيًا صحيحًا',
    'unique' => 'قيمة الحقل :attribute مُستخدمة من قبل',
    'uploaded' => 'فشل في تحميل الـ :attribute',
    'url' => 'صيغة الرابط :attribute غير صحيحة',
    'uuid' => 'الحقل :attribute يجب أن ايكون رقم UUID صحيح.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'name'                  => 'الاسم',
        'username'              => 'اسم المُستخدم',
        'email'                 => 'البريد الإلكتروني',
        'first_name'            => 'الاسم',
        'last_name'             => 'اسم العائلة',
        'password'              => 'كلمة المرور',
        'password_confirmation' => 'تأكيد كلمة المرور',
        'city'                  => 'المدينة',
        'country'               => 'الدولة',
        'address'               => 'العنوان',
        'phone'                 => 'الهاتف',
        'mobile'                => 'الجوال',
        'age'                   => 'العمر',
        'sex'                   => 'الجنس',
        // 'gender'                => 'النوع',
        'day'                   => 'إلىوم',
        'month'                 => 'الشهر',
        'year'                  => 'السنة',
        'hour'                  => 'ساعة',
        'minute'                => 'دقيقة',
        'second'                => 'ثأنية',
        'content'               => 'المُحتوى',
        'description'           => 'الوصف',
        'excerpt'               => 'المُلخص',
        'date'                  => 'التاريخ',
        'time'                  => 'الوقت',
        'available'             => 'مُتاح',
        'size'                  => 'الحجم',
        'price'                 => 'السعر',
        'desc'                  => 'نبذه',
        'title'                 => 'العنوان',
        'q'                     => 'البحث',
        'link'                  => ' ',
        'slug'                  => ' ',
        'checkboxtr' =>  'الشروط والأحكام',
        'code'=>'رمز التحقق',
        'branches_id' =>'فرع',
        'account_number'=>'رقم الحساب',
        'account_type'=>'نوع الحساب',
        'account_openin_date'=>'تاريخ فتح الحساب',
        'account_closing_date'=>'تاريخ قفل الحساب',
        'customer_name'=>'اسم الزبون',
        'father_name'=>'اسم الأب',
        'grandfather_name'=>'اسم الجد',
        'the_surename'=>'اللقب بدون ال  التعريف',
        'full_mother_name'=>'اسم الأم ثلاثي',
        'gender'=>'الجنس',
        'place_of_birth'=>'مكان الميلاد',
        'date_of_birth'=>'تاريخ الميلاد',
        'martil_status'=>'الحالة الاجتماعية',
        'martil_status_other'=>'أخرى تحدد',
        'family_members'=>'عدد أفراد الاسرة',
        'residency_status'=>'وضع الإقامة',
        'nationality'=>'الجنسية',
        'other_nationality'=>'هل لديك جنسية أخرى؟',
        'other_nationality_yes'=>'في حالة الإجابة بنعم الرجاء تحديد',
        
        'passport_id_number'=>'رقم الوثيقة جواز السفر',
        'passport_place_issue'=>'مكان الإصدار جواز السفر',
        'passport_issue_date'=>'تاريخ الإصدار جواز السفر',
        'passport_expiry_date'=>'تاريخ الأنتهاء جواز السفر',

        'national_id_number'=>'رقم الوثيقة الرقم الوطني',
        'national_place_issue'=>'مكان الإصدار الرقم الوطني ',
        'national_expiry_date'=>'تاريخ الأنتهاء الرقم الوطني',
        'visa_type'=>'نوع التأشيرة',
        'visa_no'=>'رقم التأشيرة',
        'visa_expiry_date'=>'تاريخ الأنتهاء',

        'street' => 'الشارع',
        'region'=> 'المنطقة',
        'residence_type' => 'نوع السكن',
        'qualifiction'=>'المؤهل العلمي',
        'specialization'=>'التخصصص',
        'job_career'=>'الوظيقة او المهنة',
        'job_type'=>'الوظيقة او المهنة',
        'other_job_career'=>'أخرى',
        'name_previous_employer'=>'اسم جهة العمل السابقة',
        'name_present_employer'=>'اسم جهة العمل الحاليه',
        'address_employer'=>'عنوان جهة العمل',
        'employer_phone'=>'هاتف جهة العمل',
        'number_of_work_years'=>'عدد سنوات العمل',
        'job_title'=>'المسمي الوظيفي',
        'source_funds'=>'مصدر الأموال',
        'other_source_funds'=>'أخرى',
        'average_annual_income'=>'متوسط الدخل السنوي',
        'approximate_wealth_excpt_home'=>'الثروة التقريبية باستثناء المنزل',
        'required_service'=>'نوع الخدمات المطلوبة',
        'account_authorized_name'=>'اسم المفوض عن الحساب',
        'anticipated_activity_account'=>'النشاط المتوقع للحساب',
        'bank_branch'=>'المصرف / الفرع',
        'purpose_of_account'=>'الغرض من الحساب',   
        'type_service_used'=>'نوع الخدمات المستخدمة',      
        'authorized_name'=>'اسم المفوض',
        'real_beneficiary'=>'هل أنت المستفيد الحقيقي من الحساب',
        'personal_data_name'=>'اسم الشخصية المفوضة عن الحساب',
        'personal_data_relationship'=>'طبيعة الصلة أو العلاقة',

        'full_name_passport'=>'الاسم الثلاثي حسب جواز السفر',
        'has_american'=>'هل لديك الجنسية الأمريكية',
        'tax_id_number'=>'رقم التعريف الضريبي ',
        'doucment'=>'نوع الوثيقة',
        'doucment_number'=>'رقم الوثيقة',
        'place_issue'=>'مكان الإصدار',
        'issue_date'=>'تاريخ الإصدار',
        'expiry_date'=>'تاريخ الأنتهاء',
        'has_political'=>'لديه منصب سياسي',
        'relation'=>'طبيعة الصلة او نشاط',
        'political_postions'=>' المنصب',
        'home_phone'=>'هاتف المنزل',
        'phone_number'=>'رقم الهاتف',
        'personal_image'=>'الصورة',
        'passport_file'=>'صورة جواز السفر',
        'national_file'=>'صورة رقم الوطني',
        'employer_message_file'=>'صورة رسالة جهة العمل',
        'message_text'=>'نص الرسالة',
        'file_phone_number'=>' ملف excel',
        'captcha'=>'الرمز',
        'statement'=>'البيان',
        'hiddenBy'=>'الجهة التي أصدرت التجميد',
        'dateofreceivedMessage'=>'تاريخ الرسالة الواردة',
        'index'=>'الرقم الاشاري',
        'notes'=>'ملاحظه',
        'statu'=>'الحالة',
        'file_name'=>'إسم الملف'

    
        

              










    ],
    

];
