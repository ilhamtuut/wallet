<ul class="x-navigation x-navigation-horizontal">
    <li class="xn-navigation-control">
        <a href="#" class="x-navigation-control"></a>
    </li>
    @guest
        <li class="{{ isset($page) && $page == 'home' ? 'active' : '' }}">
            <a href="{{route('home')}}"><span class="fa fa-home"></span> <span class="xn-text">Home</span></a>
        </li>
        <li class="{{ isset($page) && $page == 'api' ? 'active' : '' }}">
            <a href="{{route('api.index')}}"><span class="fa fa-cogs"></span> <span class="xn-text">API</span></a>
        </li>
        <li class="">
            <a href="{{route('login')}}"><span class="fa fa-sign-in"></span> <span class="xn-text">Login</span></a>
        </li>
        <li class="">
            <a href="{{route('register')}}"><span class="fa fa-pencil-square-o"></span> <span class="xn-text">Register</span></a>
        </li>
    @else
        <li class="{{ isset($page) && $page == 'home' ? 'active' : '' }}">
            <a href="{{route('home')}}"><span class="fa fa-globe"></span> <span class="xn-text">GLP Explorer</span></a>
        </li>
        @role('member')
            <li class="{{ isset($page) && $page == 'my_wallet' ? 'active' : '' }}">
                <a href="{{route('wallet.index')}}"><span class="fa fa-credit-card"></span> <span class="xn-text">My Wallet</span></a>
            </li>
            <li class="{{ isset($page) && $page == 'transactions' ? 'active' : '' }}">
                <a href="{{route('wallet.transaction')}}"><span class="fa fa-tasks"></span> <span class="xn-text">Transaction</span></a>
            </li>
            <li class="{{ isset($page) && $page == 'send' ? 'active' : '' }}">
                <a href="{{route('wallet.send')}}"><span class="fa fa-arrow-circle-up"></span> <span class="xn-text">Send</span></a>
            </li>                    
            <li class="{{ isset($page) && $page == 'receive' ? 'active' : '' }}">
                <a href="{{route('wallet.receive')}}"><span class="fa fa-arrow-circle-down"></span> <span class="xn-text">Receive</span></a>
            </li>
        @endrole

        @role(['developer','administrator'])
            <li class="{{ isset($page) && $page == 'users' ? 'active' : '' }}">
                <a href="{{route('administrator.users.list')}}"><span class="fa fa-users"></span> <span class="xn-text">Users</span></a>
            </li>
            <li class="{{ isset($page) && $page == 'settings' ? 'active' : '' }}">
                <a href="{{route('administrator.settings.index')}}"><span class="fa fa-cog"></span> <span class="xn-text">Settings</span></a>
            </li>
            <li class="{{ isset($page) && $page == 'wallet' ? 'active' : '' }}">
                <a href="{{route('administrator.wallet.list')}}"><span class="fa fa-credit-card"></span> <span class="xn-text">Wallet</span></a>
            </li>
            </li>
        @endrole

    @endguest

    @guest
        <li class="xn-search pull-right">
            <form role="form" id="form-search" action="{{route('explorer.search')}}">
                <input type="text" name="q" placeholder="Search..."/>
            </form>
        </li>
    @else
        <li class="xn-icon-button pull-right last">
            <a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span> Log Out</a>
        </li> 
        <li class="xn-search pull-right">
            <form role="form" id="form-search" action="{{route('explorer.search')}}">
                <input type="text" name="q" placeholder="Search..."/>
            </form>
        </li>
    @endguest
</ul>