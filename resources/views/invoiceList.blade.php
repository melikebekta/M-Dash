@extends('layouts.master')
@section('title', 'Fatura Listesi')
@section('content')
    <form method="POST" action="{{ route('invoiceList.delete') }}">
        @csrf
        <div class="overflow-x-auto bg-white rounded shadow"><br />
            <div class="flex justify-start items-center mb-4 gap-2 pl-2">
                <button type="submit" class="btn btn-danger gap-2" {{ count(old('invoiceid', [])) }}
                    style="{{ count(old('invoiceid', [])) }}">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5">
                        <path d="M20.5001 6H3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                        <path
                            d="M18.8334 8.5L18.3735 15.3991C18.1965 18.054 18.108 19.3815 17.243 20.1907C16.378 21 15.0476 21 12.3868 21H11.6134C8.9526 21 7.6222 21 6.75719 20.1907C5.89218 19.3815 5.80368 18.054 5.62669 15.3991L5.16675 8.5"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                        <path opacity="0.5" d="M9.5 11L10 16" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round"></path>
                        <path opacity="0.5" d="M14.5 11L14 16" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round"></path>
                        <path opacity="0.5"
                            d="M6.5 6C6.55588 6 6.58382 6 6.60915 5.99936C7.43259 5.97849 8.15902 5.45491 8.43922 4.68032C8.44784 4.65649 8.45667 4.62999 8.47434 4.57697L8.57143 4.28571C8.65431 4.03708 8.69575 3.91276 8.75071 3.8072C8.97001 3.38607 9.37574 3.09364 9.84461 3.01877C9.96213 3 10.0932 3 10.3553 3H13.6447C13.9068 3 14.0379 3 14.1554 3.01877C14.6243 3.09364 15.03 3.38607 15.2493 3.8072C15.3043 3.91276 15.3457 4.03708 15.4286 4.28571L15.5257 4.57697C15.5433 4.62992 15.5522 4.65651 15.5608 4.68032C15.841 5.45491 16.5674 5.97849 17.3909 5.99936C17.4162 6 17.4441 6 17.5 6"
                            stroke="currentColor" stroke-width="1.5"></path>
                    </svg>
                    Sil
                </button>

                <a href="{{route('add')}}" class="btn btn-primary gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                        class="h-5 w-5">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Yeni Fatura Ekle
                </a>

            </div><br />

            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100 text-gray-700 text-left text-sm">
                    <tr>
                        <th class="px-4 py-2">
                            <input type="checkbox" id="selectAll" class="form-checkbox h-5 w-5">
                        </th>
                        <th class="px-4 py-2">Fatura Adı</th>
                        <th class="px-4 py-2">E-posta</th>
                        <th class="px-4 py-2">Tarih</th>
                        <th class="px-4 py-2">Tutar</th>
                        <th class="px-4 py-2">Durum</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm">
                    @foreach($invoices as $invoice)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">
                                <input type="checkbox" name="invoiceid[]" value="{{ $invoice->id }}" {{ in_array($invoice->id, old('invoice_id', [])) ? 'checked' : '' }}>
                            </td>
                            <td class="px-4 py-2">{{ $invoice->doc_name }}</td>
                            <td class="px-4 py-2">{{ $invoice->email }}</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($invoice->doc_date)->translatedFormat('d F Y') }}
                            </td>
                            <td class="px-4 py-2">₺{{ number_format($invoice->total_price, 2) }}</td>
                            <td class="px-4 py-2">
                                @if($invoice->status == 'Ödendi')
                                    <span class="text-green-700 bg-green-100 px-2 py-1 rounded-full">Ödendi</span>
                                @elseif($invoice->status == 'Ödenmedi')
                                    <span class="text-red-700 bg-red-100 px-2 py-1 rounded-full">Ödenmedi</span>
                                @else
                                    <span class="text-gray-700 bg-gray-100 px-2 py-1 rounded-full">{{ $invoice->status }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </form>

    <script>
        document.querySelectorAll('input[name="invoice_id[]"]').forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                let checkboxes = document.querySelectorAll('input[name="invoice_id[]"]');
                let submitButton = document.querySelector('button[type="submit"]');
                submitButton.disabled = !Array.from(checkboxes).some(chk => chk.checked);
                submitButton.style.cursor = submitButton.disabled ? 'not-allowed' : 'pointer';
            });
        });
    </script>

@endsection