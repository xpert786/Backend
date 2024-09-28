<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MEDIA GALLERY</title>
    <link rel="icon" href="{{asset('public/images/fav-td.ico')}}" type="image/x-icon">
    <!-- Fonts -->
    {{-- <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/dash.css') }}">
        <link rel="stylesheet" href="{{ asset('public/css/notification.css') }}">


    <!-- dataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.1/css/dataTables.dataTables.css" />

       <script src="https://cdn.ckeditor.com/ckeditor5/41.2.0/classic/ckeditor.js"></script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="main-wrapper">
        <div class="sidebar">
            <div class="logo-bx">
                <ul>
                    <li class="menu-btn">
                        <div class="collapseToggle d-flex">
                            <span id="toggleIcon" class="fa fa-bars pe-4"></span>
                            <span class="logo-img">
                                <a href="#" class="long-logo">
                                    <img src="{{ asset('public/images/logo3.png') }}" alt="logo" width="122px">

                                </a>
                                {{-- <a href="#" class=" show-short-logo">
                                    <img src="{{ asset('public/images/short-logo.png') }}" alt="logo">
                                  </a> --}}
                            </span>
                        </div>
                    </li>
                </ul>
            </div>
            <ul class="menu-bx Navbar-nav d-flex ">
                <li class="top-space nav-item ">
                    <a href="#" class="nav-link" aria-current="page">
                        <img src="{{ asset('public/images/DASHBOARD.png') }}" alt="icon" class="icon pe-3">
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <img src="{{ asset('public/images/DOCUMENTS.png') }}" alt="icon" class="icon pe-3">
                        <span>Document</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="" class="nav-link">
                        <img src="{{ asset('public/images/CUSTOMER.png') }}" alt="icon" class="icon pe-3">
                        <span>Customer</span>
                    </a>
                </li>
                @if(Auth::user()->role == "customer")
                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <img src="{{ asset('public/images/Vector invoice.png') }}" alt="icon" class="icon pe-3">
                        <span>Invoice</span>
                    </a>
                </li>
                @endif
                <li class="nav-item }">
                    <a href="#" class="nav-link">
                        <img src="{{ asset('public/images/chat.png') }}" alt="icon" class="icon pe-3">
                        <span>Chat</span>
                    </a>
                </li>
                @if (Auth::user()->role == 'customer')
                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <img src="{{ asset('public/images/note1.png') }}" alt="icon" class="icon pe-3">
                        <span>Paid Message</span>
                    </a>
                </li>
                @endif
                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <img src="{{ asset('public/images/notification-1.png') }}" alt="icon" class="icon pe-3">
                        <span>Notification</span>
                    </a>
                </li>
                @if (Auth::user()->role == 'customer')
                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <img src="{{ asset('public/images/reminder-email.png') }}" alt="icon" class="icon pe-3">
                        <span>Reminders</span>
                    </a>
                </li>
                @endif
                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <img src="{{ asset('public/images/PROFILE.png') }}" alt="icon" class="icon pe-3">
                        <span>Profile</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <img src="{{ asset('public/images/SETTING.png') }}" alt="icon" class="icon pe-3">
                        <span>Settings</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Header -->
        <section class="home-section">
            <header class="navbar">

                <div class="hed-user">
                    <ul class="navg">

                        <li class="ps-2">
                            <div class="notification">
                                <!-- <a href="#"> -->
                                    <div class="notBtn" href="#">
                                        <!--Number supports double digits and automatically hides itself when there is nothing between divs -->
                                        <div class="dropdown">
                                            <a class="dropdown-toggle" href="#" role="button" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-bell"></i>
                                                <div class="number">{{ Auth::user()->unreadNotifications->count() }}</div>
                                                <!-- Display count of unread notifications -->
                                            </a>
                                            @if (Auth::user()->unreadNotifications->count() > 0)
                                            <ul class="dropdown-menu dropdown-menu-end chat-notification" aria-labelledby="notificationDropdown">
                                                @foreach (Auth::user()->unreadNotifications->take(3) as $notification)

                                                <li>
                                                    <div class="sec new notification-item" data-notification-id="{{ $notification->id }}" data-notification-redirect="{{ $notification->type == 'App\Notifications\UnpaidNotification' ? route('notification') : ($notification->type == 'App\Notifications\DocumentNotification' ? route('document') : route('contact')) }}">

                                                        <div class="txt">{{ $notification->data['name'] }}
                                                            <br>{{ $notification->data['body'] }}
                                                            <i class="fa-solid fa-xmark d-flex justify-content-end" id="remove-notification" notification-id="{{ $notification->id }}"></i>
                                                        </div>

                                                    </div>
                                                </li>
                                                @endforeach
                                                @if (Auth::user()->unreadNotifications->count() > 3)
                                                <li class="fixed-view-all">
                                                    <a href="#" class="dropdown-item view">
                                                        View All

                                                    </a>
                                                </li>
                                                @endif
                                            </ul>
                                            @endif
                                        </div>
                                    </div>
                                <!-- </a> -->
                            </div>
                        </li>
                        <li class="dropdown px-2 user">
                            <a href="#" data-bs-toggle="dropdown" aria-expanded="false" class="">
                                @if (Auth::user()->profile_image)
                                <img src="{{ asset('storage/app/public/profileimage/' . Auth::user()->profile_image) }}" alt="avatar" class="avatar rounded-circle img-fluid"> Hi,
                                {{ Auth::user()->name }}
                                @else
                                <img src="{{ asset('public/images/avatar.png') }}" alt="avatar" class=" avatar rounded-circle img-fluid"> Hi,
                                {{ Auth::user()->name }}
                                @endif
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('profile-info') }}"><i class="fa-regular fa-user pe-2"></i> Profile</a>
                                </li>

                                <li class="user-logout">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="logout-link">
                                            <i class="fa-solid fa-power-off me-2"></i>
                                            {{ __('Log Out') }}
                                        </a>
                                    </form>
                                </li>


                                {{-- <li class="d-flex"><i class="fa-solid fa-power-off log-out"></i>
                                    
                                    <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-responsive-nav-link>
                                </form>

                        </li> --}}

                    </ul>
                    </li>
                    </ul>
                </div>

            </header>
            @yield('content')
        </section>
    </div>


    {{-- @include('layouts.navigation ') --}}

    <!-- Page Heading -->
    <!-- {{-- @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
    </div>
    </header>
    @endif --}} -->

    <!-- Page Content -->

    </div>



    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- search in selectbox -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>
    <!-- search in selectbox -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>

              <script>
        $(document).ready(function() {
            // Click event handler for notification items
            $('.notification-item').click(function(e) {
                e.preventDefault(); // Prevent default link behavior

                // Get notification ID from data attribute
                var notificationId = $(this).data('notification-id');
                var notificationUrl = $(this).data('notification-redirect');

                // AJAX call to mark notification as read and remove it from the list
                $.ajax({
                    url: "{{ route('mark-notification-read') }}",
                    type: 'POST',
                    data: {
                        id: notificationId,
                        '_token': "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        // Remove the clicked notification item from the list
                        $('.notification-item[data-notification-id="' + notificationId + '"]')
                            .remove();

                        // Update the notification count displayed
                        var newCount = parseInt($('.number').text()) - 1;
                        $('.number').text(newCount);

                        // Optionally, you can redirect the user to the notification URL
                        // window.location.href = response.notificationUrl;
                        window.location.href = notificationUrl;
                    },
                    error: function(xhr, status, error) {
                        console.error(error); // Log any errors to the console
                    }
                });
            });
        });
    </script>


    @yield('footer')
</body>

</html>