<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo me-1">

            </span>
            <span class="app-brand-text demo menu-text fw-semibold ms-2">Protofilo</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="mdi menu-toggle-icon d-xl-block align-middle mdi-20px"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item ">
            <a href="" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-google-circles-extended"></i>
                <div data-i18n="Icons">Dashboard</div>
            </a>
        </li>


        <!-- Layouts -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons mdi mdi-window-maximize"></i>
                <div data-i18n="Layouts">Project</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ url('admin/project/list') }}" class="menu-link">
                        <div data-i18n="Blank">List</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons mdi mdi-window-maximize"></i>
                <div data-i18n="Layouts">Info</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ url('admin/info/list') }}" class="menu-link">
                        <div data-i18n="Blank">List</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item ">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons mdi mdi-window-maximize"></i>
                <div data-i18n="Layouts">Skills</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ url('admin/skill/list') }}" class="menu-link">
                        <div data-i18n="Blank">List</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons mdi mdi-window-maximize"></i>
                <div data-i18n="Layouts">Certificate</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ url('admin/certificate/list') }}" class="menu-link">
                        <div data-i18n="Blank">List</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons mdi mdi-window-maximize"></i>
                <div data-i18n="Layouts">Footer</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ url('admin/footer/list') }}" class="menu-link">
                        <div data-i18n="Blank">List</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-header fw-medium mt-4">
            <span class="menu-header-text">Apps &amp; Pages</span>
        </li>

        <!-- Misc -->

        <li class="menu-item">
            <a href="https://demos.themeselection.com/materio-bootstrap-html-admin-template/documentation/"
                target="_blank" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-file-document-multiple-outline"></i>
                <div data-i18n="Documentation">Logout</div>
            </a>
        </li>
    </ul>
</aside>
