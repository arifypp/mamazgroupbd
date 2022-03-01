<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">মেনু</li>

                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">ড্যাশবোর্ড</span>
                    </a>
                </li>

                <li class="menu-title" key="t-apps">ফিচারড সেটিং</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-duplicate"></i>
                        <span key="t-booking">জমি যুক্ত করুন</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('landcat.manage') }}" key="t-landcat-pending"> জমির লিস্ট দেখুন </a></li>
                        <li><a href="{{ route('landcat.create') }}" key="t-total-landcat"> নতুন জমি যুক্ত করুন</a></li>
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


                <li class="menu-title" key="t-apps">@lang('translation.Apps')</li>

                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="bx bx-calendar"></i><span class="badge rounded-pill bg-success float-end">New</span>
                        <span key="t-dashboards">@lang('translation.Calendars')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="calendar" key="t-tui-calendar">@lang('translation.TUI_Calendar')</a></li>
                        <li><a href="calendar-full" key="t-full-calendar">@lang('translation.Full_Calendar')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="chat" class="waves-effect">
                        <i class="bx bx-chat"></i>
                        <span key="t-chat">@lang('translation.Chat')</span>
                    </a>
                </li>

                <li>
                    <a href="apps-filemanager" class="waves-effect">
                        <i class="bx bx-file"></i>
                        <span class="badge rounded-pill bg-success float-end"
                            key="t-new">@lang('translation.New')</span>
                        <span key="t-file-manager">@lang('translation.File_Manager')</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-store"></i>
                        <span key="t-ecommerce">@lang('translation.Ecommerce')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="ecommerce-products" key="t-products">@lang('translation.Products')</a></li>
                        <li><a href="ecommerce-product-detail"
                                key="t-product-detail">@lang('translation.Product_Detail')</a></li>
                        <li><a href="ecommerce-orders" key="t-orders">@lang('translation.Orders')</a></li>
                        <li><a href="ecommerce-customers" key="t-customers">@lang('translation.Customers')</a></li>
                        <li><a href="ecommerce-cart" key="t-cart">@lang('translation.Cart')</a></li>
                        <li><a href="ecommerce-checkout" key="t-checkout">@lang('translation.Checkout')</a></li>
                        <li><a href="ecommerce-shops" key="t-shops">@lang('translation.Shops')</a></li>
                        <li><a href="ecommerce-add-product" key="t-add-product">@lang('translation.Add_Product')</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-bitcoin"></i>
                        <span key="t-crypto">@lang('translation.Crypto')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="crypto-wallet" key="t-wallet">@lang('translation.Wallet')</a></li>
                        <li><a href="crypto-buy-sell" key="t-buy">@lang('translation.Buy_Sell')</a></li>
                        <li><a href="crypto-exchange" key="t-exchange">@lang('translation.Exchange')</a></li>
                        <li><a href="crypto-lending" key="t-lending">@lang('translation.Lending')</a></li>
                        <li><a href="crypto-orders" key="t-orders">@lang('translation.Orders')</a></li>
                        <li><a href="crypto-kyc-application" key="t-kyc">@lang('translation.KYC_Application')</a></li>
                        <li><a href="crypto-ico-landing" key="t-ico">@lang('translation.ICO_Landing')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-envelope"></i>
                        <span key="t-email">@lang('translation.Email')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="email-inbox" key="t-inbox">@lang('translation.Inbox')</a></li>
                        <li><a href="email-read" key="t-read-email">@lang('translation.Read_Email')</a></li>
                        <li>
                            <a href="javascript: void(0);">
                                <span class="badge rounded-pill badge-soft-success float-end"
                                    key="t-new">@lang('translation.New')</span>
                                <span key="t-email-templates">@lang('translation.Templates')</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="email-template-basic"
                                        key="t-basic-action">@lang('translation.Basic_Action')</a></li>
                                <li><a href="email-template-alert"
                                        key="t-alert-email">@lang('translation.Alert_Email')</a></li>
                                <li><a href="email-template-billing"
                                        key="t-bill-email">@lang('translation.Billing_Email')</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-receipt"></i>
                        <span key="t-invoices">@lang('translation.Invoices')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="invoices-list" key="t-invoice-list">@lang('translation.Invoice_List')</a></li>
                        <li><a href="invoices-detail" key="t-invoice-detail">@lang('translation.Invoice_Detail')</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-briefcase-alt-2"></i>
                        <span key="t-projects">@lang('translation.Projects')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="projects-grid" key="t-p-grid">@lang('translation.Projects_Grid')</a></li>
                        <li><a href="projects-list" key="t-p-list">@lang('translation.Projects_List')</a></li>
                        <li><a href="projects-overview" key="t-p-overview">@lang('translation.Project_Overview')</a>
                        </li>
                        <li><a href="projects-create" key="t-create-new">@lang('translation.Create_New')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-task"></i>
                        <span key="t-tasks">@lang('translation.Tasks')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="tasks-list" key="t-task-list">@lang('translation.Task_List')</a></li>
                        <li><a href="tasks-kanban" key="t-kanban-board">@lang('translation.Kanban_Board')</a></li>
                        <li><a href="tasks-create" key="t-create-task">@lang('translation.Create_Task')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bxs-user-detail"></i>
                        <span key="t-contacts">@lang('translation.Contacts')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="contacts-grid" key="t-user-grid">@lang('translation.User_Grid')</a></li>
                        <li><a href="contacts-list" key="t-user-list">@lang('translation.User_List')</a></li>
                        <li><a href="contacts-profile" key="t-profile">@lang('translation.Profile')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <span class="badge rounded-pill bg-success float-end"
                            key="t-new">@lang('translation.New')</span>
                        <i class="bx bx-detail"></i>
                        <span key="t-blog">@lang('translation.Blog')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="blog-list" key="t-blog-list">@lang('translation.Blog_List')</a></li>
                        <li><a href="blog-grid" key="t-blog-grid">@lang('translation.Blog_Grid')</a></li>
                        <li><a href="blog-details" key="t-blog-details">@lang('translation.Blog_Details')</a></li>
                    </ul>
                </li>

                <li class="menu-title" key="t-pages">@lang('translation.Pages')</li>

                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <span class="badge rounded-pill bg-success float-end"
                            key="t-new">@lang('translation.New')</span>
                        <i class="bx bx-user-circle"></i>
                        <span key="t-authentication">@lang('translation.Authentication')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="auth-login" key="t-login">@lang('translation.Login')</a></li>
                        <li><a href="auth-login-2" key="t-login-2">@lang('translation.Login') 2</a></li>
                        <li><a href="auth-register" key="t-register">@lang('translation.Register')</a></li>
                        <li><a href="auth-register-2" key="t-register-2">@lang('translation.Register') 2</a></li>
                        <li><a href="auth-recoverpw" key="t-recover-password">@lang('translation.Recover_Password')</a>
                        </li>
                        <li><a href="auth-recoverpw-2" key="t-recover-password-2">@lang('translation.Recover_Password')
                                2</a></li>
                        <li><a href="auth-lock-screen" key="t-lock-screen">@lang('translation.Lock_Screen')</a></li>
                        <li><a href="auth-lock-screen-2" key="t-lock-screen-2">@lang('translation.Lock_Screen') 2</a>
                        </li>
                        <li><a href="auth-confirm-mail" key="t-confirm-mail">@lang('translation.Confirm_Mail')</a></li>
                        <li><a href="auth-confirm-mail-2" key="t-confirm-mail-2">@lang('translation.Confirm_Mail') 2</a>
                        </li>
                        <li><a href="auth-email-verification"
                                key="t-email-verification">@lang('translation.Email_verification')</a></li>
                        <li><a href="auth-email-verification-2"
                                key="t-email-verification-2">@lang('translation.Email_verification') 2</a></li>
                        <li><a href="auth-two-step-verification"
                                key="t-two-step-verification">@lang('translation.Two_step_verification')</a></li>
                        <li><a href="auth-two-step-verification-2"
                                key="t-two-step-verification-2">@lang('translation.Two_step_verification') 2</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-file"></i>
                        <span key="t-utility">@lang('translation.Utility')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="pages-starter" key="t-starter-page">@lang('translation.Starter_Page')</a></li>
                        <li><a href="pages-maintenance" key="t-maintenance">@lang('translation.Maintenance')</a></li>
                        <li><a href="pages-comingsoon" key="t-coming-soon">@lang('translation.Coming_Soon')</a></li>
                        <li><a href="pages-timeline" key="t-timeline">@lang('translation.Timeline')</a></li>
                        <li><a href="pages-faqs" key="t-faqs">@lang('translation.FAQs')</a></li>
                        <li><a href="pages-pricing" key="t-pricing">@lang('translation.Pricing')</a></li>
                        <li><a href="pages-404" key="t-error-404">@lang('translation.Error_404')</a></li>
                        <li><a href="pages-500" key="t-error-500">@lang('translation.Error_500')</a></li>
                    </ul>
                </li>

                <li class="menu-title" key="t-components">@lang('translation.Components')</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-tone"></i>
                        <span key="t-ui-elements">@lang('translation.UI_Elements')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="ui-alerts" key="t-alerts">@lang('translation.Alerts')</a></li>
                        <li><a href="ui-buttons" key="t-buttons">@lang('translation.Buttons')</a></li>
                        <li><a href="ui-cards" key="t-cards">@lang('translation.Cards')</a></li>
                        <li><a href="ui-carousel" key="t-carousel">@lang('translation.Carousel')</a></li>
                        <li><a href="ui-dropdowns" key="t-dropdowns">@lang('translation.Dropdowns')</a></li>
                        <li><a href="ui-grid" key="t-grid">@lang('translation.Grid')</a></li>
                        <li><a href="ui-images" key="t-images">@lang('translation.Images')</a></li>
                        <li><a href="ui-lightbox" key="t-lightbox">@lang('translation.Lightbox')</a></li>
                        <li><a href="ui-modals" key="t-modals">@lang('translation.Modals')</a></li>
                        <li><a href="ui-offcanvas" key="t-offcanvas">@lang('translation.Offcanvas')</a></li>
                        <li><a href="ui-rangeslider" key="t-range-slider">@lang('translation.Range_Slider')</a></li>
                        <li><a href="ui-session-timeout" key="t-session-timeout">@lang('translation.Session_Timeout')</a></li>
                        <li><a href="ui-progressbars" key="t-progress-bars">@lang('translation.Progress_Bars')</a></li>
                        <li><a href="ui-placeholders" key="t-placeholders">@lang('translation.Placeholders')</a></li>
                        <li><a href="ui-sweet-alert" key="t-sweet-alert">@lang('translation.Sweet_Alert')</a></li>
                        <li><a href="ui-tabs-accordions" key="t-tabs-accordions">@lang('translation.Tabs_&_Accordions')</a></li>
                        <li><a href="ui-typography" key="t-typography">@lang('translation.Typography')</a></li>
                        <li><a href="ui-toasts" key="t-toasts">@lang('translation.Toasts')</a></li>
                        <li><a href="ui-video" key="t-video">@lang('translation.Video')</a></li>
                        <li><a href="ui-general" key="t-general">@lang('translation.General')</a></li>
                        <li><a href="ui-colors" key="t-colors">@lang('translation.Colors')</a></li>
                        <li><a href="ui-rating" key="t-rating">@lang('translation.Rating')</a></li>
                        <li><a href="ui-notifications" key="t-notifications">@lang('translation.Notifications')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="bx bxs-eraser"></i>
                        <span class="badge rounded-pill bg-danger float-end">10</span>
                        <span key="t-forms">@lang('translation.Forms')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="form-elements" key="t-form-elements">@lang('translation.Form_Elements')</a></li>
                        <li><a href="form-layouts" key="t-form-layouts">@lang('translation.Form_Layouts')</a></li>
                        <li><a href="form-validation" key="t-form-validation">@lang('translation.Form_Validation')</a>
                        </li>
                        <li><a href="form-advanced" key="t-form-advanced">@lang('translation.Form_Advanced')</a></li>
                        <li><a href="form-editors" key="t-form-editors">@lang('translation.Form_Editors')</a></li>
                        <li><a href="form-uploads" key="t-form-upload">@lang('translation.Form_File_Upload')</a></li>
                        <li><a href="form-xeditable" key="t-form-xeditable">@lang('translation.Form_Xeditable')</a></li>
                        <li><a href="form-repeater" key="t-form-repeater">@lang('translation.Form_Repeater')</a></li>
                        <li><a href="form-wizard" key="t-form-wizard">@lang('translation.Form_Wizard')</a></li>
                        <li><a href="form-mask" key="t-form-mask">@lang('translation.Form_Mask')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-list-ul"></i>
                        <span key="t-tables">@lang('translation.Tables')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="tables-basic" key="t-basic-tables">@lang('translation.Basic_Tables')</a></li>
                        <li><a href="tables-datatable" key="t-data-tables">@lang('translation.Data_Tables')</a></li>
                        <li><a href="tables-responsive"
                                key="t-responsive-table">@lang('translation.Responsive_Table')</a></li>
                        <li><a href="tables-editable" key="t-editable-table">@lang('translation.Editable_Table')</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bxs-bar-chart-alt-2"></i>
                        <span key="t-charts">@lang('translation.Charts')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="charts-apex" key="t-apex-charts">@lang('translation.Apex_Charts')</a></li>
                        <li><a href="charts-echart" key="t-e-charts">@lang('translation.E_Charts')</a></li>
                        <li><a href="charts-chartjs" key="t-chartjs-charts">@lang('translation.Chartjs_Charts')</a></li>
                        <li><a href="charts-flot" key="t-flot-charts">@lang('translation.Flot_Charts')</a></li>
                        <li><a href="charts-tui" key="t-ui-charts">@lang('translation.Toast_UI_Charts')</a></li>
                        <li><a href="charts-knob" key="t-knob-charts">@lang('translation.Jquery_Knob_Charts')</a></li>
                        <li><a href="charts-sparkline"
                                key="t-sparkline-charts">@lang('translation.Sparkline_Charts')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-aperture"></i>
                        <span key="t-icons">@lang('translation.Icons')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="icons-boxicons" key="t-boxicons">@lang('translation.Boxicons')</a></li>
                        <li><a href="icons-materialdesign"
                                key="t-material-design">@lang('translation.Material_Design')</a></li>
                        <li><a href="icons-dripicons" key="t-dripicons">@lang('translation.Dripicons')</a></li>
                        <li><a href="icons-fontawesome" key="t-font-awesome">@lang('translation.Font_awesome')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-map"></i>
                        <span key="t-maps">@lang('translation.Maps')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="maps-google" key="t-g-maps">@lang('translation.Google_Maps')</a></li>
                        <li><a href="maps-vector" key="t-v-maps">@lang('translation.Vector_Maps')</a></li>
                        <li><a href="maps-leaflet" key="t-l-maps">@lang('translation.Leaflet_Maps')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-share-alt"></i>
                        <span key="t-multi-level">@lang('translation.Multi_Level')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="javascript: void(0);" key="t-level-1-1">@lang('translation.Level_1.1')</a></li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow"
                                key="t-level-1-2">@lang('translation.Level_1.2')</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="javascript: void(0);" key="t-level-2-1">@lang('translation.Level_2.1')</a>
                                </li>
                                <li><a href="javascript: void(0);" key="t-level-2-2">@lang('translation.Level_2.2')</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
