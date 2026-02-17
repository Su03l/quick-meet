<div align="center">

# QuickMeet API

### نظام إدارة الاجتماعات الذكي وتتبع الأجندة الاحترافي

<p>
    <a href="#"><img src="https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel" /></a>
    <a href="#"><img src="https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP" /></a>
    <a href="#"><img src="https://img.shields.io/badge/Sanctum-Auth-38BDF8?style=for-the-badge&logo=laravel&logoColor=white" alt="Sanctum" /></a>
    <a href="#"><img src="https://img.shields.io/badge/API-Documentation-orange?style=for-the-badge&logo=swagger" alt="Scramble Docs" /></a>
</p>

<p>
    <img src="https://img.shields.io/badge/License-MIT-blue?style=flat-square" alt="License" />
    <img src="https://img.shields.io/badge/Status-Development-yellow?style=flat-square" alt="Status" />
</p>

<br>

**QuickMeet** هو محرك متطور لإدارة الاجتماعات، يهدف إلى تنظيم الوقت ورفع كفاءة الجلسات النقاشية. يوفر النظام أدوات دقيقة لتتبع بنود الأجندة، إدارة الحضور، وتوليد تقارير PDF فورية. تم بناء النظام ليكون Headless API متوافق مع تطبيقات الويب والموبايل الحديثة.

</div>

---

## أبرز الحلول التقنية

| التحدي | الحل الذكي في QuickMeet |
| :------------------ | :--------------------------------------------------------------------------- |
| **إدارة الوقت** | نظام **Meeting Timers** لحساب المدة الفعلية للاجتماع بدقة |
| **تتبع الأجندة** | إمكانية تحديث حالة بنود الاجتماع (Toggle) في الوقت الفعلي |
| **التقارير الفورية** | محرك **DomPDF** لتوليد محاضر اجتماعات احترافية بضغطة زر |
| **سهولة الانضمام** | نظام **Guest Registration** يسمح للمشاركين بالانضمام دون الحاجة لتعقيدات التسجيل |

<br>

## المميزات الرئيسية

<div align="center">

`Meeting Lifecycle` &nbsp; `Agenda Tracking` &nbsp; `PDF Reporting`
<br>
`Participant Management` &nbsp; `Secure Authentication` &nbsp; `Profile Customization`

</div>

---

## توثيق الواجهة البرمجية (API)

يمكنك الوصول للتوثيق التفاعلي (Scramble) عبر الرابط `/docs/api` عند التشغيل.

### 1. المصادقة والملف الشخصي

| الطريقة | المسار | الوصف |
| :------ | :--------------- | :----------------------------------------- |
| `POST`  | `/api/register`  | إنشاء حساب منظم جديد |
| `POST`  | `/api/login`     | تسجيل الدخول وإصدار توكن Sanctum |
| `GET`   | `/api/profile`   | جلب بيانات المنظم الشخصية |
| `PUT`   | `/api/profile/update` | تحديث بيانات الملف الشخصي |

### 2. إدارة الاجتماعات (Meetings)

| الطريقة | المسار | الوصف |
| :------ | :--------------------- | :------------------------ |
| `GET`   | `/api/meetings`        | عرض قائمة الاجتماعات الخاصة بالمنظم |
| `POST`  | `/api/meetings`        | إنشاء اجتماع جديد مع الأجندة |
| `PATCH` | `/api/meetings/{id}/status` | بدء أو إنهاء مؤقت الاجتماع |
| `GET`   | `/api/meetings/{id}/export` | تصدير محضر الاجتماع بصيغة PDF |

### 3. المشاركين والأجندة (Participants & Agenda)

| الطريقة | المسار | الوصف |
| :------ | :------------------------------- | :----------------------------------------- |
| `POST`  | `/api/meetings/{id}/register-participant` | تسجيل حضور (ضيف) للاجتماع |
| `GET`   | `/api/meetings/{id}/participants` | عرض قائمة الحضور للاجتماع |
| `PATCH` | `/api/meetings/{id}/agenda/{item}/toggle` | تحديث حالة بند في الأجندة (مكتمل/غير مكتمل) |

---

## هيكلية المشروع (Architecture)

يتبع المشروع أفضل ممارسات Laravel لضمان الأداء والقابلية للتوسع:

- **Controllers**: معالجة الطلبات وتوجيهها للخدمات المناسبة.
- **API Resources**: توحيد شكل البيانات المرجعة (JSON Transformation).
- **Sanctum Middleware**: حماية المسارات الحساسة والتحقق من الهوية.
- **PDF Services**: معالجة وتوليد التقارير باستخدام قوالب Blade مخصصة.

---

## المتطلبات التقنية

- PHP >= 8.2
- MySQL >= 8.0
- Composer

---

## التثبيت والتشغيل

### 1. إعداد المشروع
قم باستنساخ المستودع والدخول إلى مجلد المشروع:
```bash
git clone https://github.com/your-username/quick-meet.git
cd quick-meet/backend
```

### 2. تثبيت الاعتمادات
```bash
composer install
```

### 3. إعداد البيئة
```bash
cp .env.example .env
php artisan key:generate
```
> **ملاحظة:** تأكد من إعداد قاعدة البيانات في ملف `.env`.

### 4. قاعدة البيانات
```bash
php artisan migrate
```

### 5. تشغيل السيرفر
```bash
php artisan serve
```

---

<div align="center">
صنع بواسطة المهندس سليمان
</div>
