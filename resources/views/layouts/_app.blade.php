<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.partials.header')
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
                            <a href="#"><span class="fa fa-facebook-square"></span></a>
                            <a href="#"><span class="fa fa-twitter-square"></span></a>
                            <a href="#"><span class="fa fa-instagram"></span></a>
                        </div>
                        <div class="contacts">
                            <a href="#">Copyright © {{date('Y')}} Grenline Project. All rights reserved. </a>
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
                            <a class="btn btn-success btn-lg" href="{{ route('logout') }}"
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