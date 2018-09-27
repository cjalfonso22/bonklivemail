
{{-- Left Content --}}
<div class="body-left d-none d-md-none d-lg-block d-xl-block">
    <div class="sidenav">
        <ul class="list-group">
            <li class="text-center username">
                <div class="circle"></div>
                {{ Auth::user()->name }}
            </li>
            <li class="list-group-item {{ request()->is('dashboard') ? 'active' : '' }}">
                <a href="/dashboard">
                    <div class="icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <div class="link">
                        Dashboard
                    </div>
                </a>
                <div class="arrow d-none {{ request()->is('dashboard') ? 'd-md-none d-lg-block d-xl-block' : '' }}"></div>
            </li>
            <li class="list-group-item {{ request()->is('lists') ? 'active' : '' }} {{ request()->is('contacts') ? 'active' : '' }} {{ request()->is('contacts/import') ? 'active' : '' }} {{ request()->is('contacts/add') ? 'active' : '' }} {{ request()->is('contacts/create') ? 'active' : '' }}">
                <a href="/contacts">
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="link">
                        Lists
                    </div>
                </a>
                <div class="arrow d-none {{ request()->is('lists') ? 'd-md-none d-lg-block d-xl-block' : '' }} {{ request()->is('contacts') ? 'd-md-none d-lg-block d-xl-block' : '' }} {{ request()->is('contacts/import') ? 'd-md-none d-lg-block d-xl-block' : '' }} {{ request()->is('contacts/add') ? 'd-md-none d-lg-block d-xl-block' : '' }} {{ request()->is('contacts/create') ? 'd-md-none d-lg-block d-xl-block' : '' }}"></div>
            </li>
            <li class="list-group-item {{ request()->is('campaigns') ? 'active' : '' }} {{ request()->is('campaigns/create') ? 'active' : '' }} {{ request()->is('templates') ? 'active' : '' }} {{ request()->is('campaigns/list') ? 'active' : '' }} {{ request()->is('templates/create') ? 'active' : '' }} {{ request()->is('templates/1') ? 'active' : '' }} {{ request()->is('templates/2') ? 'active' : '' }} {{ request()->is('campaigns/1/edit') ? 'active' : '' }} {{ request()->is('campaigns/2/edit') ? 'active' : '' }}">
                <a href="/campaigns">
                    <div class="icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="link">
                        Campaign
                    </div>
                </a>
                <div class="arrow d-none {{ request()->is('campaigns') ? 'd-md-none d-lg-block d-xl-block' : '' }} {{ request()->is('campaigns/create') ? 'd-md-none d-lg-block d-xl-block' : '' }} {{ request()->is('templates') ? 'd-md-none d-lg-block d-xl-block' : '' }} {{ request()->is('campaigns/list') ? 'd-md-none d-lg-block d-xl-block' : '' }} {{ request()->is('templates/create') ? 'd-md-none d-lg-block d-xl-block' : '' }} {{ request()->is('templates/1') ? 'd-md-none d-lg-block d-xl-block' : '' }} {{ request()->is('templates/2') ? 'd-md-none d-lg-block d-xl-block' : '' }} {{ request()->is('campaigns/1/edit') ? 'd-md-none d-lg-block d-xl-block' : '' }} {{ request()->is('campaigns/2/edit') ? 'd-md-none d-lg-block d-xl-block' : '' }}"></div>
            </li>
            <li class="list-group-item {{ request()->is('statistics') ? 'active' : '' }}">
                <a href="/statistics">
                    <div class="icon stat">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="link">
                        Statistics
                    </div>
                </a>
                <div class="arrow d-none {{ request()->is('statistics') ? 'd-md-none d-lg-block d-xl-block' : '' }}"></div>
            </li>
            <li class="list-group-item {{ request()->is('help') ? 'active' : '' }}">
                <a href="/help">
                    <div class="icon help">
                        <i class="fas fa-question"></i>
                    </div>
                    <div class="link">
                            Help
                    </div>
                </a>
                <div class="arrow d-none {{ request()->is('help') ? 'd-md-none d-lg-block d-xl-block' : '' }}"></div>
            </li>
            @guest
                <li class="list-group-item"><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                <li class="list-group-item"><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
            @else
                <li class="list-group-item bot-logout">
                    <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        <div class="icon logout">
                            <i class="fas fa-sign-out-alt"></i>
                        </div>
                        <div class="link">
                            {{ __('Logout') }}
                        </div>
                    </a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                </form>
            @endguest
        </ul>
    </div>
</div>