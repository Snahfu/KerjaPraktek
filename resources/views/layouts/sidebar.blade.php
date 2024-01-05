<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
      <div class="brand-logo d-flex align-items-center justify-content-between">
        <a href="./index.html" class="text-nowrap logo-img">
          <img src="{{ asset('template/assets/images/logos/logo-rental-alat.png') }}" width="180" alt="" />
        </a>
        <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
          <i class="ti ti-x fs-8"></i>
        </div>
      </div>
      <!-- Sidebar navigation-->
      <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
        <ul id="sidebarnav">
          <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">Home</span>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="/dashboard-admin" aria-expanded="false">
              <span>
                <i class="ti ti-layout-dashboard"></i>
              </span>
              <span class="hide-menu">Dashboard</span>
            </a>
          </li>
          <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">Admin Menu</span>
          </li>
          @if (Auth::user()->divisi_id == 5)
            <li class="sidebar-item">
              <a class="sidebar-link" href="/data-pelanggan" aria-expanded="false">
                <span>
                  <i class="ti ti-users"></i>
                </span>
                <span class="hide-menu">Data Pelanggan</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="/data-gudang" aria-expanded="false">
                <span>
                  <i class="ti ti-building-warehouse"></i>
                </span>
                <span class="hide-menu">Data Barang</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('jenis.datajenis') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-box"></i>
                </span>
                <span class="hide-menu">Jenis Barang</span>
              </a>
            </li>
            <li class="sidebar-item">
                @if (Auth::user()->divisi_id == 3)
                    <a class="sidebar-link" href="{{ route('damage.datadamage-servicer') }}" aria-expanded="false">
                @else
                    <a class="sidebar-link" href="{{ route('damage.datadamage') }}" aria-expanded="false">
                @endif
                <span>
                  <i class="ti ti-egg-cracked"></i>
                </span>
                <span class="hide-menu">Barang Rusak</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('shipping.datashipping') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-truck-delivery"></i>
                </span>
                <span class="hide-menu">Shipping</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('getbarangoutget') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-truck-delivery"></i>
                </span>
                <span class="hide-menu">Barang Keluar</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="/data-invoice" aria-expanded="false">
                <span>
                  <i class="ti ti-timeline"></i>
                </span>
                <span class="hide-menu">Tabel Invoice</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="/data-tagihan" aria-expanded="false">
                <span>
                  <i class="ti ti-timeline"></i>
                </span>
                <span class="hide-menu">Tabel Tagihan</span>
              </a>
            </li>
            {{-- <li class="sidebar-item">
              <a class="sidebar-link" href="./ui-buttons.html" aria-expanded="false">
                <span>
                  <i class="ti ti-report-analytics"></i>
                </span>
                <span class="hide-menu">Laporan Penjualan</span>
              </a>
            </li> --}}
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('common.index.tambahevent') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-circle-plus"></i>
                </span>
                <span class="hide-menu">Tambah Order</span>
              </a>
            </li>
          @elseif(Auth::user()->divisi_id == 4)
            <li class="sidebar-item">
              <a class="sidebar-link" href="/data-pelanggan" aria-expanded="false">
                <span>
                  <i class="ti ti-users"></i>
                </span>
                <span class="hide-menu">Data Pelanggan</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('jenis.datajenis') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-box"></i>
                </span>
                <span class="hide-menu">Jenis Barang</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('shipping.datashipping') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-truck-delivery"></i>
                </span>
                <span class="hide-menu">Shipping</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('getbarangoutget') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-truck-delivery"></i>
                </span>
                <span class="hide-menu">Barang Keluar</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="/data-invoice" aria-expanded="false">
                <span>
                  <i class="ti ti-timeline"></i>
                </span>
                <span class="hide-menu">Tabel Invoice</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="/data-tagihan" aria-expanded="false">
                <span>
                  <i class="ti ti-timeline"></i>
                </span>
                <span class="hide-menu">Tabel Tagihan</span>
              </a>
            </li>
            {{-- <li class="sidebar-item">
              <a class="sidebar-link" href="./ui-buttons.html" aria-expanded="false">
                <span>
                  <i class="ti ti-report-analytics"></i>
                </span>
                <span class="hide-menu">Laporan Penjualan</span>
              </a>
            </li> --}}
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('common.index.tambahevent') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-circle-plus"></i>
                </span>
                <span class="hide-menu">Tambah Order</span>
              </a>
            </li>
          
          @elseif(Auth::user()->divisi_id == 3)
            <li class="sidebar-item">
              <a class="sidebar-link" href="/data-gudang" aria-expanded="false">
                <span>
                  <i class="ti ti-building-warehouse"></i>
                </span>
                <span class="hide-menu">Data Barang</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('jenis.datajenis') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-box"></i>
                </span>
                <span class="hide-menu">Jenis Barang</span>
              </a>
            </li>
            <li class="sidebar-item">
                @if (Auth::user()->divisi_id == 3)
                    <a class="sidebar-link" href="{{ route('damage.datadamage-servicer') }}" aria-expanded="false">
                @else
                    <a class="sidebar-link" href="{{ route('damage.datadamage') }}" aria-expanded="false">
                @endif
                <span>
                  <i class="ti ti-egg-cracked"></i>
                </span>
                <span class="hide-menu">Barang Rusak</span>
              </a>
            </li>

          @elseif(Auth::user()->divisi_id == 2)
            <li class="sidebar-item">
              <a class="sidebar-link" href="/data-gudang" aria-expanded="false">
                <span>
                  <i class="ti ti-building-warehouse"></i>
                </span>
                <span class="hide-menu">Data Barang</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('jenis.datajenis') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-box"></i>
                </span>
                <span class="hide-menu">Jenis Barang</span>
              </a>
            </li>
            <li class="sidebar-item">
                @if (Auth::user()->divisi_id == 3)
                    <a class="sidebar-link" href="{{ route('damage.datadamage-servicer') }}" aria-expanded="false">
                @else
                    <a class="sidebar-link" href="{{ route('damage.datadamage') }}" aria-expanded="false">
                @endif
                <span>
                  <i class="ti ti-egg-cracked"></i>
                </span>
                <span class="hide-menu">Barang Rusak</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('shipping.datashipping') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-truck-delivery"></i>
                </span>
                <span class="hide-menu">Shipping</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('getbarangoutget') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-truck-delivery"></i>
                </span>
                <span class="hide-menu">Barang Keluar</span>
              </a>
            </li>
          @else
              
          @endif
        </ul>
      </nav>
      <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
  </aside>