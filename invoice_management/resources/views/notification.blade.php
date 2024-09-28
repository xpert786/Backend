@extends('layouts.app')

@section('content')
<!-- Main content area -->
<main role="main" class="content ml-sm-auto px-4">

  <div class="container-fluid">
    <div class="title pt-3 mb-4 d-inline-block">
      <h1>Notifications</h1>
    </div>

    <div class="notification-wrapper ">
      {{-- <div class="header-wrapper d-flex justify-content-between">
                  <div class="left d-flex align-items-center justify-content-center">
                    <h3 class="bolder">Notifications</h3>
                    <h6 class="ms-3 rounded-2">2</h6>
                  </div>
                  <div class="right">
                <span class="read-all">Mark all as read</span>
                  </div>
                </div> --}}


      <div class="notifications">
        
        @foreach($notifications as $notification)
        @php
        $notificationData = json_decode($notification->data);
        @endphp
        <div class="row  align-items-center  single-notification">
        @if ($notification->type === 'App\Notifications\UnpaidNotification')
          <a href="{{ route('invoice.view', ['id' => json_decode($notification->data)->offer_id]) }}?notification={{ $notification->id }}" class="d-flex text-decoration-none">
          @elseif ($notification->type === 'App\Notifications\DocumentNotification')
          <a href="{{ route('sharedToAdmin') }}" class="d-flex text-decoration-none">
          @endif
            <!-- <div class="col-sm-1 col-3 pt-3">
              <img src="{{ asset('public/images/avatar.png') }}" class="img-fluid avatar3 rounded-circle " alt="profile-img">
            </div> -->

            <div class="col-12 col-md-10 p-4 unread">
              <h6>{{ $notificationData->name }}</h6>
              <div class="d-flex align-items-center justify-content-between">
                <p>{{ $notificationData->body }}</p>
                <span class="time justify-content-end">{{ \Carbon\Carbon::parse($notification->created_at)->format('Y-m-d') }}
                 <p class="time-p"> {{ \Carbon\Carbon::parse($notification->created_at)->format('H:i:s') }}<p></span>
              </div>
            </div>

          </a>
        </div>
        @endforeach

      </div>
    </div>
    <div class="col-10 text-center notifi-link-pagination">
    {{ $notifications->links() }}
    </div>
  </div>
</main>
@endsection