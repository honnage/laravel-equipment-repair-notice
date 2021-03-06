<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>แจ้งซ่อมครุภัณฑ์</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="{{ asset('css/styles.css') }} " rel="stylesheet" />
        <link href="{{ asset('css/t-style.css') }} " rel="stylesheet" />
    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('js/scripts.js') }}"></script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('assets/demo/chart-area-demo.js') }}"></script>
        <script src="{{ asset('assets/demo/chart-bar-demo.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>


        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <script src="{{ asset('js/sweetalert_delete.js') }}"></script>

        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark" style="height: 60px">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="{{ route('dashboard') }}" style="font-size:30px">แจ้งซ่อมครุภัณฑ์</a> &nbsp;&nbsp;
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                {{-- <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div> --}}
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.show') }}">
                              
                                {{ __('โปรไฟล์') }} 
                            </a>
                        </li>
                        <li><hr class="dropdown-divider" /></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }} " > 
                                @csrf
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('ออกจากระบบ') }}
                                </a>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        {{-- @if(Auth::check() != null ) --}}
                            @if(Auth::user()->checkIsStatus() && Auth::check() && (Auth::user()->checkIsStatus() != 0 ) || (Auth::user()->id == 1 ))
                                <div class="nav">
                                    {{-- <div class="sb-sidenav-menu-heading">Core</div> --}}
                                    <div class="sb-sidenav-menu-heading"></div>
                                    <a class="nav-link" href="{{ route('transaction') }}" >
                                        <div class="sb-nav-link-icon"><i class="fas fa-chart-pie"></i></i></div>
                                        ข้อมูลการแจ้งซ่อม
                                    </a> 
                                    <a class="nav-link" href="{{ route('equipment') }}">
                                        <div class="sb-nav-link-icon"><i class="fas fa-th"></i></i></div>
                                        จัดการครุภัณฑ์
                                    </a>
                                    {{-- <a class="nav-link" href="{{ route('type') }}">
                                        <div class="sb-nav-link-icon"><i class="far fa-copy"></i></i></div>
                                        จัดการประเภทครุภัณฑ์
                                    </a> --}}
                                    <a class="nav-link" href="{{ route('category') }}">
                                        <div class="sb-nav-link-icon"><i class="far fa-copy"></i></i></div>
                                        จัดการหมวดหมู่ครุภัณฑ์
                                    </a>
                                    <a class="nav-link" href="{{ route('user') }}">
                                        <div class="sb-nav-link-icon"><i class="fas fa-chalkboard-teacher"></i></i></div>
                                        ข้อมูลพนักงาน
                                    </a>
                                </div>
                            @else
                                ffff                                
                            @endif
                    
                        {{-- @endif --}}
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        
                       
               
              
        
     