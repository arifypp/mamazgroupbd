<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">মেনু</li>

                <li>
                    <a href="{{ route('agent.dashboard') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">ড্যাশবোর্ড</span>
                    </a>
                </li>

                <li class="menu-title" key="t-apps">প্রয়োজনীয় মেনু</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-wallet"></i>
                        <span key="t-booking">টাকা যুক্ত করুন</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('agent.addmoney') }}" key="t-cash-sending"> অ্যাড মানি </a></li>
                        <li><a href="{{ route('agent.userrequest') }}" key="t-cash-request"> মানি রিকুয়েস্ট </a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-file"></i>
                        <span key="t-booking">বুকিং ম্যানেজমেন্ট</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('bbooking.new') }}" key="t-booking-pending"> নতুন বুকিং <span class="badge rounded-pill bg-danger float-end">
                        @php
                            $counts = DB::table('bookings')->where('status', 0)->count();
                            echo $counts;
                        @endphp
                        </span></a></li>
                        <li><a href="{{ route('bbooking.manage') }}" key="t-total-booking">মোট বুকিং</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-user"></i>
                        <span key="t-customer">কাস্টমার ম্যানেজমেন্ট</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('customer.manage') }}" key="t-customer-total">মোট কাস্টমার</a></li>
                        <li><a href="{{ route('customer.create') }}" key="t-customer-create"> কাস্টমার তৈরি করুন</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-user"></i>
                        <span key="t-employe">এমপ্লয়ী ম্যানেজমেন্ট</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('employe.manage') }}" key="t-employe-total">মোট এমপ্লয়ী</a></li>
                        <li><a href="{{ route('employe.create') }}" key="t-employe-create"> এমপ্লয়ী তৈরি করুন</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-file"></i>
                        <span key="t-application">আবেদন কারীগন</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('application.pending') }}" key="t-application-pending"> নতুন আবেদনকোরী <span class="badge rounded-pill bg-danger float-end">
                        @php
                            $counts = DB::table('applications')->where('status', 0)->count();
                            echo $counts;
                        @endphp
                        </span></a></li>
                        <li><a href="{{ route('application.manage') }}" key="t-total-application">মোট আপ্রুভ আবেদনকারী</a></li>
                    </ul>
                </li>
                
                <li class="menu-title" key="t-apps">প্লাটফর্ম সেটিং</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-home"></i>
                        <span key="t-homesettings">হোম পেইজ সেটিং</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('homesetting.manage') }}" key="t-tui-homehero">হিরো সেটিং</a></li>
                        <li><a href="{{ route('homesetting.favclient') }}" key="t-full-homeclient">প্রিয় ক্লাইন্ট সেটিং</a></li>
                        <li><a href="{{ route('service.manage') }}" key="t-full-service">সার্ভিস সেটিং</a></li>
                        <li><a href="{{ route('oursetting.manage') }}" key="t-our-settings">আমাদের সেটিং</a></li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow"
                                key="t-level-1-2">গ্যালারি সেটিং</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{ route('gallery.manage') }}" key="t-gallery-cat">গ্যালারি ক্যাটাগরি</a>
                                </li>
                                <li><a href="{{ route('gallery.create') }}" key="t-gallery-photo">গ্যালারি ফটো</a>
                                </li>
                            </ul>
                    
                    </li>
                    </ul>
                </li>
                <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-home"></i>
                            <span key="t-about setting">এবাউট পেইজ সেটিং</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li><a href="{{ route('about.create') }}" key="t-about-manage">ম্যানেজ এবাউট</a>
                                </li>
                        </ul>
                    </li>

                <li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-home"></i>
                        <span key="t-contact setting">যোগাযোগ পেইজ সেটিং</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{ route('contact.manage') }}" key="t-contact-manage">ম্যানেজ যোগাযোগ পেইজ</a>
                            </li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('settings.manage') }}" class="waves-effect">
                        <i class="bx bx-aperture"></i>
                        <span key="t-settings">বেসিক সেটিং</span>
                    </a>
                </li>

                <li class="menu-title" key="t-apps">অন্যান্য সেটিং</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-home"></i>
                        <span key="t-wallettype">ওয়ালেট টাইপবক্স</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('wallettype.manage') }}" key="t-tui-wallettypehome">ওয়ালেট ম্যানেজমেন্ট</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-user"></i>
                        <span key="t-promote">কাস্টমার প্রমোট লেভেল</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('promote.manage') }}" key="t-tui-promotion">লেভেল ম্যানেজমেন্ট</a></li>
                        <li><a href="{{ route('promote.create') }}" key="t-tui-message">লেভেল মেসেজ</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
