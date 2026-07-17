@props([
    'name' => 'tanggal_waktu',
    'value' => null,
    'readonly' => false,
    'error' => false,
])

@php
    $pickerId = 'dtp_' . \Illuminate\Support\Str::random(8);
@endphp

<div class="dt-picker relative" id="{{ $pickerId }}" data-value="{{ $value }}" data-readonly="{{ $readonly ? '1' : '0' }}">
    <input type="hidden" name="{{ $name }}" class="dtp-hidden-input" value="{{ $value }}">

    <button type="button"
            class="dtp-trigger input input-bordered w-full flex items-center justify-between gap-2 text-left {{ $error ? 'input-error' : '' }} {{ $readonly ? 'opacity-70 cursor-not-allowed bg-slate-50' : '' }}"
            {{ $readonly ? 'disabled' : '' }}>
        <span class="flex items-center gap-2 min-w-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-slate-500 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <span class="dtp-display truncate text-slate-500">Pilih tanggal &amp; waktu</span>
        </span>
        @unless ($readonly)
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-slate-500 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
        @endunless
    </button>

    @unless ($readonly)
        <div class="dtp-panel hidden absolute z-30 mt-2 w-[300px] bg-white rounded-2xl shadow-xl border border-slate-200 p-4">
            <!-- Calendar header -->
            <div class="flex items-center justify-between mb-3">
                <button type="button" class="dtp-prev w-8 h-8 rounded-lg hover:bg-slate-100 flex items-center justify-center text-slate-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <span class="dtp-month-label font-semibold text-sm text-slate-900"></span>
                <button type="button" class="dtp-next w-8 h-8 rounded-lg hover:bg-slate-100 flex items-center justify-center text-slate-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>

            <!-- Weekday header -->
            <div class="dtp-weekdays grid grid-cols-7 gap-1 mb-1 text-center"></div>

            <!-- Days grid -->
            <div class="dtp-days grid grid-cols-7 gap-1 mb-3"></div>

            <!-- Time -->
            <div class="border-t border-slate-200 pt-3 mb-3">
                <label class="text-xs font-semibold text-slate-600 uppercase tracking-wide mb-1.5 flex items-center gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Waktu
                </label>
                <div class="flex items-center gap-2">
                    <select class="dtp-hour select select-bordered select-sm flex-1"></select>
                    <span class="text-slate-500 font-semibold">:</span>
                    <select class="dtp-minute select select-bordered select-sm flex-1"></select>
                    <span class="text-xs text-slate-500">WIB</span>
                </div>
            </div>

            <!-- Footer -->
            <div class="flex items-center justify-between gap-2">
                <button type="button" class="dtp-today text-xs font-medium text-blue-900 hover:underline">Hari ini</button>
                <div class="flex gap-2">
                    <button type="button" class="dtp-clear btn btn-ghost btn-xs">Bersihkan</button>
                    <button type="button" class="dtp-apply btn btn-brand btn-xs">Terapkan</button>
                </div>
            </div>
        </div>
    @endunless
</div>

