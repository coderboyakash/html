<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{ config('app.name') }} | Dashboard</title>
      <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
      <link rel="stylesheet" href="{{ asset('public/adminLTE/plugins/fontawesome-free/css/all.min.css') }}">
      <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
      <link rel="stylesheet" href="{{ asset('public/adminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
      <link rel="stylesheet" href="{{ asset('public/adminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
      <link rel="stylesheet" href="{{ asset('public/adminLTE/plugins/jqvmap/jqvmap.min.css') }}">
      <link rel="stylesheet" href="{{ asset('public/adminLTE/plugins/select2/css/select2.min.css') }}">
      <link rel="stylesheet" href="{{ asset('public/adminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
      <link rel="stylesheet" href="{{ asset('public/adminLTE/dist/css/adminlte.min.css') }}">
      <link rel="stylesheet" href="{{ asset('public/adminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
      <link rel="stylesheet" href="{{ asset('public/adminLTE/plugins/daterangepicker/daterangepicker.css') }}">
      <link rel="stylesheet" href="{{ asset('public/adminLTE/plugins/summernote/summernote-bs4.min.css') }}">
      <link rel="stylesheet" href="{{ asset('public/adminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
      <link rel="stylesheet" href="{{ asset('public/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
      <link rel="stylesheet" href="{{ asset('public/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
      <link rel="stylesheet" href="{{ asset('public/adminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
      <link rel="stylesheet" href="{{ asset('public/adminLTE/dist/css/adminlte.min.css') }}">
      <link rel="stylesheet" href="{{ asset('public/adminLTE/plugins/toastr/toastr.min.css') }}">
      <link rel="stylesheet" href="{{ asset('public/adminLTE/dist/css/adminlte.min.css') }}">
      <style>
         .buttonload {
         border: none; /* Remove borders */
         color: white; /* White text */
         padding: 12px 24px; /* Some padding */
         font-size: 16px; /* Set a font-size */
         }
         .fa {
         margin-left: 5px;
         }
      </style>
      <style>
         /* Config */
         :root {
         --sk-size: 40px;
         --sk-color: #333;
         }
         /* Utility class for centering */
         .sk-center { margin: auto; }
         /*  Plane
         <div class="sk-plane"></div>
         */
         .sk-plane {
         width: var(--sk-size);
         height: var(--sk-size);
         background-color: var(--sk-color);
         animation: sk-plane 1.2s infinite ease-in-out; 
         }
         @keyframes sk-plane {
         0% {
         transform: perspective(120px) rotateX(0deg) rotateY(0deg); 
         } 50% {
         transform: perspective(120px) rotateX(-180.1deg) rotateY(0deg); 
         } 100% {
         transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg); 
         } 
         }
         /*  Chase
         <div class="sk-chase">
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
         </div>
         */
         .sk-chase {
         width: var(--sk-size);
         height: var(--sk-size);
         position: relative;
         animation: sk-chase 2.5s infinite linear both; 
         }
         .sk-chase-dot {
         width: 100%;
         height: 100%;
         position: absolute;
         left: 0;
         top: 0; 
         animation: sk-chase-dot 2.0s infinite ease-in-out both; 
         }
         .sk-chase-dot:before {
         content: '';
         display: block;
         width: 25%;
         height: 25%;
         background-color: var(--sk-color);
         border-radius: 100%;
         animation: sk-chase-dot-before 2.0s infinite ease-in-out both; 
         }
         .sk-chase-dot:nth-child(1) { animation-delay: -1.1s; }
         .sk-chase-dot:nth-child(2) { animation-delay: -1.0s; }
         .sk-chase-dot:nth-child(3) { animation-delay: -0.9s; }
         .sk-chase-dot:nth-child(4) { animation-delay: -0.8s; }
         .sk-chase-dot:nth-child(5) { animation-delay: -0.7s; }
         .sk-chase-dot:nth-child(6) { animation-delay: -0.6s; }
         .sk-chase-dot:nth-child(1):before { animation-delay: -1.1s; }
         .sk-chase-dot:nth-child(2):before { animation-delay: -1.0s; }
         .sk-chase-dot:nth-child(3):before { animation-delay: -0.9s; }
         .sk-chase-dot:nth-child(4):before { animation-delay: -0.8s; }
         .sk-chase-dot:nth-child(5):before { animation-delay: -0.7s; }
         .sk-chase-dot:nth-child(6):before { animation-delay: -0.6s; }
         @keyframes sk-chase {
         100% { transform: rotate(360deg); } 
         }
         @keyframes sk-chase-dot {
         80%, 100% { transform: rotate(360deg); } 
         }
         @keyframes sk-chase-dot-before {
         50% {
         transform: scale(0.4); 
         } 100%, 0% {
         transform: scale(1.0); 
         } 
         }
         /*  Bounce
         <div class="sk-bounce">
            <div class="sk-bounce-dot"></div>
            <div class="sk-bounce-dot"></div>
         </div>
         */
         .sk-bounce {
         width: var(--sk-size);
         height: var(--sk-size);
         position: relative;
         }
         .sk-bounce-dot {
         width: 100%;
         height: 100%;
         border-radius: 50%;
         background-color: var(--sk-color);
         opacity: 0.6;
         position: absolute;
         top: 0;
         left: 0;
         animation: sk-bounce 2s infinite cubic-bezier(0.455, 0.03, 0.515, 0.955); 
         }
         .sk-bounce-dot:nth-child(2) { animation-delay: -1.0s; }
         @keyframes sk-bounce {
         0%, 100% {
         transform: scale(0);
         } 45%, 55% {
         transform: scale(1); 
         } 
         }
         /*  Wave
         <div class="sk-wave">
            <div class="sk-wave-rect"></div>
            <div class="sk-wave-rect"></div>
            <div class="sk-wave-rect"></div>
            <div class="sk-wave-rect"></div>
            <div class="sk-wave-rect"></div>
         </div>
         */
         .sk-wave {
         width: var(--sk-size);
         height: var(--sk-size);
         display: flex;
         justify-content: space-between;
         }
         .sk-wave-rect {
         background-color: var(--sk-color);
         height: 100%;
         width: 15%;
         animation: sk-wave 1.2s infinite ease-in-out; 
         }
         .sk-wave-rect:nth-child(1) { animation-delay: -1.2s; }
         .sk-wave-rect:nth-child(2) { animation-delay: -1.1s; }
         .sk-wave-rect:nth-child(3) { animation-delay: -1.0s; }
         .sk-wave-rect:nth-child(4) { animation-delay: -0.9s; }
         .sk-wave-rect:nth-child(5) { animation-delay: -0.8s; }
         @keyframes sk-wave {
         0%, 40%, 100% {
         transform: scaleY(0.4); 
         } 20% {
         transform: scaleY(1); 
         } 
         }
         /*  Pulse
         <div class="sk-pulse"></div>
         */
         .sk-pulse {
         width: var(--sk-size);
         height: var(--sk-size);
         background-color: var(--sk-color);
         border-radius: 100%;
         animation: sk-pulse 1.2s infinite cubic-bezier(0.455, 0.03, 0.515, 0.955); 
         }
         @keyframes sk-pulse {
         0% {
         transform: scale(0); 
         } 100% {
         transform: scale(1);
         opacity: 0; 
         }
         }
         /*  Flow
         <div class="sk-flow">
            <div class="sk-flow-dot"></div>
            <div class="sk-flow-dot"></div>
            <div class="sk-flow-dot"></div>
         </div>
         */
         .sk-flow {
         width: calc(var(--sk-size) * 1.3);
         height: calc(var(--sk-size) * 1.3);
         display: flex;
         justify-content: space-between;
         }
         .sk-flow-dot {
         width: 25%;
         height: 25%;
         background-color: var(--sk-color);
         border-radius: 50%;
         animation: sk-flow 1.4s cubic-bezier(0.455, 0.03, 0.515, 0.955) 0s infinite both;
         }
         .sk-flow-dot:nth-child(1) { animation-delay: -0.30s; }
         .sk-flow-dot:nth-child(2) { animation-delay: -0.15s; }
         @keyframes sk-flow {
         0%, 80%, 100% {
         transform: scale(0.3); }
         40% {
         transform: scale(1); 
         }
         }
         /*  Swing
         <div class="sk-swing">
            <div class="sk-swing-dot"></div>
            <div class="sk-swing-dot"></div>
         </div>
         */
         .sk-swing {
         width: var(--sk-size);
         height: var(--sk-size);
         position: relative;
         animation: sk-swing 1.8s infinite linear; 
         }
         .sk-swing-dot {
         width: 45%;
         height: 45%;
         position: absolute;
         top: 0;
         left: 0;
         right: 0;
         margin: auto;
         background-color: var(--sk-color);
         border-radius: 100%;
         animation: sk-swing-dot 2s infinite ease-in-out; 
         }
         .sk-swing-dot:nth-child(2) {
         top: auto;
         bottom: 0;
         animation-delay: -1s; 
         }
         @keyframes sk-swing {
         100% {
         transform: rotate(360deg); 
         } 
         }
         @keyframes sk-swing-dot {
         0%, 100% {
         transform: scale(0.2); }
         50% {
         transform: scale(1); 
         } 
         }
         /*  Circle
         <div class="sk-circle">
            <div class="sk-circle-dot"></div>
            <div class="sk-circle-dot"></div>
            <div class="sk-circle-dot"></div>
            <div class="sk-circle-dot"></div>
            <div class="sk-circle-dot"></div>
            <div class="sk-circle-dot"></div>
            <div class="sk-circle-dot"></div>
            <div class="sk-circle-dot"></div>
            <div class="sk-circle-dot"></div>
            <div class="sk-circle-dot"></div>
            <div class="sk-circle-dot"></div>
            <div class="sk-circle-dot"></div>
         </div>
         */
         .sk-circle {
         width: var(--sk-size);
         height: var(--sk-size);
         position: relative; 
         }
         .sk-circle-dot {
         width: 100%;
         height: 100%;
         position: absolute;
         left: 0;
         top: 0;
         }
         .sk-circle-dot:before {
         content: '';
         display: block;
         width: 15%;
         height: 15%;
         background-color: var(--sk-color);
         border-radius: 100%;
         animation: sk-circle 1.2s infinite ease-in-out both; 
         }
         .sk-circle-dot:nth-child(1) { transform: rotate(30deg); }
         .sk-circle-dot:nth-child(2) { transform: rotate(60deg); }
         .sk-circle-dot:nth-child(3) { transform: rotate(90deg); }
         .sk-circle-dot:nth-child(4) { transform: rotate(120deg); }
         .sk-circle-dot:nth-child(5) { transform: rotate(150deg); }
         .sk-circle-dot:nth-child(6) { transform: rotate(180deg); }
         .sk-circle-dot:nth-child(7) { transform: rotate(210deg); }
         .sk-circle-dot:nth-child(8) { transform: rotate(240deg); }
         .sk-circle-dot:nth-child(9) { transform: rotate(270deg); }
         .sk-circle-dot:nth-child(10) { transform: rotate(300deg); }
         .sk-circle-dot:nth-child(11) { transform: rotate(330deg); }
         .sk-circle-dot:nth-child(1):before { animation-delay: -1.1s; }
         .sk-circle-dot:nth-child(2):before { animation-delay: -1s; }
         .sk-circle-dot:nth-child(3):before { animation-delay: -0.9s; }
         .sk-circle-dot:nth-child(4):before { animation-delay: -0.8s; }
         .sk-circle-dot:nth-child(5):before { animation-delay: -0.7s; }
         .sk-circle-dot:nth-child(6):before { animation-delay: -0.6s; }
         .sk-circle-dot:nth-child(7):before { animation-delay: -0.5s; }
         .sk-circle-dot:nth-child(8):before { animation-delay: -0.4s; }
         .sk-circle-dot:nth-child(9):before { animation-delay: -0.3s; }
         .sk-circle-dot:nth-child(10):before { animation-delay: -0.2s; }
         .sk-circle-dot:nth-child(11):before { animation-delay: -0.1s; }
         @keyframes sk-circle {
         0%, 80%, 100% {
         transform: scale(0); }
         40% {
         transform: scale(1); 
         } 
         }
         /*  Circle Fade
         <div class="sk-circle-fade">
            <div class="sk-circle-fade-dot"></div>
            <div class="sk-circle-fade-dot"></div>
            <div class="sk-circle-fade-dot"></div>
            <div class="sk-circle-fade-dot"></div>
            <div class="sk-circle-fade-dot"></div>
            <div class="sk-circle-fade-dot"></div>
            <div class="sk-circle-fade-dot"></div>
            <div class="sk-circle-fade-dot"></div>
            <div class="sk-circle-fade-dot"></div>
            <div class="sk-circle-fade-dot"></div>
            <div class="sk-circle-fade-dot"></div>
            <div class="sk-circle-fade-dot"></div>
         </div>
         */
         .sk-circle-fade {
         width: var(--sk-size);
         height: var(--sk-size);
         position: relative; 
         }
         .sk-circle-fade-dot {
         width: 100%;
         height: 100%;
         position: absolute;
         left: 0;
         top: 0; 
         }
         .sk-circle-fade-dot:before {
         content: '';
         display: block;
         width: 15%;
         height: 15%;
         background-color: var(--sk-color);
         border-radius: 100%;
         animation: sk-circle-fade 1.2s infinite ease-in-out both; 
         }
         .sk-circle-fade-dot:nth-child(1)  { transform: rotate(30deg);  }
         .sk-circle-fade-dot:nth-child(2)  { transform: rotate(60deg);  }
         .sk-circle-fade-dot:nth-child(3)  { transform: rotate(90deg);  }
         .sk-circle-fade-dot:nth-child(4)  { transform: rotate(120deg); }
         .sk-circle-fade-dot:nth-child(5)  { transform: rotate(150deg); }
         .sk-circle-fade-dot:nth-child(6)  { transform: rotate(180deg); }
         .sk-circle-fade-dot:nth-child(7)  { transform: rotate(210deg); }
         .sk-circle-fade-dot:nth-child(8)  { transform: rotate(240deg); }
         .sk-circle-fade-dot:nth-child(9)  { transform: rotate(270deg); }
         .sk-circle-fade-dot:nth-child(10) { transform: rotate(300deg); }
         .sk-circle-fade-dot:nth-child(11) { transform: rotate(330deg); }
         .sk-circle-fade-dot:nth-child(1):before  { animation-delay: -1.1s; }
         .sk-circle-fade-dot:nth-child(2):before  { animation-delay: -1.0s; }
         .sk-circle-fade-dot:nth-child(3):before  { animation-delay: -0.9s; }
         .sk-circle-fade-dot:nth-child(4):before  { animation-delay: -0.8s; }
         .sk-circle-fade-dot:nth-child(5):before  { animation-delay: -0.7s; }
         .sk-circle-fade-dot:nth-child(6):before  { animation-delay: -0.6s; }
         .sk-circle-fade-dot:nth-child(7):before  { animation-delay: -0.5s; }
         .sk-circle-fade-dot:nth-child(8):before  { animation-delay: -0.4s; }
         .sk-circle-fade-dot:nth-child(9):before  { animation-delay: -0.3s; }
         .sk-circle-fade-dot:nth-child(10):before { animation-delay: -0.2s; }
         .sk-circle-fade-dot:nth-child(11):before { animation-delay: -0.1s; }
         @keyframes sk-circle-fade {
         0%, 39%, 100% {
         opacity: 0;
         transform: scale(0.6);
         } 40% {
         opacity: 1; 
         transform: scale(1);
         }
         }
         /*  Grid
         <div class="sk-grid">
            <div class="sk-grid-cube"></div>
            <div class="sk-grid-cube"></div>
            <div class="sk-grid-cube"></div>
            <div class="sk-grid-cube"></div>
            <div class="sk-grid-cube"></div>
            <div class="sk-grid-cube"></div>
            <div class="sk-grid-cube"></div>
            <div class="sk-grid-cube"></div>
            <div class="sk-grid-cube"></div>
         </div>
         */
         .sk-grid {
         width: var(--sk-size);
         height: var(--sk-size);
         /* Cube positions
         * 1 2 3
         * 4 5 6
         * 7 8 9
         */ 
         }
         .sk-grid-cube {
         width: 33.33%;
         height: 33.33%;
         background-color: var(--sk-color);
         float: left;
         animation: sk-grid 1.3s infinite ease-in-out; 
         }
         .sk-grid-cube:nth-child(1) { animation-delay: 0.2s; }
         .sk-grid-cube:nth-child(2) { animation-delay: 0.3s; }
         .sk-grid-cube:nth-child(3) { animation-delay: 0.4s; }
         .sk-grid-cube:nth-child(4) { animation-delay: 0.1s; }
         .sk-grid-cube:nth-child(5) { animation-delay: 0.2s; }
         .sk-grid-cube:nth-child(6) { animation-delay: 0.3s; }
         .sk-grid-cube:nth-child(7) { animation-delay: 0.0s; }
         .sk-grid-cube:nth-child(8) { animation-delay: 0.1s; }
         .sk-grid-cube:nth-child(9) { animation-delay: 0.2s; }
         @keyframes sk-grid {
         0%, 70%, 100% {
         transform: scale3D(1, 1, 1); 
         } 35% {
         transform: scale3D(0, 0, 1); 
         } 
         }
         /*  Fold
         <div class="sk-fold">
            <div class="sk-fold-cube"></div>
            <div class="sk-fold-cube"></div>
            <div class="sk-fold-cube"></div>
            <div class="sk-fold-cube"></div>
         </div>
         */
         .sk-fold {
         width: var(--sk-size);
         height: var(--sk-size);
         position: relative;
         transform: rotateZ(45deg); 
         }
         .sk-fold-cube {
         float: left;
         width: 50%;
         height: 50%;
         position: relative;
         transform: scale(1.1); 
         }
         .sk-fold-cube:before {
         content: '';
         position: absolute;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         background-color: var(--sk-color);
         animation: sk-fold 2.4s infinite linear both;
         transform-origin: 100% 100%; 
         }
         .sk-fold-cube:nth-child(2) { transform: scale(1.1) rotateZ(90deg); }
         .sk-fold-cube:nth-child(4) { transform: scale(1.1) rotateZ(180deg); }
         .sk-fold-cube:nth-child(3) { transform: scale(1.1) rotateZ(270deg); }
         .sk-fold-cube:nth-child(2):before { animation-delay: 0.3s; }
         .sk-fold-cube:nth-child(4):before { animation-delay: 0.6s; }
         .sk-fold-cube:nth-child(3):before { animation-delay: 0.9s; }
         @keyframes sk-fold {
         0%, 10% {
         transform: perspective(140px) rotateX(-180deg);
         opacity: 0; 
         } 25%, 75% {
         transform: perspective(140px) rotateX(0deg);
         opacity: 1; 
         } 90%, 100% {
         transform: perspective(140px) rotateY(180deg);
         opacity: 0;
         } 
         }
         /*  Wander
         <div class="sk-wander">
            <div class="sk-wander-cube"></div>
            <div class="sk-wander-cube"></div>
            <div class="sk-wander-cube"></div>
            <div class="sk-wander-cube"></div>
         </div>
         */
         .sk-wander {
         width: var(--sk-size);
         height: var(--sk-size);
         position: relative; 
         }
         .sk-wander-cube {
         background-color: var(--sk-color);
         width: 20%;
         height: 20%;
         position: absolute;
         top: 0;
         left: 0;
         --sk-wander-distance: calc(var(--sk-size) * 0.75);
         animation: sk-wander 2.0s ease-in-out -2.0s infinite both;
         }
         .sk-wander-cube:nth-child(2) { animation-delay: -0.5s; }
         .sk-wander-cube:nth-child(3) { animation-delay: -1.0s; }
         @keyframes sk-wander {
         0% {
         transform: rotate(0deg); 
         } 25% {
         transform: translateX(var(--sk-wander-distance)) rotate(-90deg) scale(0.6); 
         } 50% { /* Make FF rotate in the right direction */
         transform: translateX(var(--sk-wander-distance)) translateY(var(--sk-wander-distance)) rotate(-179deg); 
         } 50.1% {
         transform: translateX(var(--sk-wander-distance)) translateY(var(--sk-wander-distance)) rotate(-180deg); 
         } 75% {
         transform: translateX(0) translateY(var(--sk-wander-distance)) rotate(-270deg) scale(0.6);
         } 100% {
         transform: rotate(-360deg); 
         }
         }   .center {
         position: absolute;
         left: 50%;
         top: 50%;
         transform: translate(-50%, -50%);
         padding: 10px;
         }
      </style>
      @yield('stylesheets')
   </head>
   <body class="hold-transition sidebar-mini layout-fixed">
      <div class="center" id="spinner">
         <div class="sk-chase">
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
         </div>
      </div>
      <div class="wrapper d-none">
         <!-- Navbar -->
         <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
               <li class="nav-item">
                  <a class="nav-link" data-widget="pushmenu" role="button"><i class="fas fa-bars"></i></a>
               </li>
               <li class="nav-item d-none d-sm-inline-block">
                  <a href="{{ route('admin.dashboard') }}" class="nav-link">Home</a>
               </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
               <!-- Messages Dropdown Menu -->
               <li class="nav-item">
               <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                     <form id="logout-form" action="{{ route('admin.logout') }}" method="GET" class="d-none">
                        @csrf
                     </form>
                </li>
               <li class="nav-item">
                  <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                  <i class="fas fa-expand-arrows-alt"></i>
                  </a>
               </li>
            </ul>
         </nav>
         <!-- /.navbar -->
         <!-- Main Sidebar Container -->
         <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" target="_blank" class="brand-link">
            <img src="{{ asset('public/favicon.ico') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
            <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
               <!-- Sidebar user panel (optional) -->
               <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                  <div class="image">
                     <img src="https://www.pngitem.com/pimgs/m/128-1280822_check-mark-box-clip-art-blue-admin-icon.png" class="img-circle elevation-2" alt="User Image">
                  </div>
                  <div class="info">
                     <a href="#" class="d-block">{{ auth()->user() ? auth()->user()->username : 'Admin Name' }}</a>
                  </div>
               </div>
               <!-- Sidebar Menu -->
               <nav class="mt-2" id="nav_link">
                  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                     <!-- dashboard li -->
                     <li class="nav-item">
                        <a href="javascript:void(0);" class="nav-link" data-url="reload">
                           <i class="nav-icon fas fa-tachometer-alt"></i>
                           <p>
                              Dashboard
                           </p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="javascript:void(0);" class="nav-link" data-url="{{ route('admin.show.gallery') }}" data-request="GET">
                           <i class="nav-icon fas fa-image"></i>
                           <p>
                              Gallery
                           </p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="javascript:void(0);" class="nav-link" data-url="not_reload">
                           <i class="nav-icon fa fa-list-alt"></i>
                           <p>
                              Category Management
                              <i class="right fas fa-angle-left"></i>
                           </p>
                        </a>
                        <ul class="nav nav-treeview" id='page_contents'>
                           <!-- add product type -->
                           <li class="nav-item">
                              <a href="javascript:void(0);" class="nav-link" data-url="{{ route('admin.add.product') }}">
                                 <i class="nav-icon far fa-circle"></i>
                                 <p>
                                    Product
                                 </p>
                              </a>
                           </li>
                           <li class="nav-item">
                              <a href="javascript:void(0);" class="nav-link" data-url="{{ route('admin.product.type') }}">
                                 <i class="nav-icon far fa-circle"></i>
                                 <p>
                                    Product Categories
                                 </p>
                              </a>
                           </li>
                           <!-- add product brand -->
                           <li class="nav-item">
                              <a href="javascript:void(0);" class="nav-link" data-url="{{ route('admin.product.brand') }}">
                                 <i class="nav-icon far fa-circle"></i>
                                 <p>
                                    Product Sub Categories
                                 </p>
                              </a>
                           </li>
                           <!-- <li class="nav-item">
                              <a href="javascript:void(0);" class="nav-link" data-url="{{ route('admin.product.itemtype') }}">
                                 <i class="nav-icon fas fa-plus"></i>
                                 <p>
                                    Add Item Type
                                 </p>
                              </a>  
                           </li> -->
                        </ul>
                     </li>
                     <li class="nav-item">
                        <a href="javascript:void(0);" class="nav-link" data-url="not_reload">
                           <i class="nav-icon fa fa-industry"></i>
                           <p>
                              Products Management
                              <i class="right fas fa-angle-left"></i>
                           </p>
                        </a>
                        <ul class="nav nav-treeview" id='products'>
                           @foreach($products as $product)
                           <li class="nav-item">
                              <a href="javascript:void(0);" class="nav-link" data-url="{{ route('admin.show.items') }}" data-type='{{$product->name}}'>
                                 <i class="nav-icon far fa-circle"></i>
                                 <p>{{$product->name}}</p>
                              </a>
                           </li>
                           @endforeach
                        </ul>
                     </li>
                     <li class="nav-item">
                        <a href="javascript:void(0);" class="nav-link" data-url="not_reload">
                           <i class="nav-icon fas fa-swatchbook"></i>
                           <p>
                              Page Contents
                              <i class="right fas fa-angle-left"></i>
                           </p>
                        </a>
                        <ul class="nav nav-treeview" id='page_contents'>
                           <!-- Sliders Li -->
                           <li class="nav-item">
                              <a href="javascript:void(0);" class="nav-link" data-url="{{ route('admin.show.banners') }}" >
                                 <i class="nav-icon far fa-circle"></i>
                                 <p>Main Banner</p>
                              </a>
                           </li>
                           <!-- Small Bannerer Li -->
                           <li class="nav-item">
                              <a href="javascript:void(0);" class="nav-link" data-url="{{ route('admin.show.small.banners') }}" >
                                 <i class="nav-icon far fa-circle"></i>
                                 <p>Small Banners</p>
                              </a>
                           </li>
                           <!-- Services -->
                           <li class="nav-item">
                              <a href="javascript:void(0);" class="nav-link" data-url="{{ route('admin.show.service.banner') }}" >
                                 <i class="nav-icon far fa-circle"></i>
                                 <p>Service Banners</p>
                              </a>
                           </li>
                        </ul>
                     </li>
                     <!-- <li class="nav-item">
                        <a href="javascript:void(0);" class="nav-link" data-url="{{ route('admin.site.setting') }}" data-request="GET">
                           <i class="nav-icon fas fa-tachometer-alt"></i>
                           <p>
                              Site Setting
                           </p>
                        </a>
                     </li> -->
                     <li class="nav-item">
                        <a href="javascript:void(0);" class="nav-link" data-url="{{ route('admin.site.setting') }}" data-request="GET">
                           <i class="nav-icon fas fa fa-braille"></i>
                           <p>
                              App Settings
                           </p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="javascript:void(0);" class="nav-link" data-url="{{ route('admin.contact.us') }}" data-request="GET">
                           <i class="nav-icon fas fa-id-card"></i>
                           <p>
                              Contact Us
                           </p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="javascript:void(0);" class="nav-link" data-url="{{ route('admin.show.delivery.process') }}" data-request="GET">
                           <i class="nav-icon fas fa-truck"></i>
                           <p>
                              Delivery Processes
                           </p>
                        </a>
                     </li>
                     <!-- <li class="nav-item">
                        <a href="javascript:void(0);" class="nav-link" data-url="{{ route('admin.our.partners') }}" data-request="GET">
                           <i class="nav-icon fas fa-tachometer-alt"></i>
                           <p>
                              Partners Management
                           </p>
                        </a>
                     </li> -->
                     <li class="nav-item">
                        <a href="javascript:void(0);" class="nav-link" data-url="{{ route('admin.show.users') }}" data-request="GET">
                           <i class="nav-icon fas fa-users-cog"></i>
                           <p>
                              All Users
                           </p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="javascript:void(0);" class="nav-link" data-url="{{ route('admin.show.payments') }}" data-request="GET">
                           <i class="nav-icon fas fa-euro-sign"></i>
                           <p>
                              Payments
                           </p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="javascript:void(0);" class="nav-link" data-url="{{ route('admin.change.password') }}" data-request="GET">
                           <i class="nav-icon fas fa-lock"></i>
                           <p>
                              Change Password
                           </p>
                        </a>
                     </li>
                     <!-- <li class="nav-item">-->
                     <!--   <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="nav-icon fas fa-user"></i>{{ __('Logout') }}</a>-->
                     <!--    <form id="logout-form" action="{{ route('admin.logout') }}" method="GET" class="d-none">-->
                     <!--       @csrf-->
                     <!--    </form>-->
                     <!--   </a>-->
                     <!--</li>-->
                  </ul>
               </nav>
               <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
         </aside>
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
               <div class="container-fluid">
                  <div class="row mb-2">
                     <div class="col-sm-6">
                        <h1 class="m-0">Admin Panel</h1>
                     </div>
                     <!-- /.col -->
                     <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                           <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
                              <li class="breadcrumb-item active">Dashboard</li> -->
                        </ol>
                     </div>
                     <!-- /.col -->
                  </div>
                  <!-- /.row -->
               </div>
               <!-- /.container-fluid -->
            </div>
            <!-- Main content -->
            <section class="content">
               <div class="container-fluid">
                  <!-- Small boxes (Stat box) -->
                  <div class="row">
                     <div class="col-lg-4 col-6" id="orders">
                        <!-- small box -->
                        <div class="small-box bg-info">
                           <div class="inner">
                              <h3>{{ count($payments) }}</h3>
                              <p>Orders</p>
                           </div>
                           <div class="icon">
                              <i class="ion ion-bag"></i>
                           </div>
                           <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                     </div>
                     <!-- ./col -->
                     <div class="col-lg-4 col-6" id="users">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                           <div class="inner">
                              <h3>{{ count($users) }}</h3>
                              <p>User Registrations</p>
                           </div>
                           <div class="icon">
                              <i class="ion ion-person-add"></i>
                           </div>
                           <a href="javascript.void(0);" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                     </div>
                     <!-- ./col -->
                     <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                           <div class="inner">
                              <h3>{{ count($visits) }}</h3>
                              <p>Visitors</p>
                           </div>
                           <div class="icon">
                              <i class="ion ion-pie-graph"></i>
                           </div>
                           <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                     </div>
                     <!-- ./col -->
                  </div>
                  <!-- /.row -->
                  <!-- Main row -->
                  <div class="row">
                     @yield('adminContent')
                  </div>
                  <!-- /.row (main row) -->
               </div>
               <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
         </div>
         <!-- /.content-wrapper -->
         <footer class="main-footer">
            <strong>Copyright &copy; 2020-2020 <a href="/">{{ config('app.name') }}</a>.</strong>
            {{ config('app.name') }}
            <div class="float-right d-none d-sm-inline-block">
            </div>
         </footer>
      </div>
      <!-- ./wrapper -->
      <script src="{{ asset('public/adminLTE/plugins/jquery/jquery.min.js') }}"></script>
      <script src="{{ asset('public/adminLTE/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
      <script>
         $.widget.bridge('uibutton', $.ui.button)
      </script>
      <script src="{{ asset('public/adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('public/adminLTE/plugins/chart.js/Chart.min.js') }}"></script>
      <script src="{{ asset('public/adminLTE/plugins/sparklines/sparkline.js') }}"></script>
      <script src="{{ asset('public/adminLTE/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
      <script src="{{ asset('public/adminLTE/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
      <script src="{{ asset('public/adminLTE/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
      <script src="{{ asset('public/adminLTE/plugins/moment/moment.min.js') }}"></script>
      <script src="{{ asset('public/adminLTE/plugins/daterangepicker/daterangepicker.js') }}"></script>
      <script src="{{ asset('public/adminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
      <script src="{{ asset('public/adminLTE/plugins/summernote/summernote-bs4.min.js') }}"></script>
      <script src="{{ asset('public/adminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
      <script src="{{ asset('public/adminLTE/dist/js/adminlte.js') }}"></script>
      <script src="{{ asset('public/adminLTE/dist/js/demo.js') }}"></script>
      <script src="{{ asset('public/adminLTE/dist/js/pages/dashboard.js') }}"></script>
      <script src="{{ asset('public/adminLTE/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
      <script src="{{ asset('public/adminLTE/plugins/toastr/toastr.min.js') }}"></script>
      <script src="{{ asset('public/js/app.js') }}"></script>
      <script src="{{ asset('public/js/script.js') }}"></script>
      <script src="{{ asset('public/adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('public/adminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
      <script src="{{ asset('public/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
      <script src="{{ asset('public/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
      <script src="{{ asset('public/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
      <script src="{{ asset('public/adminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
      <script src="{{ asset('public/adminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
      <script src="{{ asset('public/adminLTE/plugins/jszip/jszip.min.js') }}"></script>
      <script src="{{ asset('public/adminLTE/plugins/pdfmake/pdfmake.min.js') }}"></script>
      <script src="{{ asset('public/adminLTE/plugins/pdfmake/vfs_fonts.js') }}"></script>
      <script src="{{ asset('public/adminLTE/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
      <script src="{{ asset('public/adminLTE/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
      <script src="{{ asset('public/adminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
      <script src="{{ asset('public/adminLTE/plugins/select2/js/select2.full.min.js') }}"></script>
      @yield('scripts')
      <script>
         setTimeout(function(){
            document.getElementById('spinner').classList.add('d-none')
            document.querySelector('.wrapper').classList.remove("d-none"); 
         }, 1000);
      </script>
   </body>
</html>