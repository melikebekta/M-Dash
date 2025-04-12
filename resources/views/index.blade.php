@extends('layouts.master')
@section('title', 'Ana Sayfa')
@section('content')
    <!-- start main content section -->
    <div x-data="analytics">
        <div class="pt-5">
            <div class="mb-6 grid gap-6 lg:grid-cols-3">
                <div class="panel h-full p-0 lg:col-span-2">
                    <div
                        class="mb-5 flex items-start justify-between border-b border-[#e0e6ed] p-5 dark:border-[#1b2e4b] dark:text-white-light">
                        <h5 class="text-lg font-semibold">Eklenen Faturalar</h5>
                    </div>

                    <div x-ref="uniqueVisitorSeries" class="overflow-hidden">
                        <!-- loader -->
                        <div
                            class="grid min-h-[360px] place-content-center bg-white-light/30 dark:bg-dark dark:bg-opacity-[0.08]">
                            <span
                                class="inline-flex h-5 w-5 animate-spin rounded-full border-2 border-black !border-l-transparent dark:border-white"></span>
                        </div>
                    </div>
                </div>
                <div class="panel grid h-full grid-cols-1 content-between overflow-hidden before:absolute before:-right-44 before:bottom-0 before:top-0 before:m-auto before:h-96 before:w-96 before:rounded-full before:bg-[#1937cc]"
                    style="background: linear-gradient(0deg, #00c6fb -227%, #005bea) !important">
                    <div class="z-[7] mb-16 flex items-start justify-between text-white-light">
                        <h5 class="text-lg font-semibold">Toplam Bakiye</h5>
                        <div class="relative whitespace-nowrap text-xl">
                            {{ $total}} TL

                            <span
                                class="mt-1 table rounded bg-[#4361ee] p-1 text-xs text-[#d3d3d3] ltr:ml-auto rtl:mr-auto">
                                Girilen Fatura Sayısı {{$user_sum}}</span>
                        </div>
                    </div>
                    <div class="z-10 flex items-center justify-between">
                        <div class="flex items-center justify-between">
                            <a href="{{route('add')}}"
                                class="flex items-center gap-1 whitespace-nowrap place-content-center rounded p-1 text-white-light shadow-[0_0_2px_0_#bfc9d4] hover:bg-[#1937cc] ltr:mr-2 rtl:ml-2">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                                Fatura Eklemek için tıklayın
                            </a>

                        </div>
                    </div>

                </div>
            </div>

            <div class="mb-6 grid gap-6 sm:grid-cols-3 xl:grid-cols-5">
                <div class="panel h-full sm:col-span-3 xl:col-span-2">
                    <div class="mb-5 flex items-start justify-between">
                        <h5 class="text-lg font-semibold dark:text-white-light">Tarayıcıya Göre Ziyaretçiler</h5>
                    </div>
                    <div class="flex flex-col space-y-5">
                        <div class="flex items-center">
                            <div class="h-9 w-9">
                                <div
                                    class="flex h-9 w-9 items-center justify-center rounded-xl bg-primary/10 text-primary dark:bg-primary dark:text-white-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" class="h-5 w-5">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <circle opacity="0.5" cx="12" cy="12" r="4"></circle>
                                        <line opacity="0.5" x1="21.17" y1="8" x2="12" y2="8"></line>
                                        <line opacity="0.5" x1="3.95" y1="6.06" x2="8.54" y2="14"></line>
                                        <line opacity="0.5" x1="10.88" y1="21.94" x2="15.46" y2="14"></line>
                                    </svg>
                                </div>
                            </div>
                            <div class="w-full flex-initial px-3">
                                <div class="w-summary-info mb-1 flex justify-between font-semibold text-white-dark">
                                    <h6>Chrome</h6>
                                    <p class="text-xs ltr:ml-auto rtl:mr-auto">65%</p>
                                </div>
                                <div>
                                    <div
                                        class="h-5 w-full overflow-hidden rounded-full bg-dark-light p-1 shadow-3xl dark:bg-dark-light/10 dark:shadow-none">
                                        <div class="relative h-full w-full rounded-full bg-gradient-to-r from-[#009ffd] to-[#2a2a72] before:absolute before:inset-y-0 before:m-auto before:h-2 before:w-2 before:rounded-full before:bg-white ltr:before:right-0.5 rtl:before:left-0.5"
                                            style="width: 65%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="h-9 w-9">
                                <div
                                    class="flex h-9 w-9 items-center justify-center rounded-xl bg-danger/10 text-danger dark:bg-danger dark:text-white-light">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                                        <circle opacity="0.5" cx="12" cy="12" r="10" stroke="currentColor"
                                            stroke-width="1.5" />
                                        <path
                                            d="M13.024 14.5601C10.7142 15.484 9.5593 15.946 8.89964 15.4977C8.74324 15.3914 8.60834 15.2565 8.50206 15.1001C8.0538 14.4405 8.51575 13.2856 9.43967 10.9758C9.63673 10.4831 9.73527 10.2368 9.90474 10.0435C9.94792 9.99429 9.99429 9.94792 10.0435 9.90474C10.2368 9.73527 10.4831 9.63673 10.9758 9.43966C13.2856 8.51575 14.4405 8.0538 15.1001 8.50206C15.2565 8.60834 15.3914 8.74324 15.4977 8.89964C15.946 9.5593 15.484 10.7142 14.5601 13.024C14.363 13.5166 14.2645 13.763 14.095 13.9562C14.0518 14.0055 14.0055 14.0518 13.9562 14.095C13.763 14.2645 13.5166 14.363 13.024 14.5601Z"
                                            stroke="currentColor" stroke-width="1.5" />
                                    </svg>
                                </div>
                            </div>
                            <div class="w-full flex-initial px-3">
                                <div class="w-summary-info mb-1 flex justify-between font-semibold text-white-dark">
                                    <h6>Safari</h6>
                                    <p class="text-xs ltr:ml-auto rtl:mr-auto">40%</p>
                                </div>
                                <div>
                                    <div
                                        class="h-5 w-full overflow-hidden rounded-full bg-dark-light p-1 shadow-3xl dark:bg-dark-light/10 dark:shadow-none">
                                        <div class="relative h-full w-full rounded-full bg-gradient-to-r from-[#a71d31] to-[#3f0d12] before:absolute before:inset-y-0 before:m-auto before:h-2 before:w-2 before:rounded-full before:bg-white ltr:before:right-0.5 rtl:before:left-0.5"
                                            style="width: 40%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="h-9 w-9">
                                <div
                                    class="flex h-9 w-9 items-center justify-center rounded-xl bg-warning/10 text-warning dark:bg-warning dark:text-white-light">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                                        <path opacity="0.5"
                                            d="M2 12H22M16 12C16 13.3132 15.8965 14.6136 15.6955 15.8268C15.4945 17.0401 15.1999 18.1425 14.8284 19.0711C14.457 19.9997 14.016 20.7362 13.5307 21.2388C13.0454 21.7413 12.5253 22 12 22C11.4747 22 10.9546 21.7413 10.4693 21.2388C9.98396 20.7362 9.54301 19.9997 9.17157 19.0711C8.80014 18.1425 8.5055 17.0401 8.30448 15.8268C8.10346 14.6136 8 13.3132 8 12C8 10.6868 8.10346 9.38642 8.30448 8.17316C8.5055 6.95991 8.80014 5.85752 9.17157 4.92893C9.54301 4.00035 9.98396 3.26375 10.4693 2.7612C10.9546 2.25866 11.4747 2 12 2C12.5253 2 13.0454 2.25866 13.5307 2.76121C14.016 3.26375 14.457 4.00035 14.8284 4.92893C15.1999 5.85752 15.4945 6.95991 15.6955 8.17317C15.8965 9.38642 16 10.6868 16 12Z"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                        <path
                                            d="M22 12C22 13.3132 21.7413 14.6136 21.2388 15.8268C20.7362 17.0401 19.9997 18.1425 19.0711 19.0711C18.1425 19.9997 17.0401 20.7362 15.8268 21.2388C14.6136 21.7413 13.3132 22 12 22C10.6868 22 9.38642 21.7413 8.17317 21.2388C6.95991 20.7362 5.85752 19.9997 4.92893 19.0711C4.00035 18.1425 3.26375 17.0401 2.7612 15.8268C2.25866 14.6136 2 13.3132 2 12C2 10.6868 2.25866 9.38642 2.76121 8.17316C3.26375 6.95991 4.00035 5.85752 4.92893 4.92893C5.85752 4.00035 6.95991 3.26375 8.17317 2.7612C9.38642 2.25866 10.6868 2 12 2C13.3132 2 14.6136 2.25866 15.8268 2.76121C17.0401 3.26375 18.1425 4.00035 19.0711 4.92893C19.9997 5.85752 20.7362 6.95991 21.2388 8.17317C21.7413 9.38642 22 10.6868 22 12L22 12Z"
                                            stroke="currentColor" stroke-width="1.5" />
                                    </svg>
                                </div>
                            </div>
                            <div class="w-full flex-initial px-3">
                                <div class="w-summary-info mb-1 flex justify-between font-semibold text-white-dark">
                                    <h6>Others</h6>
                                    <p class="text-xs ltr:ml-auto rtl:mr-auto">25%</p>
                                </div>
                                <div>
                                    <div
                                        class="h-5 w-full overflow-hidden rounded-full bg-dark-light p-1 shadow-3xl dark:bg-dark-light/10 dark:shadow-none">
                                        <div class="relative h-full w-full rounded-full bg-gradient-to-r from-[#fe5f75] to-[#fc9842] before:absolute before:inset-y-0 before:m-auto before:h-2 before:w-2 before:rounded-full before:bg-white ltr:before:right-0.5 rtl:before:left-0.5"
                                            style="width: 25%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel h-full p-0">
                    <div class="flex p-5">
                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-primary/10 text-primary dark:bg-primary dark:text-white-light">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5">
                                <circle cx="12" cy="6" r="4" stroke="currentColor" stroke-width="1.5" />
                                <path opacity="0.5" d="M18 9C19.6569 9 21 7.88071 21 6.5C21 5.11929 19.6569 4 18 4"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                <path opacity="0.5" d="M6 9C4.34315 9 3 7.88071 3 6.5C3 5.11929 4.34315 4 6 4"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                <ellipse cx="12" cy="17" rx="6" ry="4" stroke="currentColor" stroke-width="1.5" />
                                <path opacity="0.5"
                                    d="M20 19C21.7542 18.6153 23 17.6411 23 16.5C23 15.3589 21.7542 14.3847 20 14"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                <path opacity="0.5"
                                    d="M4 19C2.24575 18.6153 1 17.6411 1 16.5C1 15.3589 2.24575 14.3847 4 14"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                        </div>
                        <div class="font-semibold ltr:ml-3 rtl:mr-3">
                            <p class="text-xl dark:text-white-light">31.6K</p>
                            <h5 class="text-xs text-[#506690]">Takipçi</h5>
                        </div>
                    </div>
                    <div class="h-40 overflow-hidden">
                        <div x-ref="followers" class="absolute bottom-0 w-full"></div>
                    </div>
                </div>

                <div class="panel h-full p-0">
                    <div class="flex p-5">
                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-danger/10 text-danger dark:bg-danger dark:text-white-light">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5">
                                <path
                                    d="M10.0464 14C8.54044 12.4882 8.67609 9.90087 10.3494 8.22108L15.197 3.35462C16.8703 1.67483 19.4476 1.53865 20.9536 3.05046C22.4596 4.56228 22.3239 7.14956 20.6506 8.82935L18.2268 11.2626"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                <path opacity="0.5"
                                    d="M13.9536 10C15.4596 11.5118 15.3239 14.0991 13.6506 15.7789L11.2268 18.2121L8.80299 20.6454C7.12969 22.3252 4.55237 22.4613 3.0464 20.9495C1.54043 19.4377 1.67609 16.8504 3.34939 15.1706L5.77323 12.7373"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                        </div>
                        <div class="font-semibold ltr:ml-3 rtl:mr-3">
                            <p class="text-xl dark:text-white-light">1,900</p>
                            <h5 class="text-xs text-[#506690]">Paylaşım</h5>
                        </div>
                    </div>
                    <div class="h-40 overflow-hidden">
                        <div x-ref="referral" class="absolute bottom-0 w-full"></div>
                    </div>
                </div>

                <div class="panel h-full p-0">
                    <div class="flex p-5">
                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-success/10 text-success dark:bg-success dark:text-white-light">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5">
                                <path
                                    d="M10 22C14.4183 22 18 18.4183 18 14C18 9.58172 14.4183 6 10 6C5.58172 6 2 9.58172 2 14C2 15.2355 2.28008 16.4056 2.7802 17.4502C2.95209 17.8093 3.01245 18.2161 2.90955 18.6006L2.58151 19.8267C2.32295 20.793 3.20701 21.677 4.17335 21.4185L5.39939 21.0904C5.78393 20.9876 6.19071 21.0479 6.54976 21.2198C7.5944 21.7199 8.76449 22 10 22Z"
                                    stroke="currentColor" stroke-width="1.5" />
                                <path opacity="0.5"
                                    d="M18 14.5018C18.0665 14.4741 18.1324 14.4453 18.1977 14.4155C18.5598 14.2501 18.9661 14.1882 19.3506 14.2911L19.8267 14.4185C20.793 14.677 21.677 13.793 21.4185 12.8267L21.2911 12.3506C21.1882 11.9661 21.2501 11.5598 21.4155 11.1977C21.7908 10.376 22 9.46242 22 8.5C22 4.91015 19.0899 2 15.5 2C12.7977 2 10.4806 3.64899 9.5 5.9956"
                                    stroke="currentColor" stroke-width="1.5" />
                                <g opacity="0.5">
                                    <path
                                        d="M7.5 14C7.5 14.5523 7.05228 15 6.5 15C5.94772 15 5.5 14.5523 5.5 14C5.5 13.4477 5.94772 13 6.5 13C7.05228 13 7.5 13.4477 7.5 14Z"
                                        fill="currentColor" />
                                    <path
                                        d="M11 14C11 14.5523 10.5523 15 10 15C9.44772 15 9 14.5523 9 14C9 13.4477 9.44772 13 10 13C10.5523 13 11 13.4477 11 14Z"
                                        fill="currentColor" />
                                    <path
                                        d="M14.5 14C14.5 14.5523 14.0523 15 13.5 15C12.9477 15 12.5 14.5523 12.5 14C12.5 13.4477 12.9477 13 13.5 13C14.0523 13 14.5 13.4477 14.5 14Z"
                                        fill="currentColor" />
                                </g>
                            </svg>
                        </div>
                        <div class="font-semibold ltr:ml-3 rtl:mr-3">
                            <p class="text-xl dark:text-white-light">18.2%</p>
                            <h5 class="text-xs text-[#506690]">Yorum</h5>
                        </div>
                    </div>
                    <div class="h-40 overflow-hidden">
                        <div x-ref="engagement" class="absolute bottom-0 w-full"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end main content section -->
@endsection