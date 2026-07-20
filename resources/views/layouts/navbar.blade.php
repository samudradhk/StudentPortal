<nav class="navbar navbar-expand-lg px-4 navbar-student">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        
        <a class="navbar-brand text-white mb-0" href="#">
            <span class="fw-bold">STUDENT</span><span class="brand-light">PORTAL</span>
        </a>

        <div class="d-flex align-items-center gap-4">
            
            <div class="d-flex align-items-center text-white gap-2">
                <div class="form-check form-switch m-0 d-flex align-items-center">
                    <input type="checkbox"
                        role="switch"
                        class="form-check-input mt-0 custom-switch"
                        id="languageSwitch"
                        {{ app()->getLocale() == 'en' ? 'checked': '' }}
                        onchange="window.location.href='{{ app()->getLocale() == 'en' ? route('language.switch', 'id') : route('language.switch', 'en') }}'"
                    />
                </div>
                <span class="text-center" style="font-size: 0.9rem; min-width: 50px; display: inline-block;">
                    <span class="{{ app()->getLocale() == 'id' ? 'fw-bold' : '' }}">ID</span> | 
                    <span class="{{ app()->getLocale() == 'en' ? 'fw-bold' : '' }}">EN</span>
                </span>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('home') }}" class="btn rounded-pill px-4 py-2 text-white shadow-sm btn-glass text-center" style="min-width: 120px;">
                    {{ __('main.navbar.home') }}
                </a>
                <form action="{{ route('logout') }}" method="post" class="m-0">
                    @csrf
                    <button type="submit" class="btn rounded-pill px-4 py-2 text-white shadow-sm btn-glass text-center" style="min-width: 120px;" onclick="return confirm('{{ __('main.messages.logout_confirm') }}')">
                        {{ __('main.navbar.logout') }}
                    </button>
                </form>
            </div>
            
        </div>
    </div>
</nav>