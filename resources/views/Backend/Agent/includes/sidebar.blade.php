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
                        <i class="bx bx-box"></i>
                        <span key="t-withdraw">টাকা উইথড্রো সেটিংস</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('withdraw.agent.withdraw') }}" key="t-cash-withdraw"> উইথড্রো করুন </a></li>
                        <li><a href="{{ route('withdraw.agent.manage') }}" key="t-cash-withdraw"> উইথড্রো লিস্ট </a></li>
                    </ul>
                </li>
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
                        <li><a href="{{ route('booking.agent.new') }}" key="t-booking-pending"> নতুন বুকিং <span class="badge rounded-pill bg-danger float-end">
                        @php
                            $counts = DB::table('bookings')->where('status', 0)->count();
                            echo $counts;
                        @endphp
                        </span></a></li>
                        <li><a href="{{ route('booking.agent.manage') }}" key="t-total-booking">মোট বুকিং</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-user"></i>
                        <span key="t-customer">কাস্টমার ম্যানেজমেন্ট</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('user.manage') }}" key="t-users-total">মোট কাস্টমার</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-file"></i>
                        <span key="t-application">আবেদন কারীগন</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('agent.application') }}" key="t-application-pending"> নতুন আবেদনকোরী <span class="badge rounded-pill bg-danger float-end">
                        @php
                            $counts = DB::table('applications')->where('status', 0)->where('referrelID', Auth()->user()->id)->count();
                            echo $counts;
                        @endphp
                        </span></a></li>
                        <li><a href="{{ route('agent.approved.application') }}" key="t-total-application">মোট আবেদনকারী</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-file"></i>
                        <span key="t-reports">রিপোর্ট লিস্ট</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('agent.report.pending') }}" key="t-reports-pending"> রিকুয়েস্ট রিপোর্ট</a></li>
                        <li><a href="{{ route('agent.approved.report') }}" key="t-total-reports"> এ্যাপ্রুভ রিপোর্ট </a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('agent.transactionlist') }}" class="waves-effect">
                        <i class="bx bx-book"></i>
                        <span key="t-transactionlist">ট্রান্সিকশন লিস্ট</span>
                    </a>
                </li>

                

                <li class="menu-title" key="t-apps">অন্যান্য সেটিং</li>

                <li>
                    <a class="waves-effect" href="javascript:void();" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bx bx-power-off"></i> <span key="t-logout">লগআউট</span></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                   
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
