<?php

namespace App\Filament\Traits;

use Filament\Tables\Actions\Action;
use Mpdf\Mpdf;
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;

/**
 * Trait HasAutoTablePdf
 *
 * مسؤول عن توليد ملف PDF تلقائي
 * من جدول Filament (Tables)
 */
trait HasAutoTablePdf
{
    /**
     * إنشاء زر PDF داخل جدول Filament
     */
    public static function getAutoPdfAction(): Action
    {
        return Action::make('pdf')
            ->label('PDF') // اسم الزر
            ->icon('heroicon-o-printer') // أيقونة الطباعة
            ->action(function ($livewire) {

                /* ==================================================
                 | 1️⃣ جلب بيانات الجدول من Filament
                 ================================================== */
                $table = $livewire->getTable();

                $columns = []; // عناوين الأعمدة
                $fields  = []; // أسماء الحقول من قاعدة البيانات

                foreach ($table->getColumns() as $column) {
                    $columns[] = $column->getLabel(); // عنوان العمود
                    $fields[]  = $column->getName();  // اسم الحقل
                }

                // جلب كل السجلات المعروضة في الجدول
                $records = $table->getQuery()->get();

                /* ==================================================
                 | 2️⃣ إعداد خط Cairo
                 ================================================== */

                // مسار الخط داخل public
                $fontDir = public_path('fonts/cairo');

                // جلب إعدادات mPDF الافتراضية
                $defaultConfig = (new ConfigVariables())->getDefaults();
                $fontDirs = $defaultConfig['fontDir'];

                // جلب بيانات الخطوط الافتراضية
                $defaultFontConfig = (new FontVariables())->getDefaults();
                $fontData = $defaultFontConfig['fontdata'];

                /* ==================================================
                 | 3️⃣ إنشاء كائن PDF
                 ================================================== */
                $pdf = new Mpdf([
                    'mode'   => 'utf-8', // دعم UTF-8 للعربية
                    'format' => 'A4',    // حجم الصفحة

                    // خط افتراضي آمن لتجنّب أخطاء PHP 8.2
                    'default_font' => 'dejavusans',

                    // دمج مجلد الخطوط الافتراضية مع خط Cairo
                    'fontDir' => array_merge($fontDirs, [
                        $fontDir,
                    ]),

                    // تسجيل خط Cairo داخل mPDF
                    'fontdata' => $fontData + [
                        'cairo' => [
                            'R' => 'Cairo-Regular.ttf', // العادي
                            'B' => 'Cairo-Bold.ttf',    // العريض
                        ],
                    ],

                    // تعطيل OpenType Layout (مهم جدًا مع PHP 8.2)
                    'useOTL' => 0,

                    // اختيار اللغة والخط تلقائيًا
                    'autoScriptToLang' => true,
                    'autoLangToFont'   => true,

                    // مجلد مؤقت خاص بـ mPDF (مهم مع Livewire)
                    'tempDir' => storage_path('app/mpdf'),
                ]);

                /* ==================================================
                 | 4️⃣ توليد محتوى الجدول (HTML)
                 ================================================== */
                $html = view('pdf.table', [
                    'columns' => $columns,
                    'fields'  => $fields,
                    'records' => $records,
                ])->render();

                // كتابة الـ HTML داخل ملف PDF
                $pdf->WriteHTML($html);

                /* ==================================================
                 | 5️⃣ تحميل ملف PDF
                 ================================================== */
                return response()->streamDownload(
                    fn () => print($pdf->Output('', 'S')),
                    'table.pdf'
                );
            });
    }
}
