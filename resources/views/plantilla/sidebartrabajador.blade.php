<div class="app-header header-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ms-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>    <div class="app-header__content">
        <div class="app-header-left">
            <div class="search-wrapper">
                <div class="input-holder">
                    <input type="text" class="search-input" placeholder="Bienvenido al Sistema.">
                    <button class="search-icon font-icon-wrapper font-icon-lg" style="margin-right: 0px; min-width: 0px; background: rgb(255 255 255 / 6%);"><i class="fa fa-leaf icon-gradient bg-plum-plate"></i></button>
                </div>
                <button class="btn-close"></button>
            </div>
        </div>
        <div class="app-header-right">
            <div class="header-btn-lg pe-0">
                <div class="widget-content p-0">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="btn-group">
                                <a data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                    <img src="{{ asset('img/usuarios/' . Auth::user()->persona->imagen) }}" width="42" alt="Avatar" class="rounded-circle">
                                    <i class="fa fa-angle-down ms-2 opacity-8"></i>
                                </a>
                                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                    <button type="button" id="btn-exit" tabindex="0" class="dropdown-item"><li class="btn-exit" id="btn-exit" tabindex="0">Cerrar Sesion</li></button>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content-left  ms-3 header-user-info">
                                <div class="widget-heading">
                                    {{ Auth::user()->persona->nombre . ' ' . Auth::user()->persona->apellidoP . ' ' . Auth::user()->persona->apellidoM }}
                                </div>
                            <div class="widget-subheading">
                                {{Auth::user()->rol->nombre}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="ui-theme-settings">
    <button type="button" id="TooltipDemo" class="btn-open-options btn btn-warning">
        <i class="fa fa-cog fa-w-16 fa-spin fa-2x"></i>
    </button>
    <div class="theme-settings__inner">
        <div class="scrollbar-container">
            <div class="theme-settings__options-wrapper">
                <h3 class="themeoptions-heading">
                    <div>
                        Opciones de Encabezado
                    </div>
                    <button type="button" class="btn-pill btn-shadow btn-wide ms-auto btn btn-focus btn-sm switch-header-cs-class" data-class="">
                        Restaurar Predeterminado
                    </button>
                </h3>
                <div class="p-3">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <h5 class="pb-2">Elija Esquema de Color
                            </h5>
                            <div class="theme-settings-swatches">
                                <div class="swatch-holder bg-primary switch-header-cs-class" data-class="bg-primary header-text-light">
                                </div>
                                <div class="swatch-holder bg-secondary switch-header-cs-class" data-class="bg-secondary header-text-light">
                                </div>
                                <div class="swatch-holder bg-success switch-header-cs-class" data-class="bg-success header-text-dark">
                                </div>
                                <div class="swatch-holder bg-info switch-header-cs-class" data-class="bg-info header-text-dark">
                                </div>
                                <div class="swatch-holder bg-warning switch-header-cs-class" data-class="bg-warning header-text-dark">
                                </div>
                                <div class="swatch-holder bg-danger switch-header-cs-class" data-class="bg-danger header-text-light">
                                </div>
                                <div class="swatch-holder bg-light switch-header-cs-class" data-class="bg-light header-text-dark">
                                </div>
                                <div class="swatch-holder bg-dark switch-header-cs-class" data-class="bg-dark header-text-light">
                                </div>
                                <div class="swatch-holder bg-focus switch-header-cs-class" data-class="bg-focus header-text-light">
                                </div>
                                <div class="swatch-holder bg-alternate switch-header-cs-class" data-class="bg-alternate header-text-light">
                                </div>
                                <div class="divider">
                                </div>
                                <div class="swatch-holder bg-vicious-stance switch-header-cs-class" data-class="bg-vicious-stance header-text-light">
                                </div>
                                <div class="swatch-holder bg-midnight-bloom switch-header-cs-class" data-class="bg-midnight-bloom header-text-light">
                                </div>
                                <div class="swatch-holder bg-night-sky switch-header-cs-class" data-class="bg-night-sky header-text-light">
                                </div>
                                <div class="swatch-holder bg-slick-carbon switch-header-cs-class" data-class="bg-slick-carbon header-text-light">
                                </div>
                                <div class="swatch-holder bg-asteroid switch-header-cs-class" data-class="bg-asteroid header-text-light">
                                </div>
                                <div class="swatch-holder bg-royal switch-header-cs-class" data-class="bg-royal header-text-light">
                                </div>
                                <div class="swatch-holder bg-warm-flame switch-header-cs-class" data-class="bg-warm-flame header-text-dark">
                                </div>
                                <div class="swatch-holder bg-night-fade switch-header-cs-class" data-class="bg-night-fade header-text-dark">
                                </div>
                                <div class="swatch-holder bg-sunny-morning switch-header-cs-class" data-class="bg-sunny-morning header-text-dark">
                                </div>
                                <div class="swatch-holder bg-tempting-azure switch-header-cs-class" data-class="bg-tempting-azure header-text-dark">
                                </div>
                                <div class="swatch-holder bg-amy-crisp switch-header-cs-class" data-class="bg-amy-crisp header-text-dark">
                                </div>
                                <div class="swatch-holder bg-heavy-rain switch-header-cs-class" data-class="bg-heavy-rain header-text-dark">
                                </div>
                                <div class="swatch-holder bg-mean-fruit switch-header-cs-class" data-class="bg-mean-fruit header-text-dark">
                                </div>
                                <div class="swatch-holder bg-malibu-beach switch-header-cs-class" data-class="bg-malibu-beach header-text-light">
                                </div>
                                <div class="swatch-holder bg-deep-blue switch-header-cs-class" data-class="bg-deep-blue header-text-dark">
                                </div>
                                <div class="swatch-holder bg-ripe-malin switch-header-cs-class" data-class="bg-ripe-malin header-text-light">
                                </div>
                                <div class="swatch-holder bg-arielle-smile switch-header-cs-class" data-class="bg-arielle-smile header-text-light">
                                </div>
                                <div class="swatch-holder bg-plum-plate switch-header-cs-class" data-class="bg-plum-plate header-text-light">
                                </div>
                                <div class="swatch-holder bg-happy-fisher switch-header-cs-class" data-class="bg-happy-fisher header-text-dark">
                                </div>
                                <div class="swatch-holder bg-happy-itmeo switch-header-cs-class" data-class="bg-happy-itmeo header-text-light">
                                </div>
                                <div class="swatch-holder bg-mixed-hopes switch-header-cs-class" data-class="bg-mixed-hopes header-text-light">
                                </div>
                                <div class="swatch-holder bg-strong-bliss switch-header-cs-class" data-class="bg-strong-bliss header-text-light">
                                </div>
                                <div class="swatch-holder bg-grow-early switch-header-cs-class" data-class="bg-grow-early header-text-light">
                                </div>
                                <div class="swatch-holder bg-love-kiss switch-header-cs-class" data-class="bg-love-kiss header-text-light">
                                </div>
                                <div class="swatch-holder bg-premium-dark switch-header-cs-class" data-class="bg-premium-dark header-text-light">
                                </div>
                                <div class="swatch-holder bg-happy-green switch-header-cs-class" data-class="bg-happy-green header-text-light">
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <h3 class="themeoptions-heading">
                    <div>Opciones de la Barra Lateral</div>
                    <button type="button" class="btn-pill btn-shadow btn-wide ms-auto btn btn-focus btn-sm switch-sidebar-cs-class" data-class="">
                        Restaurar Predeterminado
                    </button>
                </h3>
                <div class="p-3">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <h5 class="pb-2">Elija Esquema de Color
                            </h5>
                            <div class="theme-settings-swatches">
                                <div class="swatch-holder bg-primary switch-sidebar-cs-class" data-class="bg-primary sidebar-text-light">
                                </div>
                                <div class="swatch-holder bg-secondary switch-sidebar-cs-class" data-class="bg-secondary sidebar-text-light">
                                </div>
                                <div class="swatch-holder bg-success switch-sidebar-cs-class" data-class="bg-success sidebar-text-dark">
                                </div>
                                <div class="swatch-holder bg-info switch-sidebar-cs-class" data-class="bg-info sidebar-text-dark">
                                </div>
                                <div class="swatch-holder bg-warning switch-sidebar-cs-class" data-class="bg-warning sidebar-text-dark">
                                </div>
                                <div class="swatch-holder bg-danger switch-sidebar-cs-class" data-class="bg-danger sidebar-text-light">
                                </div>
                                <div class="swatch-holder bg-light switch-sidebar-cs-class" data-class="bg-light sidebar-text-dark">
                                </div>
                                <div class="swatch-holder bg-dark switch-sidebar-cs-class" data-class="bg-dark sidebar-text-light">
                                </div>
                                <div class="swatch-holder bg-focus switch-sidebar-cs-class" data-class="bg-focus sidebar-text-light">
                                </div>
                                <div class="swatch-holder bg-alternate switch-sidebar-cs-class" data-class="bg-alternate sidebar-text-light">
                                </div>
                                <div class="divider">
                                </div>
                                <div class="swatch-holder bg-vicious-stance switch-sidebar-cs-class" data-class="bg-vicious-stance sidebar-text-light">
                                </div>
                                <div class="swatch-holder bg-midnight-bloom switch-sidebar-cs-class" data-class="bg-midnight-bloom sidebar-text-light">
                                </div>
                                <div class="swatch-holder bg-night-sky switch-sidebar-cs-class" data-class="bg-night-sky sidebar-text-light">
                                </div>
                                <div class="swatch-holder bg-slick-carbon switch-sidebar-cs-class" data-class="bg-slick-carbon sidebar-text-light">
                                </div>
                                <div class="swatch-holder bg-asteroid switch-sidebar-cs-class" data-class="bg-asteroid sidebar-text-light">
                                </div>
                                <div class="swatch-holder bg-royal switch-sidebar-cs-class" data-class="bg-royal sidebar-text-light">
                                </div>
                                <div class="swatch-holder bg-warm-flame switch-sidebar-cs-class" data-class="bg-warm-flame sidebar-text-dark">
                                </div>
                                <div class="swatch-holder bg-night-fade switch-sidebar-cs-class" data-class="bg-night-fade sidebar-text-dark">
                                </div>
                                <div class="swatch-holder bg-sunny-morning switch-sidebar-cs-class" data-class="bg-sunny-morning sidebar-text-dark">
                                </div>
                                <div class="swatch-holder bg-tempting-azure switch-sidebar-cs-class" data-class="bg-tempting-azure sidebar-text-dark">
                                </div>
                                <div class="swatch-holder bg-amy-crisp switch-sidebar-cs-class" data-class="bg-amy-crisp sidebar-text-dark">
                                </div>
                                <div class="swatch-holder bg-heavy-rain switch-sidebar-cs-class" data-class="bg-heavy-rain sidebar-text-dark">
                                </div>
                                <div class="swatch-holder bg-mean-fruit switch-sidebar-cs-class" data-class="bg-mean-fruit sidebar-text-dark">
                                </div>
                                <div class="swatch-holder bg-malibu-beach switch-sidebar-cs-class" data-class="bg-malibu-beach sidebar-text-light">
                                </div>
                                <div class="swatch-holder bg-deep-blue switch-sidebar-cs-class" data-class="bg-deep-blue sidebar-text-dark">
                                </div>
                                <div class="swatch-holder bg-ripe-malin switch-sidebar-cs-class" data-class="bg-ripe-malin sidebar-text-light">
                                </div>
                                <div class="swatch-holder bg-arielle-smile switch-sidebar-cs-class" data-class="bg-arielle-smile sidebar-text-light">
                                </div>
                                <div class="swatch-holder bg-plum-plate switch-sidebar-cs-class" data-class="bg-plum-plate sidebar-text-light">
                                </div>
                                <div class="swatch-holder bg-happy-fisher switch-sidebar-cs-class" data-class="bg-happy-fisher sidebar-text-dark">
                                </div>
                                <div class="swatch-holder bg-happy-itmeo switch-sidebar-cs-class" data-class="bg-happy-itmeo sidebar-text-light">
                                </div>
                                <div class="swatch-holder bg-mixed-hopes switch-sidebar-cs-class" data-class="bg-mixed-hopes sidebar-text-light">
                                </div>
                                <div class="swatch-holder bg-strong-bliss switch-sidebar-cs-class" data-class="bg-strong-bliss sidebar-text-light">
                                </div>
                                <div class="swatch-holder bg-grow-early switch-sidebar-cs-class" data-class="bg-grow-early sidebar-text-light">
                                </div>
                                <div class="swatch-holder bg-love-kiss switch-sidebar-cs-class" data-class="bg-love-kiss sidebar-text-light">
                                </div>
                                <div class="swatch-holder bg-premium-dark switch-sidebar-cs-class" data-class="bg-premium-dark sidebar-text-light">
                                </div>
                                <div class="swatch-holder bg-happy-green switch-sidebar-cs-class" data-class="bg-happy-green sidebar-text-light">
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="app-main">
        <div class="app-sidebar sidebar-shadow">
            <div class="app-header__logo">
                <div class="logo-src"><img src="img/plantilla/logopdf.png" alt="Logo" id="logo"></div>
                <div class="header__pane ms-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>

            <div class="scrollbar-sidebar">
                <div class="app-sidebar__inner">
                    <ul class="vertical-nav-menu">
                        @if (Auth::user()->persona->idcargo == 1)
                        <li class="app-sidebar__heading">PRINCIPAL</li>
                                <li>
                                    <a href="#" class="mm-active">
                                        <i class="metismenu-icon pe-7s-home"></i>
                                        Administracion
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul>
                                        <li @click="menu=6">
                                            <a href="#">
                                                <i class="metismenu-icon pe-7s-menu"></i>
                                                Noticias
                                            </a>
                                        </li>
                                        <li @click="menu=1">
                                            <a href="#">
                                                <i class="metismenu-icon pe-7s-id">
                                                </i>Dashboard
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                        @endif
                        @if (Auth::user()->persona->idcargo > 1)
                        <li class="app-sidebar__heading">PRINCIPAL</li>
                        <li  @click="menu=0">
                            <a href="#" class="mm-active">
                                <i class="metismenu-icon pe-7s-home"></i>
                                Noticias
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->persona->idcargo > 1)
                        <li class="app-sidebar__heading">PROCESOS DE FAENEO</li>
                        <li>
                            <a href="#">
                                <i class="metismenu-icon pe-7s-server"></i>
                                Lista de Ganados
                                <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                            </a>
                            <ul>
                                @if (Auth::user()->persona->idcargo == 2 )
                                <li @click="menu=2">
                                    <a href="#">
                                        <i class="metismenu-icon pe-7s-menu"></i>
                                        Registrar Ganado
                                    </a>
                                </li>
                                <li @click="menu=3">
                                    <a href="#">
                                        <i class="metismenu-icon pe-7s-id">
                                        </i>Proceso Faeneo
                                    </a>
                                </li>
                                @endif
                                @if (Auth::user()->persona->idcargo == 3 )
                                <li @click="menu=4">
                                    <a href="#">
                                        <i class="metismenu-icon pe-7s-wallet">
                                        </i>Proceso Final
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        @endif
                        @if (Auth::user()->persona->idcargo == 1 )
                        <li class="app-sidebar__heading">LISTA DE AUTORIZACION FAENEO</li>
                        <li @click="menu=5">
                            <a href="#">
                                <i class="metismenu-icon pe-7s-note2"></i>
                                Generar Lista
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->persona->idcargo == 2 )
                        <li class="app-sidebar__heading">CORRALES</li>
                                <li @click="menu=7">
                                    <a href="#">
                                        <i class="metismenu-icon pe-7s-display1">
                                        </i>Monitorear Corrales
                                    </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="app-main__outer">
            <div class="app-main__inner">
                 @yield('contenido')

            </div>
            <div class="app-wrapper-footer">
                <div class="app-footer">
                    <div class="app-footer__inner">
                        <div class="app-footer-left">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a href="javascript:void(0);" class="nav-link">
                                        @2023 F.U.T.E.C.R.A.
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="app-footer-right">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a href="javascript:void(0);" class="nav-link">
                                        Federacion Unica de Trabajadores en Carne y Ramas Anexas.
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


