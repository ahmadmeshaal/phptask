barbershop/
├── config/
│   ├── database.php        ← اتصال PDO (حطه بـ .gitignore)
│   └── database.example.php← نسخة بدون باسورد ترفعها على GitHub
├── includes/
│   ├── auth.php            ← دوال: requireLogin(), requireAdmin(), isLoggedIn()
│   ├── functions.php       ← دوال مساعدة: escape, flash messages, validation
│   ├── header.php          ← أعلى الصفحة (navbar، CSS)
│   └── footer.php          ← أسفل الصفحة (scripts)
├── public/                 ← الصفحات اللي المستخدم بفتحها
│   ├── index.php           ← عرض المواعيد المتاحة
│   ├── register.php
│   ├── login.php
│   ├── logout.php
│   ├── reserve.php         ← إنشاء حجز (POST)
│   ├── my_reservations.php
│   └── cancel.php          ← إلغاء حجز (POST)
├── admin/                  ← كل ملف بيبدأ بـ requireAdmin()
│   ├── dashboard.php       ← الإحصائيات + Chart.js
│   ├── reservations.php    ← بحث وفلترة وتغيير حالة
│   ├── users.php
│   └── slots.php           ← إضافة وتعديل وحذف المواعيد
├── assets/
│   ├── css/style.css
│   └── js/
├── database/
│   └── schema.sql          ← الجداول + Seed Data
├── .gitignore
└── README.md





# تحليل المطلوب (Barbershop Reservation System)

الفكرة بالمختصر: **Time Slot** = موعد في الصالون (تاريخ + من/إلى + السعة، أي عدد الكراسي أو الحلاقين). **Reservation** = حجز المستخدم لهذا الموعد.

**الكيانات (Entities) الأساسية:**
- **Users**: الاسم، الإيميل، الباسورد المشفّر، الدور (user/admin)، حالة التفعيل
- **Time Slots**: التاريخ، وقت البداية، وقت النهاية، السعة
- **Reservations**: المستخدم، الموعد، ملاحظة اختيارية، الحالة (Pending / Confirmed / Rejected / Cancelled)

**قرارات لازم تحسمها قبل البدء:**
- شو الانتقالات المسموحة للحالات؟ مثلاً: Pending ← Confirmed أو Rejected أو Cancelled، وConfirmed ← Cancelled فقط. وRejected وCancelled نهائيتان.
- قاعدة "ما بيحجز نفس الموعد مرتين": إذا المستخدم لغى حجزه، هل بيقدر يحجز نفس الموعد مرة ثانية؟ اللي بيطلع منطقي إن الحجز الفعّال (Pending أو Confirmed) هو اللي بيمنع التكرار. قرّر واكتب قرارك في الـ README.
- السعة المتبقية = السعة − عدد الحجوزات اللي حالتها Pending أو Confirmed فقط.

---

# تقسيم التاسكات والمواضيع المطلوبة لكل تاسك

## Task 0: التجهيز والـ Setup
**المواضيع:** تشغيل XAMPP أو أي بيئة PHP + MySQL، هيكلة مجلدات المشروع، أساسيات Git وGitHub (init, add, commit, push, branch)، وكتابة commit messages مفهومة.

## Task 1: تصميم قاعدة البيانات
**المواضيع:** تصميم الجداول وتحديد الـ Data Types، الـ Primary Key والـ Foreign Key، علاقات One-to-Many، قيود `UNIQUE` و`NOT NULL` و`ENUM`، فكرة `ON DELETE`، وبيانات تجريبية (Seed Data) فيها admin وuser.

## Task 2: الاتصال بقاعدة البيانات
**المواضيع:** PDO في PHP، الـ Prepared Statements (للحماية من SQL Injection)، التعامل مع الأخطاء بـ try/catch، وفصل ملف الاتصال بملف config.

## Task 3: التسجيل وتسجيل الدخول والخروج
**المواضيع:** HTML Forms وطرق GET/POST، `$_POST`، دوال `password_hash` و`password_verify`، الـ Sessions (`session_start`، `session_regenerate_id`، `session_destroy`)، والتحقق من إن الإيميل مش مكرر.

## Task 4: الصلاحيات (Authorization)
**المواضيع:** Role-Based Access Control، كتابة دالة أو ملف middleware تفحص الجلسة والدور وتُستدعى بأول كل صفحة، فحص `is_active` عند تسجيل الدخول، وعمل Redirect. ما تعتمد على إخفاء الروابط في الواجهة، الحماية لازم تكون على السيرفر.

