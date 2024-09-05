<!doctype html>
<html dir="rtl" class="js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <!-- CSRF Token -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('مصرف الأندلس', ' لوحة تحكمANDA BI Report') }}</title>
        <link href="{{ asset('assets/styles/style.min.css') }}" rel="stylesheet">

        <!-- mCustomScrollbar -->
        <link href="{{ asset('assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.min.css') }}" rel="stylesheet">

        <!-- Waves Effect -->
        <link href="{{ asset('assets/plugin/waves/waves.min.css') }}" rel="stylesheet">

        <!-- Sweet Alert -->
        <link href="{{ asset('assets/plugin/sweet-alert/sweetalert.css') }}" rel="stylesheet">

        <!-- Percent Circle -->
        <link href="{{ asset('assets/plugin/percircle/css/percircle.css') }}" rel="stylesheet">

        <!-- Chartist Chart -->
        <link href="{{ asset('assets/plugin/chart/chartist/chartist.min.css') }}" rel="stylesheet">

        <!-- FullCalendar -->
        <link href="{{ asset('assets/plugin/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet">

        <link href="{{ asset('assets/plugin/fullcalendar/fullcalendar.print.css') }}" rel="stylesheet">

        	<!-- Data Tables -->
        <!-- Data Tables -->


        <!-- RTL -->
        <link href="{{ asset('assets/styles/style-rtl.min.css') }}" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.14.0/sweetalert2.all.min.js" integrity="sha512-LXVbtSLdKM9Rpog8WtfAbD3Wks1NSDE7tMwOW3XbQTPQnaTrpIot0rzzekOslA1DVbXSVzS7c/lWZHRGkn3Xpg==" crossorigin="anonymous"></script>

    </head>
