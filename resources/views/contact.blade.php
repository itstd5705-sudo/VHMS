@extends('layouts.app')
@section('content')
<section class="contact-section py-5">
    <div class="container">
        <h1 class="text-center mb-5">اتصل بنا</h1>
        <div class="row g-4">
            <!-- خريطة جوجل -->
            <div class="col-lg-6">
                <div class="medinest-map-wrapper rounded-3 overflow-hidden shadow">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3381.0744206883155!2d20.10344837472119!3d32.06723581992198!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x13831d302b70eb5f%3A0x8663089af5a2ebbf!2z2YXYs9iq2LTZgdmJINmB2YrZhtmK2LPZitin!5e0!3m2!1sen!2sly!4v1760178661185!5m2!1sen!2sly"
                        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            <!-- نموذج الاتصال -->
            <div class="col-lg-6">
                <form>
                    <div class="mb-3">
                        <label for="name" class="form-label">الاسم الكامل</label>
                        <input type="text" class="form-control" id="name" placeholder="أدخل اسمك">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">البريد الإلكتروني</label>
                        <input type="email" class="form-control" id="email" placeholder="example@gmail.com">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">الرسالة</label>
                        <textarea class="form-control" id="message" rows="5" placeholder="اكتب رسالتك هنا"></textarea>
                    </div>
                    <button class="btn btn-primary w-100">إرسال الرسالة</button>
                </form>
            </div>

        </div>
    </div>
</section>
@endsection