@once
    <script>
        (function () {
            const MONTHS = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            const DAYS_SHORT = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
            const DAYS_FULL = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

            function pad(n) { return String(n).padStart(2, '0'); }

            function parseValue(str) {
                if (!str) return null;
                const m = String(str).match(/^(\d{4})-(\d{2})-(\d{2})T(\d{2}):(\d{2})/);
                if (!m) return null;
                return new Date(parseInt(m[1]), parseInt(m[2]) - 1, parseInt(m[3]), parseInt(m[4]), parseInt(m[5]));
            }

            function formatHidden(d) {
                return `${d.getFullYear()}-${pad(d.getMonth() + 1)}-${pad(d.getDate())}T${pad(d.getHours())}:${pad(d.getMinutes())}`;
            }

            function formatDisplay(d) {
                return `${DAYS_FULL[d.getDay()]}, ${d.getDate()} ${MONTHS[d.getMonth()]} ${d.getFullYear()} · ${pad(d.getHours())}:${pad(d.getMinutes())}`;
            }

            function initPicker(root) {
                const display = root.querySelector('.dtp-display');

                if (root.dataset.readonly === '1') {
                    const val = parseValue(root.dataset.value);
                    if (val && display) {
                        display.textContent = formatDisplay(val);
                        display.classList.remove('text-slate-500');
                        display.classList.add('text-slate-800');
                    }
                    return;
                }

                const trigger = root.querySelector('.dtp-trigger');
                const panel = root.querySelector('.dtp-panel');
                const hiddenInput = root.querySelector('.dtp-hidden-input');
                const monthLabel = root.querySelector('.dtp-month-label');
                const daysGrid = root.querySelector('.dtp-days');
                const weekdayRow = root.querySelector('.dtp-weekdays');
                const hourSelect = root.querySelector('.dtp-hour');
                const minuteSelect = root.querySelector('.dtp-minute');

                let selected = parseValue(root.dataset.value);
                let viewDate = selected ? new Date(selected) : new Date();

                weekdayRow.innerHTML = DAYS_SHORT.map(d => `<span class="text-[11px] font-semibold text-slate-500">${d}</span>`).join('');
                hourSelect.innerHTML = Array.from({ length: 24 }, (_, i) => `<option value="${i}">${pad(i)}</option>`).join('');
                minuteSelect.innerHTML = Array.from({ length: 60 }, (_, i) => `<option value="${i}">${pad(i)}</option>`).join('');

                function syncTimeSelects() {
                    const t = selected || new Date();
                    hourSelect.value = String(t.getHours());
                    minuteSelect.value = String(t.getMinutes());
                }

                function updateOutputs() {
                    if (selected) {
                        hiddenInput.value = formatHidden(selected);
                        display.textContent = formatDisplay(selected);
                        display.classList.remove('text-slate-500');
                        display.classList.add('text-slate-800');
                    } else {
                        hiddenInput.value = '';
                        display.textContent = 'Pilih tanggal & waktu';
                        display.classList.add('text-slate-500');
                        display.classList.remove('text-slate-800');
                    }
                }

                function renderCalendar() {
                    monthLabel.textContent = `${MONTHS[viewDate.getMonth()]} ${viewDate.getFullYear()}`;

                    const year = viewDate.getFullYear();
                    const month = viewDate.getMonth();
                    const firstDay = new Date(year, month, 1).getDay();
                    const daysInMonth = new Date(year, month + 1, 0).getDate();
                    const daysInPrevMonth = new Date(year, month, 0).getDate();
                    const todayStr = new Date().toDateString();

                    let cells = [];
                    for (let i = 0; i < firstDay; i++) {
                        const d = daysInPrevMonth - firstDay + i + 1;
                        cells.push({ day: d, current: false, dateObj: new Date(year, month - 1, d) });
                    }
                    for (let d = 1; d <= daysInMonth; d++) {
                        cells.push({ day: d, current: true, dateObj: new Date(year, month, d) });
                    }
                    const remaining = (7 - (cells.length % 7)) % 7;
                    for (let d = 1; d <= remaining; d++) {
                        cells.push({ day: d, current: false, dateObj: new Date(year, month + 1, d) });
                    }

                    daysGrid.innerHTML = cells.map(c => {
                        const isToday = c.dateObj.toDateString() === todayStr;
                        const isSelected = selected && c.dateObj.toDateString() === selected.toDateString();
                        let cls = 'dtp-day w-8 h-8 flex items-center justify-center rounded-lg text-sm transition-colors ';
                        if (isSelected) {
                            cls += 'bg-blue-900 text-white font-semibold';
                        } else if (!c.current) {
                            cls += 'text-slate-400 hover:bg-slate-50';
                        } else if (isToday) {
                            cls += 'text-slate-800 ring-1 ring-blue-200 font-semibold hover:bg-blue-50';
                        } else {
                            cls += 'text-slate-800 hover:bg-blue-50';
                        }
                        return `<button type="button" class="${cls}" data-y="${c.dateObj.getFullYear()}" data-m="${c.dateObj.getMonth()}" data-d="${c.dateObj.getDate()}">${c.day}</button>`;
                    }).join('');
                }

                function selectDay(y, m, d) {
                    const base = selected || new Date();
                    selected = new Date(y, m, d, base.getHours(), base.getMinutes());
                    updateOutputs();
                    renderCalendar();
                    syncTimeSelects();
                }

                trigger.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const isHidden = panel.classList.contains('hidden');
                    document.querySelectorAll('.dtp-panel').forEach(p => p.classList.add('hidden'));
                    if (isHidden) {
                        viewDate = selected ? new Date(selected) : new Date();
                        renderCalendar();
                        syncTimeSelects();
                        panel.classList.remove('hidden');
                    }
                });

                panel.addEventListener('click', (e) => e.stopPropagation());

                daysGrid.addEventListener('click', (e) => {
                    const btn = e.target.closest('.dtp-day');
                    if (!btn) return;
                    selectDay(parseInt(btn.dataset.y), parseInt(btn.dataset.m), parseInt(btn.dataset.d));
                });

                root.querySelector('.dtp-prev').addEventListener('click', () => {
                    viewDate = new Date(viewDate.getFullYear(), viewDate.getMonth() - 1, 1);
                    renderCalendar();
                });
                root.querySelector('.dtp-next').addEventListener('click', () => {
                    viewDate = new Date(viewDate.getFullYear(), viewDate.getMonth() + 1, 1);
                    renderCalendar();
                });

                hourSelect.addEventListener('change', () => {
                    const base = selected || new Date();
                    selected = new Date(base.getFullYear(), base.getMonth(), base.getDate(), parseInt(hourSelect.value), selected ? selected.getMinutes() : parseInt(minuteSelect.value));
                    updateOutputs();
                });
                minuteSelect.addEventListener('change', () => {
                    const base = selected || new Date();
                    selected = new Date(base.getFullYear(), base.getMonth(), base.getDate(), selected ? selected.getHours() : parseInt(hourSelect.value), parseInt(minuteSelect.value));
                    updateOutputs();
                });

                root.querySelector('.dtp-today').addEventListener('click', () => {
                    const now = new Date();
                    selected = now;
                    viewDate = new Date(now);
                    updateOutputs();
                    renderCalendar();
                    syncTimeSelects();
                });

                root.querySelector('.dtp-clear').addEventListener('click', () => {
                    selected = null;
                    updateOutputs();
                    renderCalendar();
                });

                root.querySelector('.dtp-apply').addEventListener('click', () => {
                    panel.classList.add('hidden');
                });

                document.addEventListener('click', (e) => {
                    if (!root.contains(e.target)) panel.classList.add('hidden');
                });
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape') panel.classList.add('hidden');
                });

                updateOutputs();
            }

            document.querySelectorAll('.dt-picker').forEach(initPicker);
        })();
    </script>
@endonce