<body>
    @include('sweetalert::alert')

    <div class="main-menu">
        <header class="header">
            <a href="{{route('home')}}" class="logo">مصرف الأندلس</a>
            <button type="button" class="button-close fa fa-times js__menu_close"></button>
            <div class="user">
                @if(Auth::user()->image==null)
                <a href="#" class="avatar"><img src="http://placehold.it/80x80" alt=""><span class="status online"></span></a>

                @else
                <a href="#" class="avatar">  <img src="{{asset('public/images/users/files_'.Auth::user()->username)}}/{{ Auth::user()->image }}" alt=""  style="width: 70px;height:70px"><span class="status online"></span></a>
                @endif
                <h5 class="name"><a href="{{route('home')}}">
                    {{ Auth::user()->username }}
                </a></h5>
                <h5 class="position">{{ Auth::user()->email}}</h5>
                <!-- /.name -->
                <div class="control-wrap js__drop_down">
                    <i class="fa fa-caret-down js__drop_down_button"></i>
                    <div class="control-list">
                        <div class="control-item"><a href={{ route('users/profile',encrypt(Auth::user()->id)) }}><i class="fa fa-user"></i> الملف الشخصي</a></div>
                        <div class="control-item"><a href="{{route('change-password')}}"><i class="fa fa-gear"></i> تغير كلمةالمرور</a></div>
                    <!-- /.control-list -->
                </div>
                <!-- /.control-wrap -->
            </div>
            <!-- /.user -->
        </header>
        <!-- /.header -->
        <div class="content mCustomScrollbar _mCS_1 mCS-dir-rtl"><div id="mCSB_1" class="mCustomScrollBox mCS-light mCSB_vertical mCSB_inside" style="max-height: none;" tabindex="0"><div id="mCSB_1_container" class="mCSB_container" style="position:relative; top:0; left:0;" dir="rtl">
    
            <div class="navigation">
                {{-- <h5 class="title"></h5> --}}
                <!-- /.title -->
                <ul class="menu js__accordion">
                    <li class="{{ Request::is('/') ? 'current' : '' }} ">
                        <a class="waves-effect" href="{{ route('home') }}"><i class="menu-icon fa fa-home"></i><span>الرئسية</span></a>
                    </li>
                    @canany(['user-list', 'user-create' ,'user-edit','user-delete','user-changestatus'])

                    
                    <li class="{{ Request::is('users*') ? 'current' : '' }} ">
                        <a class="waves-effect " href="{{ route('users') }}"><i class="menu-icon fa fa-users"></i><span>إدارة المستخدمين</span></a>
                    </li>
                    @endcanany
                    @canany(['role-list', 'role-create' ,'role-edit','role-delete'])
                    <li class="{{ Request::is('roles*') ? 'current' : '' }} ">
                        <a class="waves-effect" href="{{ route('roles') }}"><i class="menu-icon fa  fa-key"></i><span>إدارة الصلاحيات</span></a>
                    </li>
                    @endcanany
                    @canany(['branche-list', 'branche-create' ,'branche-edit','branche-delete'])
                    <li class="{{ Request::is('branches*') ? 'current' : '' }} ">
                        <a class="waves-effect" href="{{ route('branches') }}"><i class="menu-icon fa fa-building"></i><span>إدارة الفرع</span></a>
                    </li>
                    @endcanany
                   
                   
                    @canany(['sms-messages','send-sms-messages','bulk-send-sms-messages'])
                    <li class="{{ Request::is('sms_messages') ? 'current' : '' }} ">
                        <a class="waves-effect" href="{{ route('sms_messages') }}"><i class="menu-icon  fa fa-comment-o"></i><span>إدارة الرسائل  </span></a>
                    </li>
                   @endcanany
                
                   <li class="{{ Request::is('transaction_o_b_d_x_e_s*') ? 'current' : '' }} ">
                    <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon  fa fa-list-ul"></i><span>Transaction OBDX </span>
                    </span></a>
              
                    <ul class="sub-menu js__content" style="background-color: white;">
                        <li>
                                <a class="waves-effect" href="{{ route('transaction_o_b_d_x_e_s') }}">Transaction OBDX  عرض كافة  </span></a>
                            </a>
                        </li>
                        <li>
                                <a class="waves-effect" href="{{ route('transaction_o_b_d_x_e_s/report/branche') }}">Transaction OBDX Report Branche</span></a>
                            </a>
                        </li>
                    
                        <li>
                            <a class="waves-effect" href="{{ route('transaction_o_b_d_x_e_s/report') }}">Transaction OBDX  Report </span></a>
                             </a>
                        </li>
                        <li>
                            <a class="waves-effect" href="{{ route('transaction_o_b_d_x_coms') }}">Transaction OBDX Company عرض كافة  </span></a>
                        </a>
                    </li>
                    <li>
                            <a class="waves-effect" href="{{ route('transaction_o_b_d_x_coms/report/branche') }}">Transaction OBDX Company Report Branche</span></a>
                        </a>
                    </li>
                
                    <li>
                        <a class="waves-effect" href="{{ route('transaction_o_b_d_x_coms/report') }}">Transaction OBDX Company Report </span></a>
                         </a>
                    </li>
                    </ul>
                </li>
                
                <li class="{{ Request::is('transaction_p_o_s*') ? 'current' : '' }} ">
                    <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon  fa fa-building"></i><span>Transaction POS </span>
                    </span></a>
              
                    <ul class="sub-menu js__content" style="background-color: white;">
                        <li>
                                <a class="waves-effect" href="{{ route('transaction_p_o_s') }}">Transaction POS  عرض كافة  </span></a>
                            </a>
                        </li>
                        <li>
                                <a class="waves-effect" href="{{ route('transaction_p_o_s/report/branche') }}">Transaction POS Report Branche</span></a>
                            </a>
                        </li>
                    
                        <li>
                            <a class="waves-effect" href="{{ route('transaction_p_o_s/report') }}">Transaction POS Report </span></a>
                        </a>
                    </li>
                 
                    </ul>
                </li>


                      
                <li class="{{ Request::is('transaction_w_u_s*') || Request::is('transaction_incom_w_u_s*') ? 'current' : '' }}">
                    <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon  glyphicon glyphicon-modal-window"></i><span>Transaction WU </span>
                    </span></a>
              
                    <ul class="sub-menu js__content" style="background-color: white;">
                        <li>
                                <a class="waves-effect" href="{{ route('transaction_w_u_s') }}">Transaction  Outgoing WU   عرض كافة  </span></a>
                            </a>
                        </li>
                        <li>
                                <a class="waves-effect" href="{{ route('transaction_w_u_s/report/branche') }}">Transaction  Outgoing WU Report Branche</span></a>
                            </a>
                        </li>
                    
                        <li>
                            <a class="waves-effect" href="{{ route('transaction_w_u_s/report') }}">Transaction Outgoing WU Report </span></a>
                            </a>
                        </li>
                 
                        <li>
                            <a class="waves-effect" href="{{ route('transaction_incom_w_u_s') }}">Transaction  Incom WU   عرض كافة  </span></a>
                        </a>
                        </li>
                        <li>
                                <a class="waves-effect" href="{{ route('transaction_incom_w_u_s/report/branche') }}">Transaction  Incom WU Report Branche</span></a>
                            </a>
                        </li>
                    
                        <li>
                            <a class="waves-effect" href="{{ route('transaction_incom_w_u_s/report') }}">Transaction Incom WU Report </span></a>
                            </a>
                        </li>
                        
                    </ul>
                </li>

                <li class="{{ Request::is('transaction_card_issuing_fees*') || Request::is('transaction_incom_card_fees*') ? 'current' : '' }}">

                        <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon glyphicon glyphicon-credit-card"></i><span>Transaction Card  </span>
                        </span></a>
                
                        <ul class="sub-menu js__content" style="background-color: white;">
                            
                            <li>
                                    <a class="waves-effect" href="{{ route('transaction_card_issuing_fees') }}">Transaction Card Issuing Fees  عرض كافة  </span></a>
                                </a>
                            </li>
                            <li>
                                    <a class="waves-effect" href="{{ route('transaction_card_issuing_fees/report/branche') }}">Transaction Card Issuing Fees Report Branche</span></a>
                                </a>
                            </li>
                        
                            <li>
                                <a class="waves-effect" href="{{ route('transaction_card_issuing_fees/report') }}">Transaction  Card Issuing Fees Report </span></a>
                                </a>
                            </li>
                            <li>
                                <a class="waves-effect" href="{{ route('transaction_incom_card_fees') }}">Transaction Income Card Fees  عرض كافة  </span></a>
                                </a>
                            </li>
                            <li>
                                    <a class="waves-effect" href="{{ route('transaction_incom_card_fees/report/branche') }}">Transaction Income Card  Fees Report Branche</span></a>
                                </a>
                            </li>
                        
                            <li>
                                <a class="waves-effect" href="{{ route('transaction_incom_card_fees/report') }}">Transaction Income Card Fees Report </span></a>
                                </a>
                            </li>
                            <li>
                                <a class="waves-effect" href="{{ route('transaction_card_re_issuing_fees') }}">Transaction Card ReIssuing Fees  عرض كافة  </span></a>
                            </a>
                        </li>
                        <li>
                                <a class="waves-effect" href="{{ route('transaction_card_re_issuing_fees/report/branche') }}">Transaction Card ReIssuing Fees Report Branche</span></a>
                            </a>
                        </li>
                    
                        <li>
                            <a class="waves-effect" href="{{ route('transaction_card_re_issuing_fees/report') }}">Transaction  Card ReIssuing Fees Report </span></a>
                            </a>
                        </li>
                            
                        </ul>
                </li>


                <li class="{{ Request::is('transaction_re_issuing_pin_fees*') ? 'current' : '' }} ">
                    <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-cc-mastercard"></i><span>Transaction ReIssuing Pin Fees </span>
                    </span></a>
              
                    <ul class="sub-menu js__content" style="background-color: white;">
                        <li>
                                <a class="waves-effect" href="{{ route('transaction_re_issuing_pin_fees') }}">Transaction ReIssuing Pin Fees  عرض كافة  </span></a>
                            </a>
                        </li>
                        <li>
                                <a class="waves-effect" href="{{ route('transaction_re_issuing_pin_fees/report/branche') }}">Transaction ReIssuing Pin Fees Report Branche</span></a>
                            </a>
                        </li>
                    
                        <li>
                            <a class="waves-effect" href="{{ route('transaction_re_issuing_pin_fees/report') }}">Transaction ReIssuing Pin Fees Report </span></a>
                        </a>
                    </li>
                 
                    </ul>
                </li>
                <li class="{{ Request::is('transaction_s_m_s*') ? 'current' : '' }} ">
                    <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-newspaper-o"></i><span>Transaction SMS </span>
                    </span></a>
              
                    <ul class="sub-menu js__content" style="background-color: white;">
                        <li>
                                <a class="waves-effect" href="{{ route('transaction_s_m_s') }}">Transaction SMS  عرض كافة  </span></a>
                            </a>
                        </li>
                        <li>
                                <a class="waves-effect" href="{{ route('transaction_s_m_s/report/branche') }}">Transaction SMS Branche</span></a>
                            </a>
                        </li>
                    
                        <li>
                            <a class="waves-effect" href="{{ route('transaction_s_m_s/report') }}">Transaction SMS Report </span></a>
                              </a>
                         </li>
                 
                         <li>
                            <a class="waves-effect" href="{{ route('transaction_s_m_s_c_o_m_s') }}">Transaction Company SMS  عرض كافة  </span></a>
                        </a>
                    </li>
                    <li>
                            <a class="waves-effect" href="{{ route('transaction_s_m_s_c_o_m_s/report/branche') }}">Transaction  Company SMS Branche</span></a>
                        </a>
                    </li>
                
                    <li>
                        <a class="waves-effect" href="{{ route('transaction_s_m_s_c_o_m_s/report') }}">Transaction  Company SMS Report </span></a>
                          </a>
                     </li>
                    </ul>
                </li>


                 <li class="{{ Request::is('transaction_a_t_m_s*') ? 'current' : '' }} ">
                    <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-reorder"></i><span>Transaction ATM </span>
                    </span></a>
              
                    <ul class="sub-menu js__content" style="background-color: white;">
                        <li>
                                <a class="waves-effect" href="{{ route('transaction_a_t_m_s') }}">Transaction ATM  عرض كافة  </span></a>
                            </a>
                        </li>
                        <li>
                                <a class="waves-effect" href="{{ route('transaction_a_t_m_s/report/branche') }}">Transaction ATM Report Branche</span></a>
                            </a>
                        </li>
                    
                        <li>
                            <a class="waves-effect" href="{{ route('transaction_a_t_m_s/report') }}">Transaction ATM Report </span></a>
                        </a>
                    </li>
                 
                    </ul>
                </li>


                
                <li class="{{ Request::is('transaction_a_t_m_o_f_f_u_s_fees*') ? 'current' : '' }} ">
                    <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-reorder"></i><span>Transaction ATM  OFF-US</span>
                    </span></a>
              
                    <ul class="sub-menu js__content" style="background-color: white;">
                        <li>
                                <a class="waves-effect" href="{{ route('transaction_a_t_m_o_f_f_u_s_fees') }}">Transaction ATM  OFF-US  عرض كافة  </span></a>
                            </a>
                        </li>
                        <li>
                                <a class="waves-effect" href="{{ route('transaction_a_t_m_o_f_f_u_s_fees/report/branche') }}">Transaction ATM  OFF-US Report Branche</span></a>
                            </a>
                        </li>
                    
                        <li>
                            <a class="waves-effect" href="{{ route('transaction_a_t_m_o_f_f_u_s_fees/report') }}">Transaction ATM  OFF-US Report </span></a>
                        </a>
                    </li>
                 
                    </ul>
                </li>
                <li class="{{ Request::is('transaction_master_card_issuing_fees*') || Request::is('transaction_master_card_charging_fees*') ||  Request::is('transaction_master_card_mangment_fees*')  ? 'current' : '' }}">

                    <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-cc-mastercard"></i><span>Transaction MasterCard </span>
                    </span></a>
              
                    <ul class="sub-menu js__content" style="background-color: white;">
                     
                        <li>
                            <a class="waves-effect" href="{{ route('transaction_master_card_issuing_fees') }}">Transaction MasterCard Issuing Fees  عرض كافة  </span></a>
                        </a>
                         </li>
                    <li>
                            <a class="waves-effect" href="{{ route('transaction_master_card_issuing_fees/report/branche') }}">Transaction MasterCard Issuing Fees Report Branche</span></a>
                        </a>
                    </li>
                
                    <li>
                        <a class="waves-effect" href="{{ route('transaction_master_card_issuing_fees/report') }}">Transaction  MasterCard Issuing Fees Report </span></a>
                        </a>
                    </li>



                    <li>
                        <a class="waves-effect" href="{{ route('transaction_master_card_charging_fees') }}">Transaction MasterCard Charging Fees  عرض كافة  </span></a>
                    </a>
                     </li>
                <li>
                        <a class="waves-effect" href="{{ route('transaction_master_card_charging_fees/report/branche') }}">Transaction MasterCard Charging Fees Report Branche</span></a>
                    </a>
                </li>
            
                <li>
                    <a class="waves-effect" href="{{ route('transaction_master_card_charging_fees/report') }}">Transaction  MasterCard Charging Fees Report </span></a>
                    </a>
                </li>




                <li>
                    <a class="waves-effect" href="{{ route('transaction_master_card_mangment_fees') }}">Transaction MasterCard Mangment Fees  عرض كافة  </span></a>
                </a>
                 </li>
            <li>
                    <a class="waves-effect" href="{{ route('transaction_master_card_mangment_fees/report/branche') }}">Transaction MasterCard Mangment Fees Report Branche</span></a>
                </a>
            </li>
        
            <li>
                <a class="waves-effect" href="{{ route('transaction_master_card_mangment_fees/report') }}">Transaction  MasterCard Mangment Fees Report </span></a>
                </a>
            </li>
                    </ul>
                </li>
                <li class="{{ Request::is('transaction_master_a_t_m_s*') ? 'current' : '' }} ">
                    <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-reorder"></i><span>Transaction Master ATM </span>
                    </span></a>
              
                    <ul class="sub-menu js__content" style="background-color: white;">
                        <li>
                                <a class="waves-effect" href="{{ route('transaction_master_a_t_m_s') }}">Transaction Master ATM  عرض كافة  </span></a>
                            </a>
                        </li>
                        <li>
                                <a class="waves-effect" href="{{ route('transaction_master_a_t_m_s/report/branche') }}">Transaction Master ATM Report Branche</span></a>
                            </a>
                        </li>
                    
                        <li>
                            <a class="waves-effect" href="{{ route('transaction_master_a_t_m_s/report') }}">Transaction Master ATM Report </span></a>
                        </a>
                    </li>
                 
                    </ul>
                </li>
                <li class="{{ Request::is('transaction_master_card_coin_purchase_request_commissions*') ? 'current' : '' }} ">
                    <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-cc-mastercard"></i><span>Transaction MasterCard Coin Purchase Request Commission </span>
                    </span></a>
              
                    <ul class="sub-menu js__content" style="background-color: white;">
                        <li>
                                <a class="waves-effect" href="{{ route('transaction_master_card_coin_purchase_request_commissions') }}">Transaction MasterCard Coin Purchase Request Commission  عرض كافة  </span></a>
                            </a>
                        </li>
                        <li>
                                <a class="waves-effect" href="{{ route('transaction_master_card_coin_purchase_request_commissions/report/branche') }}">Transaction MasterCard Coin Purchase Request Commission Report Branche</span></a>
                            </a>
                        </li>
                    
                        <li>
                            <a class="waves-effect" href="{{ route('transaction_master_card_coin_purchase_request_commissions/report') }}">Transaction MasterCard Coin Purchase Request Commission Report </span></a>
                        </a>
                    </li>
                 
                    </ul>
                </li>
                <li class="{{ Request::is('transaction_markup_fees*') ? 'current' : '' }} ">
                    <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-reorder"></i><span>Transaction MarkUp</span>
                    </span></a>
              
                    <ul class="sub-menu js__content" style="background-color: white;">
                        <li>
                                <a class="waves-effect" href="{{ route('transaction_markup_fees') }}">Transaction MarkUp عرض كافة  </span></a>
                            </a>
                        </li>
                        <li>
                                <a class="waves-effect" href="{{ route('transaction_markup_fees/report/branche') }}">Transaction MarkUp Report Branche</span></a>
                            </a>
                        </li>
                    
                        <li>
                            <a class="waves-effect" href="{{ route('transaction_markup_fees/report') }}">Transaction MarkUp Report </span></a>
                        </a>
                    </li>
                 
                    </ul>
                </li>
                <li class="{{ Request::is('transaction_matser_point_o_f_sale_purchase_commissions*') ? 'current' : '' }} ">
                    <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-reorder"></i><span>Transaction Matser Point OF Sale Purchase Commission</span>
                    </span></a>
              
                    <ul class="sub-menu js__content" style="background-color: white;">
                        <li>
                                <a class="waves-effect" href="{{ route('transaction_matser_point_o_f_sale_purchase_commissions') }}">Transaction Matser Point OF Sale Purchase Commission عرض كافة  </span></a>
                            </a>
                        </li>
                        <li>
                                <a class="waves-effect" href="{{ route('transaction_matser_point_o_f_sale_purchase_commissions/report/branche') }}">Transaction Matser Point OF Sale Purchase Commission Report Branche</span></a>
                            </a>
                        </li>
                    
                        <li>
                            <a class="waves-effect" href="{{ route('transaction_matser_point_o_f_sale_purchase_commissions/report') }}">Transaction Matser Point OF Sale Purchase Commission Report </span></a>
                        </a>
                    </li>
                 
                    </ul>
                </li>
                @can('laravel-logger')
                <li class="{{ Request::is('logger/activity') ? 'current' : '' }} ">
                    <a class="waves-effect" href="{{ route('logger/activity') }}"><i class="menu-icon  fa fa-eye"></i><span>مراقبة النظام</span></a>
                </li>
                @endcan
                <li class="{{ Request::is('a_t_m_file_uploads') ? 'current' : '' }} ">
                    <a class="waves-effect" href="{{ route('a_t_m_file_uploads') }}"><i class="menu-icon  fa fa-eye"></i><span> ATM UPLODE FILE</span></a>
                </li>
                </ul>
               
               
                <!-- /.menu js__accordion -->
            </div>
            <!-- /.navigation -->
        </div><div id="mCSB_1_scrollbar_vertical" class="mCSB_scrollTools mCSB_1_scrollbar mCS-light mCSB_scrollTools_vertical" style="display: block;"><div class="mCSB_draggerContainer"><div id="mCSB_1_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; display: block; height: 37px; max-height: 157px; top: 0px;"><div class="mCSB_dragger_bar" style="line-height: 30px;"></div></div><div class="mCSB_draggerRail"></div></div></div></div></div>
        <!-- /.content -->
    </div>
    <!-- /.main-menu -->
    
    <div class="fixed-navbar">
        <div class="pull-left">
            <button type="button" class="menu-mobile-button glyphicon glyphicon-menu-hamburger js__menu_mobile"></button>
            <h1 class="page-title">ANDA BI Report  / @yield('title')</h1>
            <!-- /.page-title -->
        </div>
        <!-- /.pull-left -->
        <div class="pull-right">
            
            <div class="ico-item fa fa-arrows-alt js__full_screen"></div>
            <!-- /.ico-item fa fa-fa-arrows-alt -->
           
            {{-- <a href="#" class="ico-item fa fa-envelope notice-alarm js__toggle_open" data-target="#message-popup"></a> --}}
            {{-- <a href="#" class="ico-item pulse"><span class="ico-item fa fa-bell notice-alarm js__toggle_open" data-target="#notification-popup"></span></a> --}}
            {{-- <a  class="ico-item fa fa-power-off js__logout" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
         </a> --}}
         <a  class="ico-item fa fa-power-off js__logout" >
        </a>
         {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
             @csrf
         </form> --}}
        </div>
        <!-- /.pull-right -->
    </div>
    <!-- /.fixed-navbar -->
    
    {{-- <div id="notification-popup" class="notice-popup js__toggle" data-space="75" style="height: 277px;">
        <h2 class="popup-title">Your Notifications</h2>
        <!-- /.popup-title -->
        <div class="content mCustomScrollbar _mCS_2 mCS-dir-rtl"><div id="mCSB_2" class="mCustomScrollBox mCS-light mCSB_vertical mCSB_inside" tabindex="0" style="max-height: none;"><div id="mCSB_2_container" class="mCSB_container" style="position:relative; top:0; left:0;" dir="rtl">
            <ul class="notice-list">
                <li>
                    <a href="#">
                        <span class="avatar"><img src="http://placehold.it/80x80" alt="" class="mCS_img_loaded"></span>
                        <span class="name">John Doe</span>
                        <span class="desc">Like your post: “Contact Form 7 Multi-Step”</span>
                        <span class="time">10 min</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="avatar"><img src="http://placehold.it/80x80" alt="" class="mCS_img_loaded"></span>
                        <span class="name">Anna William</span>
                        <span class="desc">Like your post: “Facebook Messenger”</span>
                        <span class="time">15 min</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="avatar bg-warning"><i class="fa fa-warning"></i></span>
                        <span class="name">Update Status</span>
                        <span class="desc">Failed to get available update data. To ensure the please contact us.</span>
                        <span class="time">30 min</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="avatar"><img src="http://placehold.it/128x128" alt="" class="mCS_img_loaded"></span>
                        <span class="name">Jennifer</span>
                        <span class="desc">Like your post: “Contact Form 7 Multi-Step”</span>
                        <span class="time">45 min</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="avatar"><img src="http://placehold.it/80x80" alt="" class="mCS_img_loaded"></span>
                        <span class="name">Michael Zenaty</span>
                        <span class="desc">Like your post: “Contact Form 7 Multi-Step”</span>
                        <span class="time">50 min</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="avatar"><img src="http://placehold.it/80x80" alt="" class="mCS_img_loaded"></span>
                        <span class="name">Simon</span>
                        <span class="desc">Like your post: “Facebook Messenger”</span>
                        <span class="time">1 hour</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="avatar bg-violet"><i class="fa fa-flag"></i></span>
                        <span class="name">Account Contact Change</span>
                        <span class="desc">A contact detail associated with your account has been changed.</span>
                        <span class="time">2 hours</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="avatar"><img src="http://placehold.it/80x80" alt="" class="mCS_img_loaded"></span>
                        <span class="name">Helen 987</span>
                        <span class="desc">Like your post: “Facebook Messenger”</span>
                        <span class="time">Yesterday</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="avatar"><img src="http://placehold.it/128x128" alt="" class="mCS_img_loaded"></span>
                        <span class="name">Denise Jenny</span>
                        <span class="desc">Like your post: “Contact Form 7 Multi-Step”</span>
                        <span class="time">Oct, 28</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="avatar"><img src="http://placehold.it/80x80" alt="" class="mCS_img_loaded"></span>
                        <span class="name">Thomas William</span>
                        <span class="desc">Like your post: “Facebook Messenger”</span>
                        <span class="time">Oct, 27</span>
                    </a>
                </li>
            </ul>
            <!-- /.notice-list -->
            <a href="#" class="notice-read-more">See more messages <i class="fa fa-angle-down"></i></a>
        </div><div id="mCSB_2_scrollbar_vertical" class="mCSB_scrollTools mCSB_2_scrollbar mCS-light mCSB_scrollTools_vertical" style="display: block;"><div class="mCSB_draggerContainer"><div id="mCSB_2_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; display: block; height: 64px; max-height: 217px; top: 0px;"><div class="mCSB_dragger_bar" style="line-height: 30px;"></div></div><div class="mCSB_draggerRail"></div></div></div></div></div>
        <!-- /.content -->
    </div> --}}
    <!-- /#notification-popup -->
    
    {{-- <div id="message-popup" class="notice-popup js__toggle" data-space="75" style="height: 277px;">
        <h2 class="popup-title">Recent Messages<a href="#" class="pull-left text-danger">New message</a></h2>
        <!-- /.popup-title -->
        <div class="content mCustomScrollbar _mCS_3 mCS-dir-rtl"><div id="mCSB_3" class="mCustomScrollBox mCS-light mCSB_vertical mCSB_inside" tabindex="0" style="max-height: none;"><div id="mCSB_3_container" class="mCSB_container" style="position:relative; top:0; left:0;" dir="rtl">
            <ul class="notice-list">
                <li>
                    <a href="#">
                        <span class="avatar"><img src="http://placehold.it/80x80" alt="" class="mCS_img_loaded"></span>
                        <span class="name">John Doe</span>
                        <span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
                        <span class="time">10 min</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="avatar"><img src="http://placehold.it/80x80" alt="" class="mCS_img_loaded"></span>
                        <span class="name">Harry Halen</span>
                        <span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
                        <span class="time">15 min</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="avatar"><img src="http://placehold.it/80x80" alt="" class="mCS_img_loaded"></span>
                        <span class="name">Thomas Taylor</span>
                        <span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
                        <span class="time">30 min</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="avatar"><img src="http://placehold.it/128x128" alt="" class="mCS_img_loaded"></span>
                        <span class="name">Jennifer</span>
                        <span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
                        <span class="time">45 min</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="avatar"><img src="http://placehold.it/80x80" alt="" class="mCS_img_loaded"></span>
                        <span class="name">Helen Candy</span>
                        <span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
                        <span class="time">45 min</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="avatar"><img src="http://placehold.it/128x128" alt="" class="mCS_img_loaded"></span>
                        <span class="name">Anna Cavan</span>
                        <span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
                        <span class="time">1 hour ago</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="avatar bg-success"><i class="fa fa-user"></i></span>
                        <span class="name">Jenny Betty</span>
                        <span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
                        <span class="time">1 day ago</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="avatar"><img src="http://placehold.it/128x128" alt="" class="mCS_img_loaded"></span>
                        <span class="name">Denise Peterson</span>
                        <span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
                        <span class="time">1 year ago</span>
                    </a>
                </li>
            </ul>
            <!-- /.notice-list -->
            <a href="#" class="notice-read-more">See more messages <i class="fa fa-angle-down"></i></a>
        </div><div id="mCSB_3_scrollbar_vertical" class="mCSB_scrollTools mCSB_3_scrollbar mCS-light mCSB_scrollTools_vertical" style="display: block;"><div class="mCSB_draggerContainer"><div id="mCSB_3_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; height: 78px; top: 0px; display: block; max-height: 217px;"><div class="mCSB_dragger_bar" style="line-height: 30px;"></div></div><div class="mCSB_draggerRail"></div></div></div></div></div>
        <!-- /.content -->
    </div> --}}
    <!-- /#message-popup -->
  
    
    <div id="wrapper">
        <div class="main-content">
            @yield('content')

            <!-- /.row -->		
            <footer class="footer">
                <ul class="list-inline">
                    <li>2024  © مصرف الأندلس.</li>
                    {{-- <li><a href="#">Privacy</a></li>
                    <li><a href="#">Terms</a></li>
                    <li><a href="#">Help</a></li> --}}
                </ul>
            </footer>
        </div>
        <!-- /.main-content -->
    </div><!--/#wrapper -->
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="assets/script/html5shiv.min.js"></script>
            <script src="assets/script/respond.min.js"></script>
        <![endif]-->
        <!-- 
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

        <script src="{{ asset('assets/scripts/jquery.min.js') }}" ></script>
        <script src="{{ asset('assets/scripts/modernizr.min.js') }}" ></script>
         <script src="{{ asset('assets/plugin/bootstrap/js/bootstrap.min.js') }}" ></script>
         <script src="{{ asset('assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js') }}" ></script>
         <script src="{{ asset('assets/plugin/nprogress/nprogress.js') }}" ></script>
         <script src="{{ asset('assets/plugin/sweet-alert/sweetalert.min.js') }}" ></script>

         <script src="{{ asset('assets/plugin/waves/waves.min.js') }}" ></script>

        <!-- Full Screen Plugin -->
        <script src="{{ asset('assets/plugin/fullscreen/jquery.fullscreen-min.js') }}" ></script>


        <!-- Data Tables -->
        <script src="{{asset('assets/plugin/datatables/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('assets/plugin/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{asset('assets/plugin/datatables/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('assets/plugin/datatables/js/buttons.flash.min.js')}}"></script>
        <script src="{{asset('assets/plugin/datatables/js/jszip.min.js')}}"></script>
        <script src="{{asset('assets/plugin/datatables/js/pdfmake.min.js')}}"></script>
        <script src="{{asset('assets/plugin/datatables/js/vfs_fonts.js')}}"></script>
        <script src="{{asset('assets/plugin/datatables/js/buttons.html5.min.js')}}"></script>
        <script src="{{asset('assets/plugin/datatables/js/buttons.print.min.js')}}"></script>
        <!-- Percent Circle -->
        <script src="{{ asset('assets/plugin/percircle/js/percircle.js') }}" ></script>



        <!-- FullCalendar -->
        <script src="{{ asset('assets/plugin/moment/moment.js') }}" ></script>
        <script src="{{ asset('assets/plugin/fullcalendar/fullcalendar.min.js') }}" ></script>
        <script src="{{ asset('assets/scripts/fullcalendar.init.js') }}" ></script>
        <script src="{{ asset('assets/scripts/main.min.js') }}" ></script>


    </body>
</html>