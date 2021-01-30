<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.partials.header')
    <style type="text/css">
        .svg-inline--fa{
            display: inline-block;
            font-size: inherit;
            height: 1em;
            overflow: visible;
            vertical-align: -0.125em;
        }
        .svg-inline--fa.fa-w-14{
            width: 19.72px;
        }
    </style>
    <body>
        <!-- START PAGE CONTAINER -->
        <div class="page-container page-navigation-top page-navigation-top-custom">            
            <!-- PAGE CONTENT -->
            <div class="page-content">
                
                <!-- START PAGE CONTENT HEADER -->
                <div class="page-content-header">
                    <a href="{{route('home')}}" class="logo"></a>
                    <div class="pull-right">                        
                        <div class="socials">
                            <a href="https://www.facebook.com/greenlineprojectcoin/" target="_blank"><span class="fa fa-facebook-square"></span></a>
                            <a href="https://twitter.com/coinglp" target="_blank"><span class="fa fa-twitter-square"></span></a>
                            <a href="https://www.instagram.com/CoinGLP/" target="_blank"><span class="fa fa-instagram"></span></a>
                            <a href="https://glpcoin.medium.com/" target="_blank"><span class="fa"><svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="medium" class="svg-inline--fa fa-medium fa-w-14 fa-2x" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M0 32v448h448V32H0zm372.2 106.1l-24 23c-2.1 1.6-3.1 4.2-2.7 6.7v169.3c-.4 2.6.6 5.2 2.7 6.7l23.5 23v5.1h-118V367l24.3-23.6c2.4-2.4 2.4-3.1 2.4-6.7V199.8l-67.6 171.6h-9.1L125 199.8v115c-.7 4.8 1 9.7 4.4 13.2l31.6 38.3v5.1H71.2v-5.1l31.6-38.3c3.4-3.5 4.9-8.4 4.1-13.2v-133c.4-3.7-1-7.3-3.8-9.8L75 138.1V133h87.3l67.4 148L289 133.1h83.2v5z"></path></svg></span></a>
                            <a href="https://t.me/greenlineproject" target="_blank"><span class="fa"><svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="telegram" class="svg-inline--fa fa-telegram fa-w-14 fa-2x" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm121.8 169.9l-40.7 191.8c-3 13.6-11.1 16.9-22.4 10.5l-62-45.7-29.9 28.8c-3.3 3.3-6.1 6.1-12.5 6.1l4.4-63.1 114.9-103.8c5-4.4-1.1-6.9-7.7-2.5l-142 89.4-61.2-19.1c-13.3-4.2-13.6-13.3 2.8-19.7l239.1-92.2c11.1-4 20.8 2.7 17.2 19.5z"></path></svg></span></a>
                        </div>
                        <div class="contacts">
                            <a href="#">Copyright © {{date('Y')}} Greenline Project. All rights reserved.</a>
                        </div>
                    </div>
                </div>
                <!-- END PAGE CONTENT HEADER -->
                
                <!-- START X-NAVIGATION VERTICAL -->
                @include('layouts.partials.navigation')
                <!-- END X-NAVIGATION VERTICAL -->                     
                
                <!-- START BREADCRUMB -->
                @yield('breadcrumb')
                <!-- END BREADCRUMB -->                
                
                @yield('page-title')                  
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">                
                    @yield('content')
                </div>
                <!-- PAGE CONTENT WRAPPER -->                
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->

        <!-- MESSAGE BOX-->
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to log out?</p>                    
                        <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a class="btn btn-primary btn-lg" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                Yes
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->

        <div class="modal fade" id="modal_capctha" role="dialog" tabindex="-5"aria-hidden="true">
          <div class="modal-dialog modal-sm">
            <div class="modal-content" style="background-color: transparent; border: unset;">
                <div class="modal-body">
                    <div class="slidercaptcha panel panel">
                        <div class="panel-heading bg-primary">
                            <span class="panel-title"><span class="text-white">Drag To Verify</span></span>
                        </div>
                        <div class="panel-body"><div id="captcha"></div></div>
                    </div>
                </div>
            </div>
          </div>
        </div>

        <!-- START PRELOADS -->
        <audio id="audio-alert" src="{{asset('dist/audio/alert.mp3')}}" preload="auto"></audio>
        <audio id="audio-fail" src="{{asset('dist/audio/fail.mp3')}}" preload="auto"></audio>
        <!-- END PRELOADS -->                  
        
        <!-- START SCRIPTS -->
        @include('layouts.partials.script')
        @yield('script')
        <!-- END SCRIPTS -->         
    </body>
</html>