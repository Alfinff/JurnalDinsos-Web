<div class="col-lg-2 col-md-4 shad ">
    <div class="sidebar">
        <div class="side1 flex-column align-items-center">
            <img src="{{asset('assets/images/photouser.png')}}" alt="">
            <h3>{{auth()->user()->username ?? ''}}</h3>
            <p>Dinsos</p>
        </div>
        <hr>
        <div class="legendside">
            <h6>Menu</h6>
        </div>
        <div class="vertical_nav">
            <ul id="js-menu" style="position: relative;" class="menu">

                <li class="menu--item  ">
                    <a href="{{route('dinsos-home')}}" class="menu--link @if(request()->is('dinsos')) active @endif" title="Item 1">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path class="iconside" d="M20.38 8.57012L19.15 10.4201C19.7432 11.6032 20.0336 12.915 19.9952 14.2378C19.9568 15.5607 19.5908 16.8534 18.93 18.0001H5.06999C4.21116 16.5102 3.85528 14.7832 4.05513 13.0752C4.25497 11.3671 4.9999 9.76895 6.17947 8.51755C7.35904 7.26615 8.91046 6.42816 10.6037 6.12782C12.297 5.82747 14.042 6.08076 15.58 6.85012L17.43 5.62012C15.5465 4.41234 13.3123 3.87113 11.0849 4.08306C8.85744 4.29499 6.76543 5.24782 5.14348 6.78913C3.52153 8.33045 2.46335 10.3712 2.13821 12.5849C1.81306 14.7987 2.23974 17.0575 3.34999 19.0001C3.5245 19.3024 3.77508 19.5537 4.07682 19.7292C4.37856 19.9046 4.72096 19.998 5.06999 20.0001H18.92C19.2724 20.0015 19.6189 19.9098 19.9245 19.7342C20.2301 19.5586 20.4838 19.3053 20.66 19.0001C21.5814 17.404 22.0438 15.5844 21.9961 13.7421C21.9485 11.8998 21.3926 10.1064 20.39 8.56012L20.38 8.57012ZM10.59 15.4101C10.7757 15.5961 10.9963 15.7436 11.2391 15.8442C11.4819 15.9449 11.7422 15.9967 12.005 15.9967C12.2678 15.9967 12.5281 15.9449 12.7709 15.8442C13.0137 15.7436 13.2342 15.5961 13.42 15.4101L19.08 6.92012L10.59 12.5801C10.404 12.7659 10.2565 12.9864 10.1559 13.2292C10.0552 13.472 10.0034 13.7323 10.0034 13.9951C10.0034 14.258 10.0552 14.5182 10.1559 14.761C10.2565 15.0038 10.404 15.2244 10.59 15.4101Z" fill="#8C8C8C"/>
                    </svg>

                    <span class="menu--label">Dashboard</span>
                    </a>
                </li>

                @php
                    $url = explode('/', request()->path());
                @endphp
                @if(isset(auth()->user()->module->master_kepegawaian) && (auth()->user()->module->master_kepegawaian == 1))
                <li class="menu--item menu--item__has_sub_menu @if(isset($url[1])) @if($url[1] == 'pegawai') menu--subitens__opened @else @endif @endif">
                    <label class="menu--link" title="Item 2">
                    <svg width="24" class="iconside" height="12" viewBox="0 0 24 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 7C5.1 7 6 6.1 6 5C6 3.9 5.1 3 4 3C2.9 3 2 3.9 2 5C2 6.1 2.9 7 4 7ZM5.13 8.1C4.76 8.04 4.39 8 4 8C3.01 8 2.07 8.21 1.22 8.58C0.48 8.9 0 9.62 0 10.43V12H4.5V10.39C4.5 9.56 4.73 8.78 5.13 8.1ZM20 7C21.1 7 22 6.1 22 5C22 3.9 21.1 3 20 3C18.9 3 18 3.9 18 5C18 6.1 18.9 7 20 7ZM24 10.43C24 9.62 23.52 8.9 22.78 8.58C21.93 8.21 20.99 8 20 8C19.61 8 19.24 8.04 18.87 8.1C19.27 8.78 19.5 9.56 19.5 10.39V12H24V10.43ZM16.24 7.65C15.07 7.13 13.63 6.75 12 6.75C10.37 6.75 8.93 7.14 7.76 7.65C6.68 8.13 6 9.21 6 10.39V12H18V10.39C18 9.21 17.32 8.13 16.24 7.65ZM8.07 10C8.16 9.77 8.2 9.61 8.98 9.31C9.95 8.93 10.97 8.75 12 8.75C13.03 8.75 14.05 8.93 15.02 9.31C15.79 9.61 15.83 9.77 15.93 10H8.07ZM12 2C12.55 2 13 2.45 13 3C13 3.55 12.55 4 12 4C11.45 4 11 3.55 11 3C11 2.45 11.45 2 12 2ZM12 0C10.34 0 9 1.34 9 3C9 4.66 10.34 6 12 6C13.66 6 15 4.66 15 3C15 1.34 13.66 0 12 0Z" fill="#8C8C8C"/>
                    </svg>

                    <span class="menu--label">Master Kepegawaian</span>
                    </label>
                    <ul class="sub_menu">
                        <li class="sub_menu--item">
                            <a href="{{route('dinsos-pegawai')}}" class="sub_menu--link @if(isset($url[1])) @if($url[1] == 'pegawai') active @else @endif @endif">
                            <svg width="24" height="24" class="iconside" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 5.9C13.16 5.9 14.1 6.84 14.1 8C14.1 9.16 13.16 10.1 12 10.1C10.84 10.1 9.9 9.16 9.9 8C9.9 6.84 10.84 5.9 12 5.9ZM12 14.9C14.97 14.9 18.1 16.36 18.1 17V18.1H5.9V17C5.9 16.36 9.03 14.9 12 14.9ZM12 4C9.79 4 8 5.79 8 8C8 10.21 9.79 12 12 12C14.21 12 16 10.21 16 8C16 5.79 14.21 4 12 4ZM12 13C9.33 13 4 14.34 4 17V20H20V17C20 14.34 14.67 13 12 13Z" fill="#8C8C8C"/>
                            </svg>
                            Data Pegawai
                            </a>
                        </li>

                    {{-- <li class="sub_menu--item">
                        <a href="{{route('dinsos-pegawai-struktur')}}" class="sub_menu--link @if(request()->is('dinsos/pegawai/semua')) active @endif">
                        <svg width="24" class="iconside" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 3H14.82C14.4 1.84 13.3 1 12 1C10.7 1 9.6 1.84 9.18 3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19V5C21 3.9 20.1 3 19 3ZM12 2.75C12.22 2.75 12.41 2.85 12.55 3C12.67 3.13 12.75 3.31 12.75 3.5C12.75 3.91 12.41 4.25 12 4.25C11.59 4.25 11.25 3.91 11.25 3.5C11.25 3.31 11.33 3.13 11.45 3C11.59 2.85 11.78 2.75 12 2.75ZM19 19H5V5H19V19ZM12 6C10.35 6 9 7.35 9 9C9 10.65 10.35 12 12 12C13.65 12 15 10.65 15 9C15 7.35 13.65 6 12 6ZM12 10C11.45 10 11 9.55 11 9C11 8.45 11.45 8 12 8C12.55 8 13 8.45 13 9C13 9.55 12.55 10 12 10ZM6 16.47V18H18V16.47C18 13.97 14.03 12.89 12 12.89C9.97 12.89 6 13.96 6 16.47ZM8.31 16C9 15.44 10.69 14.88 12 14.88C13.31 14.88 15.01 15.44 15.69 16H8.31Z" fill="#8C8C8C"/>
                        </svg>
                        Struktur
                        </a>
                    </li> --}}
                    {{-- <li class="sub_menu--item">
                        <a href="{{route('dinsos-pegawai-aktif')}}" class="sub_menu--link @if(request()->is('dinsos/pegawai/aktif')) active @endif">
                        <svg width="24" class="iconside" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 13.75C6.66 13.75 2 14.92 2 17.25V19H16V17.25C16 14.92 11.34 13.75 9 13.75ZM4.34 17C5.18 16.42 7.21 15.75 9 15.75C10.79 15.75 12.82 16.42 13.66 17H4.34ZM9 12C10.93 12 12.5 10.43 12.5 8.5C12.5 6.57 10.93 5 9 5C7.07 5 5.5 6.57 5.5 8.5C5.5 10.43 7.07 12 9 12ZM9 7C9.83 7 10.5 7.67 10.5 8.5C10.5 9.33 9.83 10 9 10C8.17 10 7.5 9.33 7.5 8.5C7.5 7.67 8.17 7 9 7ZM16.04 13.81C17.2 14.65 18 15.77 18 17.25V19H22V17.25C22 15.23 18.5 14.08 16.04 13.81ZM15 12C16.93 12 18.5 10.43 18.5 8.5C18.5 6.57 16.93 5 15 5C14.46 5 13.96 5.13 13.5 5.35C14.13 6.24 14.5 7.33 14.5 8.5C14.5 9.67 14.13 10.76 13.5 11.65C13.96 11.87 14.46 12 15 12Z" fill="#8C8C8C"/>
                        </svg>

                        </a>
                    </li> --}}

                    </ul>
                </li>
                @endif

                @if(isset(auth()->user()->module->kegiatan) && (auth()->user()->module->kegiatan == 1))
                <li class="menu--item">
                    <a href="{{route('dinsos-kegiatan')}}" class="menu--link @if(isset($url[1])) @if($url[1] == 'kegiatan') active @else @endif @endif" title="Item 3">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path class="iconside" d="M8 4H14V6H8V4ZM8 8H14V10H8V8ZM8 12H14V14H8V12ZM4 4H6V6H4V4ZM4 8H6V10H4V8ZM4 12H6V14H4V12ZM17.1 0H0.9C0.4 0 0 0.4 0 0.9V17.1C0 17.5 0.4 18 0.9 18H17.1C17.5 18 18 17.5 18 17.1V0.9C18 0.4 17.5 0 17.1 0ZM16 16H2V2H16V16Z" fill="#8C8C8C"/>
                    </svg>
                    <span class="menu--label">Kegiatan UPT</span>
                    </a>
                </li>
                @endif

                @if(isset(auth()->user()->module->data_upt) && (auth()->user()->module->data_upt == 1))
                <li class="menu--item">
                    <a href="{{route('dinsos-dataupt')}}" class="menu--link @if(isset($url[1])) @if($url[1] == 'dataupt') active @else @endif @endif" title="Item 4">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path class="iconside" d="M17 15H19V17H17V15ZM17 11H19V13H17V11ZM17 7H19V9H17V7ZM13.74 7L15 7.84V7H13.74Z" fill="#8C8C8C"/>
                        <path class="iconside" d="M10 3V4.51L12 5.84V5H21V19H17V21H23V3H10Z" fill="#8C8C8C"/>
                        <path class="iconside" d="M8.17 5.7002L15 10.2502V21.0002H1V10.4802L8.17 5.7002ZM10 19.0002H13V11.1602L8.17 8.0902L3 11.3802V19.0002H6V13.0002H10V19.0002Z" fill="#8C8C8C"/>
                    </svg>
                    <span class="menu--label">Data UPT</span>
                    </a>
                </li>
                @endif

                @if(isset(auth()->user()->module->data_pendaftar) && (auth()->user()->module->data_pendaftar == 1))
                <li class="menu--item">
                    <a href="{{route('dinsos-pegawai-pendaftar')}}" class="menu--link @if(isset($url[1])) @if($url[1] == 'pendaftar') active @else @endif @endif">
                    <svg width="24" class="iconside" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13 8C13 5.79 11.21 4 9 4C6.79 4 5 5.79 5 8C5 10.21 6.79 12 9 12C11.21 12 13 10.21 13 8ZM11 8C11 9.1 10.1 10 9 10C7.9 10 7 9.1 7 8C7 6.9 7.9 6 9 6C10.1 6 11 6.9 11 8ZM1 18V20H17V18C17 15.34 11.67 14 9 14C6.33 14 1 15.34 1 18ZM3 18C3.2 17.29 6.3 16 9 16C11.69 16 14.78 17.28 15 18H3ZM20 15V12H23V10H20V7H18V10H15V12H18V15H20Z" fill="#8C8C8C"/>
                    </svg>

                    <span class="menu--label">Data Pendaftar</span>
                    </a>
                </li>
                @endif
                {{-- <li class="menu--item">
                    <a href="{{route('pegawai-upt')}}" class="menu--link @if(isset($url[1])) @if($url[1] == 'pegawai-upt') active @else @endif @endif" title="Item 4">
                    <svg width="24" height="24" class="iconside" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 5.9C13.16 5.9 14.1 6.84 14.1 8C14.1 9.16 13.16 10.1 12 10.1C10.84 10.1 9.9 9.16 9.9 8C9.9 6.84 10.84 5.9 12 5.9ZM12 14.9C14.97 14.9 18.1 16.36 18.1 17V18.1H5.9V17C5.9 16.36 9.03 14.9 12 14.9ZM12 4C9.79 4 8 5.79 8 8C8 10.21 9.79 12 12 12C14.21 12 16 10.21 16 8C16 5.79 14.21 4 12 4ZM12 13C9.33 13 4 14.34 4 17V20H20V17C20 14.34 14.67 13 12 13Z" fill="#8C8C8C"/>
                    </svg>
                    <span class="menu--label">Data Pegawai</span>
                    </a>
                </li> --}}

                @if(isset(auth()->user()->module->master_pengguna) && (auth()->user()->module->master_pengguna == 1))
                <li class="menu--item">
                    <a href="{{route('dinsos-pengguna')}}" class="menu--link @if(isset($url[1])) @if($url[1] == 'pengguna') active @else @endif @endif" title="Item 3">
                    <svg width="24" class="iconside" height="12" viewBox="0 0 24 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 7C5.1 7 6 6.1 6 5C6 3.9 5.1 3 4 3C2.9 3 2 3.9 2 5C2 6.1 2.9 7 4 7ZM5.13 8.1C4.76 8.04 4.39 8 4 8C3.01 8 2.07 8.21 1.22 8.58C0.48 8.9 0 9.62 0 10.43V12H4.5V10.39C4.5 9.56 4.73 8.78 5.13 8.1ZM20 7C21.1 7 22 6.1 22 5C22 3.9 21.1 3 20 3C18.9 3 18 3.9 18 5C18 6.1 18.9 7 20 7ZM24 10.43C24 9.62 23.52 8.9 22.78 8.58C21.93 8.21 20.99 8 20 8C19.61 8 19.24 8.04 18.87 8.1C19.27 8.78 19.5 9.56 19.5 10.39V12H24V10.43ZM16.24 7.65C15.07 7.13 13.63 6.75 12 6.75C10.37 6.75 8.93 7.14 7.76 7.65C6.68 8.13 6 9.21 6 10.39V12H18V10.39C18 9.21 17.32 8.13 16.24 7.65ZM8.07 10C8.16 9.77 8.2 9.61 8.98 9.31C9.95 8.93 10.97 8.75 12 8.75C13.03 8.75 14.05 8.93 15.02 9.31C15.79 9.61 15.83 9.77 15.93 10H8.07ZM12 2C12.55 2 13 2.45 13 3C13 3.55 12.55 4 12 4C11.45 4 11 3.55 11 3C11 2.45 11.45 2 12 2ZM12 0C10.34 0 9 1.34 9 3C9 4.66 10.34 6 12 6C13.66 6 15 4.66 15 3C15 1.34 13.66 0 12 0Z" fill="#8C8C8C"/>
                    </svg>
                    <span class="menu--label">Master Pengguna</span>
                    </a>
                </li>
                @endif
            </ul>
            <hr style="border: 1px solid #E9E9E9;">
            <ul id="js-menu" class="menu" style="position: relative">
                <li class="menu--item logoutside">
                    <a href="{{route('logout')}}" class="menu--link" title="Item 1">
                        <svg class="iconside" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.09 15.59L11.5 17L16.5 12L11.5 7L10.09 8.41L12.67 11H3V13H12.67L10.09 15.59ZM19 3H5C3.89 3 3 3.9 3 5V9H5V5H19V19H5V15H3V19C3 20.1 3.89 21 5 21H19C20.1 21 21 20.1 21 19V5C21 3.9 20.1 3 19 3Z" fill="#8C8C8C"/>
                        </svg>
                    <span class="menu--label">Keluar</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
