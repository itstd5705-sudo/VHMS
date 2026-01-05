<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF; // استخدام مكتبة PDF (مثلاً barryvdh/laravel-dompdf)

class PdfController extends Controller
{
    /**
     * ============================
     * توليد ملف PDF من جدول بيانات
     * ============================
     */
    public function table(string $view, $records, string $filename)
    {
        // إنشاء PDF من الـ View والبيانات
        $pdf = PDF::loadView($view, [
            'records' => $records,
        ]);

        // تنزيل الـ PDF مباشرة بدون حفظه على السيرفر
        return response()->streamDownload(
            fn() => print($pdf->output()), // إخراج محتوى PDF
            $filename . '.pdf'             // اسم الملف النهائي
        );
    }
}
