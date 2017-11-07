@if (session()->has('flash_notification.message'))
<div class="col-md-12" style="margin: 10px 0 5px 0;">
  <div class="alert alert-{{ session()->get('flash_notification.level') }}">
    <button type="button" class="close" data-dismiss="alert" ariahidden="true">&times;</button>
    {!! session()->get('flash_notification.message') !!}
  </div>
</div>
@endif
