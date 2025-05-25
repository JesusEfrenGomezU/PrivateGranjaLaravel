<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ Request::is('/') ? '' : 'collapsed' }}" href="/">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->


        @if (\App\Helpers\RolHelper::isAuthorized('Parcelas.showParcelas'))
        <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('parcelas.*') ? '' : 'collapsed' }}" href="{{ route('parcelas.index') }}">
                <i class="bi bi-menu-button-wide"></i>
                <span>Parcelas</span>
            </a>
        </li>
        @endif

        @if (\App\Helpers\RolHelper::isAuthorized('Mantenimientos.showMantenimientos'))
        <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('mantenimientos.*') ? '' : 'collapsed' }}" href="{{ route('mantenimientos.index') }}">
                <i class="bi bi-menu-button-wide"></i>
                <span>Mantenimientos</span>
            </a>
        </li>
        @endif

        @if (\App\Helpers\RolHelper::isAuthorized('Cultivos.showCultivos'))
        <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('cultivos.*') ? '' : 'collapsed' }}" href="{{ route('cultivos.index') }}">
                <i class="bi bi-menu-button-wide"></i>
                <span>Cultivos</span>
            </a>
        </li>
        @endif

        @if (\App\Helpers\RolHelper::isAuthorized('Cosechas.showCosechas'))
        <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('cosechas.*') ? '' : 'collapsed' }}" href="{{ route('cosechas.index') }}">
                <i class="bi bi-menu-button-wide"></i>
                <span>Cosechas</span>
            </a>
        </li>
        @endif

        @if (\App\Helpers\RolHelper::isAuthorized('Cultivoparcelas.showCultivoparcelas'))
        <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('cultivoparcelas.*') ? '' : 'collapsed' }}" href="{{ route('cultivoparcelas.index') }}">
                <i class="bi bi-menu-button-wide"></i>
                <span>Cultivos Parcelas</span>
            </a>
        </li>
        @endif



    </ul>

</aside>
