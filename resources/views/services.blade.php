@extends('layouts.app')
@section('content')
 <h2 class="gallery-title mb-3">مجموعة الخدمات التي تقدمها المستشفى  </h2>
<section class="serv-section">
        <div class="serv-cards-container">
            <div class="serv-card">
                <div class="serv-card-content">
                    <div class="serv-text-side">
                        <span class="serv-number">01</span>
                        <h3>أمراض القلب</h3>
                        <p>نقدم تشخيصاً دقيقاً وعلاجاً متطوراً لكافة أمراض القلب والأوعية الدموية باستخدام أحدث أجهزة القسطرة.<br>يعمل فريقنا على مدار الساعة لمراقبة الحالات الحرجة وتقديم الرعاية الوقائية اللازمة لسلامة عضلة القلب.<br>نضمن لكم رحلة علاجية متكاملة تبدأ من الفحص الدوري وتصل إلى أدق التدخلات الجراحية المتطورة.</p>
                    </div>
                    <div class="serv-image-side"><img src="{{ asset('image/تنزيل (2).jfif') }}"></div>
                </div>
            </div>
            <div class="serv-card">
                <div class="serv-card-content">
                    <div class="serv-text-side">
                        <span class="serv-number">02</span>
                        <h3>قسم الطوارئ</h3>
                        <p>وحدة الطوارئ مجهزة لاستقبال كافة الحالات الحرجة والطارئة على مدار 24 ساعة طوال أيام الأسبوع.<br>يضم القسم فريقاً من الأخصائيين المدربين على التعامل السريع مع الإصابات والحوادث والأزمات الصحية المفاجئة.<br>نعتمد بروتوكولات عالمية لضمان تقديم الإسعافات الأولية وتثبيت حالة المريض في أسرع وقت ممكن.</p>
                    </div>
                    <div class="serv-image-side"><img src="{{ asset('image/photo_2025-11-07_19-14-06.jpg') }}"></div>
                </div>
            </div>
            <div class="serv-card">
                <div class="serv-card-content">
                    <div class="serv-text-side">
                        <span class="serv-number">03</span>
                        <h3>أنف وأذن وحنجرة</h3>
                        <p>يوفر القسم رعاية متخصصة لاضطرابات السمع والتوازن ومشاكل الجيوب الأنفية المزمنة والحساسية.<br>نستخدم أحدث المناظير الطبية لتشخيص وعلاج أمراض الأحبال الصوتية وصعوبات البلع لدى الأطفال والكبار.<br>نتميز بإجراء عمليات زراعة القوقعة وتصحيح انحراف الحاجز الأنفي باستخدام تقنيات جراحية دقيقة وآمنة.</p>
                    </div>
                    <div class="serv-image-side"><img src="{{ asset('image/photo_2026-01-04_18-31-51.jpg') }}"></div>
                </div>
            </div>
            <div class="serv-card">
                <div class="serv-card-content">
                    <div class="serv-text-side">
                        <span class="serv-number">04</span>
                        <h3>طب الأطفال</h3>
                        <p>نقدم بيئة رعاية صديقة للطفل تشمل التطعيمات الأساسية ومتابعة النمو البدني والذهني منذ الولادة.<br>يختص أطباؤنا في علاج الأمراض الحادة والمزمنة وتوفير الدعم الغذائي والنفسي المناسب لكل مرحلة عمرية.<br>نحن نؤمن بأن وقاية الطفل اليوم هي أساس صحته في المستقبل، لذا نوفر فحوصات دورية شاملة.</p>
                    </div>
                    <div class="serv-image-side"><img src="{{ asset('image/photo_2025-11-08_14-09-59.jpg') }}"></div>
                </div>
            </div>
            <div class="serv-card">
                <div class="serv-card-content">
                    <div class="serv-text-side">
                        <span class="serv-number">05</span>
                        <h3>الطب الباطني</h3>
                        <p>يقوم استشاريونا بتشخيص وعلاج الأمراض الباطنية المعقدة مثل السكري وضغط الدم واضطرابات الجهاز الهضمي.<br>نركز على تقديم خطط علاجية شاملة تعتمد على الفحص السريري الدقيق والتحاليل المخبرية المتقدمة.<br>يهتم القسم بمتابعة المرضى ذوي الحالات المتعددة وتنسيق الرعاية الطبية بين مختلف التخصصات لضمان سلامتهم.</p>
                    </div>
                    <div class="serv-image-side"><img src="{{ asset('images/باطنيه.jpg') }}"></div>
                </div>
            </div>
            <div class="serv-card">
                <div class="serv-card-content">
                    <div class="serv-text-side">
                        <span class="serv-number">06</span>
                        <h3>الجراحة والتخدير</h3>
                        <p>نمتلك غرف عمليات مجهزة بالكامل لإجراء الجراحات العامة والدقيقة مع فريق تخدير عالي الكفاءة.<br>نطبق معايير صارمة للتعقيم والسلامة المهنية لضمان تقليل المخاطر الجراحية وسرعة تماثل المرضى للشفاء.<br>يتم تقييم كل حالة بدقة قبل الجراحة لضمان اختيار أنسب أنواع التخدير التي توفر أقصى درجات الراحة.</p>
                    </div>
                    <div class="serv-image-side"><img src="{{ asset('image/photo_2026-01-04_18-32-24.jpg') }}"></div>
                </div>
            </div>
            <div class="serv-card">
                <div class="serv-card-content">
                    <div class="serv-text-side">
                        <span class="serv-number">07</span>
                        <h3>جراحة العظام</h3>
                        <p>متخصصون في علاج الكسور وإصابات الملاعب وتبديل المفاصل الصناعية باستخدام أحدث التقنيات الطبية.<br>يوفر القسم حلولاً متطورة لمشاكل العمود الفقري والديسك وهشاشة العظام لضمان استعادة الحركة الطبيعية.<br>يتم دمج العلاج الجراحي مع برامج إعادة التأهيل الفيزيائي لضمان عودة المريض لممارسة حياته بفعالية.</p>
                    </div>
                    <div class="serv-image-side"><img src="{{ asset('images/ججراحة.jpg') }}"></div>
                </div>
            </div>
            <div class="serv-card">
                <div class="serv-card-content">
                    <div class="serv-text-side">
                        <span class="serv-number">08</span>
                        <h3>طب العيون</h3>
                        <p>نقدم فحوصات شاملة للنظر وعلاج أمراض الشبيكة والمياه الزرقاء والبيضاء بأحدث تقنيات الليزر والليزك.<br>يضم القسم وحدة مجهزة لجراحات العيون الدقيقة وتصحيح العيوب الانكسارية لضمان رؤية واضحة وصحية.<br>نهتم بتقديم حلول متكاملة لجميع الفئات العمرية بما في ذلك أمراض عيون الأطفال وحول العين.</p>
                    </div>
                    <div class="serv-image-side"><img src="{{ asset('images/طب العيون.jpg') }}"></div>
                </div>
            </div>

            <div class="serv-card">
                <div class="serv-card-content">
                    <div class="serv-text-side">
                        <span class="serv-number">09</span>
                        <h3>الأمراض الجلدية</h3>
                        <p>نوفر علاجاً متخصصاً لمشاكل الجلد وحب الشباب والاكزيما والصدفية باستخدام أحدث الأجهزة العلاجية.<br>يضم القسم وحدة متطورة لليزر والخدمات التجميلية غير الجراحية للعناية بصحة ونضارة البشرة والشعر.<br>يتم فحص الشامات والأورام الجلدية بدقة عالية لضمان التشخيص المبكر والعلاج الفعال لكل حالة.</p>
                    </div>
                    <div class="serv-image-side"><img src="{{ asset('image/جلدية.jpg') }}"></div>
                </div>
            </div>
            <div class="serv-card">
                <div class="serv-card-content">
                    <div class="serv-text-side">
                        <span class="serv-number">10</span>
                        <h3>المختبرات الطبية</h3>
                        <p>نقدم باقة واسعة من الفحوصات المخبرية الدقيقة التي تشمل تحاليل الدم والوراثة والهرمونات والسموم.<br>يتم إجراء كافة التحاليل بواسطة أجهزة أوتوماتيكية متطورة تضمن سرعة استخراج النتائج وبأعلى درجات الدقة.<br>يخضع المختبر لبرامج رقابة جودة داخلية وخارجية صارمة للتأكد من موثوقية كل فحص يتم إجراؤه.</p>
                    </div>
                    <div class="serv-image-side"><img src="{{ asset('image/photo_2026-01-04_18-32-27.jpg') }}"></div>
                </div>
            </div>

        </div>
    </section>
<script>
    document.addEventListener("DOMContentLoaded", () => {
    const cards = document.querySelectorAll(".serv-card");

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("show");
            }
        });
    }, {
        threshold: 0.2
    });

    cards.forEach(card => observer.observe(card));
});
</script>

@endsection