## Task 5: عرض المواعيد المتاحة
**المواضيع:** استعلامات `SELECT` مع `JOIN` و`LEFT JOIN`، دوال التجميع `COUNT` و`GROUP BY`، حساب السعة المتبقية بالاستعلام، التعامل مع التاريخ والوقت في PHP وSQL (`DATE`, `TIME`, `NOW()`)، وفلترة المواعيد الماضية.

## Task 6: إنشاء حجز (أهم تاسك)
**المواضيع:** تطبيق كل الـ Business Rules على السيرفر: الموعد مش بالماضي، السعة ما تتجاوز، ما في حجز مكرر. بالإضافة لـ Transactions (`beginTransaction`, `commit`, `rollBack`) لتجنب مشكلة حجزين بنفس اللحظة على آخر مكان (Race Condition)، والـ Input Validation.

## Task 7: صفحة My Reservations والإلغاء
**المواضيع:** استعلام بيجيب حجوزات المستخدم الحالي فقط، التأكد من ملكية الحجز قبل الإلغاء (`WHERE id = ? AND user_id = ?`)، منع الإلغاء إذا بدأ الموعد، وعرض الحالات بألوان مختلفة.

## Task 8: لوحة الأدمن: الإحصائيات والرسم البياني
**المواضيع:** استعلامات `COUNT` و`GROUP BY status`، أساسيات Chart.js (تضمين المكتبة، canvas، labels وdata)، وتمرير بيانات PHP لـ JavaScript بـ `json_encode`.

## Task 9: إدارة الحجوزات (Admin)
**المواضيع:** البحث بـ `LIKE` بالاسم أو الإيميل، الفلترة بالحالة، بناء استعلام ديناميكي بشكل آمن، تطبيق جدول الانتقالات المسموحة (State Machine) على السيرفر، وحماية العمليات بـ POST + التحقق من دور الأدمن. ويفضّل CSRF Token كإضافة.

## Task 10: إدارة المستخدمين
**المواضيع:** عرض المستخدمين، تعديل `is_active` بـ `UPDATE`، ومنع الأدمن من تعطيل حساب نفسه (احتمال ذكي ممكن ينسألوك عنه).

## Task 11: إدارة المواعيد (Time Slots)
**المواضيع:** `INSERT` مع Validation (وقت النهاية بعد البداية، السعة رقم موجب، التاريخ مش ماضي)، `UPDATE` للتعديل (انتبه: ما تنزّل السعة تحت عدد الحجوزات الفعّالة)، و`DELETE` بشرط عدم وجود حجوزات Pending أو Confirmed.

## Task 12: الواجهة (UI) والـ Responsive
**المواضيع:** HTML وCSS، Flexbox وGrid، Media Queries، أو Bootstrap إذا بدك تسرّع، وعرض رسائل الأخطاء والنجاح بشكل واضح (Flash Messages بالـ Session).

## Task 13: الاختبار (Testing)
**المواضيع:** كتابة Test Cases يدوية لكل بند بقسم الـ Testing بالمهمة (جدول: السيناريو، النتيجة المتوقعة، النتيجة الفعلية)، واختبار الحالات السلبية مثل تعديل الـ URL أو الـ ID يدوياً.

## Task 14: التسليم
**المواضيع:** كتابة README (وصف المشروع، التقنيات، خطوات التثبيت، حسابات الـ demo)، تصدير ملف الـ SQL، تنظيف الـ repo، وتحضير سيناريو العرض: المستخدم ← الأدمن ← CRUD ← إثبات الـ business rules.

---

# ترتيب مقترح بالنسبة للوقت (الديدلاين السبت 8 مساءً)

- **اليوم (الخميس):** Tasks 0 إلى 4
- **الجمعة:** Tasks 5 إلى 11
- **السبت صباحاً:** Tasks 12 و13
- **السبت قبل الظهر وبعده:** Task 14 + مراجعة نهائية، وسيب هامش ساعتين قبل الديدلاين

نصيحة: اعمل commit بعد كل تاسك، لأن الـ commits المفيدة مطلوبة بالتسليم.

إذا بدك، ابعتلي التاسك اللي بتبلش فيه وبشرحلك مفاهيمه بالتفصيل، أو بدقق معك على حلّك بعد ما تكتبه.