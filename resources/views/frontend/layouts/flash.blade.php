@if (session()->has('flash_notification.message'))
  <style media="screen">
    .alert-success { background: #12f99a; color: #f6f6f6; font-size: 14px; font-weight: 600; text-transform: uppercase; }
  </style>
  <div style="margin-top: 10px;">
    <div class="alert alert-{{ session()->get('flash_notification.level') }}">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      {!! session()->get('flash_notification.message') !!}
    </div>
  </div>
@endif
