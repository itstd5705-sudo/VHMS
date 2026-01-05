<x-filament-panels::page class="space-y-6">

    {{-- =========================
        صف الإحصائيات السريعة
        3 أعمدة على شاشات كبيرة
    ========================= --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        <div class="bg-red-500 text-white shadow-lg rounded-lg p-4">
            @livewire(\App\Filament\Widgets\AdminStats::class)
        </div>
        <div class="bg-green-500 text-white shadow-lg rounded-lg p-4">
            @livewire(\App\Filament\Widgets\MonthlyStats::class)
        </div>
    </div>

    {{-- =========================
        صف الرسوم البيانية
        2 أعمدة على الشاشات المتوسطة
    ========================= --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
        <div class="bg-yellow-500 text-white shadow-lg rounded-lg p-4">
            @livewire(\App\Filament\Widgets\MedicationRequestsChart::class)
        </div>
        <div class="bg-blue-500 text-white shadow-lg rounded-lg p-4">
            @livewire(\App\Filament\Widgets\IncomeChart::class)
        </div>
        <div class="bg-purple-500 text-white shadow-lg rounded-lg p-4">
            @livewire(\App\Filament\Widgets\AppointmentChart::class)
        </div>
        <div class="bg-pink-500 text-white shadow-lg rounded-lg p-4">
            @livewire(\App\Filament\Widgets\CardChart::class)
        </div>
    </div>

    {{-- =========================
        جدول المخزون المنخفض
        1 عمود كامل
    ========================= --}}
    <div class="mt-6 bg-orange-500 text-white shadow-lg rounded-lg p-4">
        @livewire(\App\Filament\Widgets\LowStock::class)
    </div>

    {{-- =========================
        أفضل الأقسام حسب المواعيد
        1 عمود كامل
    ========================= --}}
    <div class="mt-6 bg-teal-500 text-white shadow-lg rounded-lg p-4">
        @livewire(\App\Filament\Widgets\TopDepartments::class)
    </div>

</x-filament-panels::page>
