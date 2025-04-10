@extends('layouts.master')
@section('content')
    <!-- start main content section -->
    <div x-data="invoiceAdd">
        <div class="flex flex-col gap-2.5 xl:flex-row">
            <div class="panel flex-1 px-0 py-6 ltr:lg:mr-6 rtl:lg:ml-6">
                <div class="flex flex-wrap justify-between px-4">
                    <div class="mb-6 w-full lg:w-1/2">
                        <div class="flex shrink-0 items-center text-black dark:text-white">
                            <img src="assets/images/logo.svg" alt="image" class="w-14" />
                        </div>
                        <div class="mt-6 space-y-1 text-gray-500 dark:text-gray-400">
                            <div>13 Bez Sokak, Kıbrıs Bahçeleri, Bursa, 16200, TR</div>
                            <div>m-dash@gmail.com</div>
                            <div>+90555 555 5555</div>
                        </div>
                    </div>
                    <div class="w-full lg:w-1/2 lg:max-w-fit">
                        <div class="flex items-center">
                            <label for="number" class="mb-0 flex-1 ltr:mr-2 rtl:ml-2">Fatura Numarası</label>
                            <input id="number" type="text" name="inv-num" class="form-input w-2/3 lg:w-[250px]"
                                placeholder="#8801" x-model="params.invoiceNo" />
                        </div>
                        <div class="mt-4 flex items-center">
                            <label for="invoiceLabel" class="mb-0 flex-1 ltr:mr-2 rtl:ml-2">Fatura Adı</label>
                            <input id="invoiceLabel" type="text" name="inv-label" class="form-input w-2/3 lg:w-[250px]"
                                placeholder="Fatura İsmini Giriniz" x-model="params.title" />
                        </div>
                        <div class="mt-4 flex items-center">
                            <label for="startDate" class="mb-0 flex-1 ltr:mr-2 rtl:ml-2">Fatura Tarihi</label>
                            <input id="startDate" type="date" name="inv-date" class="form-input w-2/3 lg:w-[250px]"
                                x-model="params.invoiceDate" />
                        </div>
                    </div>
                </div>
                <hr class="my-6 border-[#e0e6ed] dark:border-[#1b2e4b]" />
                <div class="mt-8 px-4">
                    <div class="flex flex-col justify-between lg:flex-row">
                        <div class="mb-6 w-full lg:w-1/2 ltr:lg:mr-6 rtl:lg:ml-6">
                            <div class="text-lg font-semibold">Faturanın Kesileceği Kişi</div>
                            <div class="mt-4 flex items-center">
                                <label for="reciever-name" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Ad Soyad</label>
                                <input id="reciever-name" type="text" name="reciever-name" class="form-input flex-1"
                                    x-model="params.to.name" placeholder="Ad Soyad giriniz" />
                            </div>
                            <div class="mt-4 flex items-center">
                                <label for="reciever-email" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">E-posta</label>
                                <input id="reciever-email" type="email" name="reciever-email" class="form-input flex-1"
                                    x-model="params.to.email" placeholder="E-posta adresinizi giriniz" />
                            </div>
                            <div class="mt-4 flex items-center">
                                <label for="reciever-address" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Adres</label>
                                <input id="reciever-address" type="text" name="reciever-address" class="form-input flex-1"
                                    x-model="params.to.address" placeholder="Adres giriniz" />
                            </div>
                            <div class="mt-4 flex items-center">
                                <label for="reciever-number" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Telefon Numarası</label>
                                <input id="reciever-number" type="text" name="reciever-number" class="form-input flex-1"
                                    x-model="params.to.phone" placeholder="Telefon Numaranızı giriniz" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 w-full xl:mt-0 xl:w-96">
                <div class="panel mb-5">
                    <div x-data="{
                        item: { quantity: 1, amount: 0 },
                        tax: 0,
                        discount: 0,
                        shippingCharge: 0,
                        paidStatus: false, // Ödeme durumu (false = ödenmedi, true = ödendi)
                        get total() {
                            // Ürün tutarı
                            let subtotal = this.item.quantity * this.item.amount;
                            // Vergi ekleme
                            let taxAmount = subtotal * (this.tax / 100);
                            // İskonto hesaplama
                            let discountAmount = subtotal * (this.discount / 100);
                            // Toplam tutar (Vergi, iskonto ve kargo ücreti ekleniyor)
                            let total = subtotal + taxAmount - discountAmount + parseFloat(this.shippingCharge || 0);
                            return total.toFixed(2);
                        }
                    }" class="mt-4">

                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                            <div>
                                <label for="quantity">Adet</label>
                                <input type="number" id="quantity" class="form-input w-32" placeholder="Quantity"
                                    x-model.number="item.quantity" />
                            </div>
                            <div>
                                <label for="price">Adet Fiyatı</label>
                                <input type="text" id="price" class="form-input w-32" placeholder="Price"
                                    x-model.number="item.amount" />
                            </div>
                        </div>

                        <div class="mt-4">
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                                <div>
                                    <label for="tax">Vergi(%) </label>
                                    <input id="tax" type="number" name="tax" class="form-input"
                                        placeholder="Vergi oranını giriniz" x-model.number="tax" />
                                </div>
                                <div>
                                    <label for="discount">İskonto(%) </label>
                                    <input id="discount" type="number" name="discount" class="form-input"
                                        placeholder="İskonto" x-model.number="discount" />
                                </div>
                                <div>
                                    <label for="shipping-charge">Kargo Ücreti(₺) </label>
                                    <input id="shipping-charge" type="number" name="shipping-charge" class="form-input"
                                        placeholder="Gönderim ücreti varsa giriniz" x-model.number="shippingCharge" />
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 flex justify-between items-center">
                            <div>
                                <label for="total">Toplam</label>
                                <label x-text="`₺${total}`" class="font-semibold"></label>
                            </div>
                            <div>
                                <label for="payment-status">Ödeme Durumu</label>
                                <span :class="paidStatus ? 'text-green-500' : 'text-red-500'" class="font-semibold"
                                    x-text="paidStatus ? 'Ödendi' : 'Ödenmedi'"></span>
                                <button type="button" @click="paidStatus = !paidStatus"
                                    class="ml-2 px-2 py-1 bg-blue-500 text-black rounded">
                                    👈🏻 
                                </button>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="panel">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-1">
                        <button type="button" class="btn btn-success w-full gap-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 shrink-0 ltr:mr-2 rtl:ml-2">
                                <path
                                    d="M3.46447 20.5355C4.92893 22 7.28595 22 12 22C16.714 22 19.0711 22 20.5355 20.5355C22 19.0711 22 16.714 22 12C22 11.6585 22 11.4878 21.9848 11.3142C21.9142 10.5049 21.586 9.71257 21.0637 9.09034C20.9516 8.95687 20.828 8.83317 20.5806 8.58578L15.4142 3.41944C15.1668 3.17206 15.0431 3.04835 14.9097 2.93631C14.2874 2.414 13.4951 2.08581 12.6858 2.01515C12.5122 2 12.3415 2 12 2C7.28595 2 4.92893 2 3.46447 3.46447C2 4.92893 2 7.28595 2 12C2 16.714 2 19.0711 3.46447 20.5355Z"
                                    stroke="currentColor" stroke-width="1.5" />
                                <path
                                    d="M17 22V21C17 19.1144 17 18.1716 16.4142 17.5858C15.8284 17 14.8856 17 13 17H11C9.11438 17 8.17157 17 7.58579 17.5858C7 18.1716 7 19.1144 7 21V22"
                                    stroke="currentColor" stroke-width="1.5" />
                                <path opacity="0.5" d="M7 8H13" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" />
                            </svg>
                            Kaydet
                        </button>


                        <!-- <a href="apps-invoice-preview.html" class="btn btn-primary w-full gap-2">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5 shrink-0 ltr:mr-2 rtl:ml-2">
                                                    <path opacity="0.5"
                                                        d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                                                        stroke="currentColor" stroke-width="1.5"></path>
                                                    <path
                                                        d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                                                        stroke="currentColor" stroke-width="1.5"></path>
                                                </svg>
                                                Görüntüle
                                            </a> -->

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end main content section -->
    </div>
@endsection