@extends('layouts.master')

@section('page_title'){{ trans('nearby-platform.business_cards') }} - {{ config()->get('system.premium_name') }} @stop
@section('meta_description') @stop

@section('content')

  <section>
    <div class="content text-dark" style="background-image: url('{{ url('assets/images/backgrounds/triangles.jpg') }}');">
      <div class="content-overlay" style="background-color:rgba(245,249,250,0.9)">
        <div class="container">
          <div class="row">
            <div class="col-md-8">
              <h1 class="mb-0">{{ trans('nearby-platform.business_cards') }} ({{ $cards->total() }})</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section>
    <div class="breadcrumbs breadcrumbs-arrow breadcrumbs-light mb-0" style="background-image:url()">
      <div class="breadcrumbs-overlay" style="background-color:#ddd">
        <div class="container">
          <div class="breadcrumbs-padding">
            <div class="row">
              <div class="col-12 col-md-6">

                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ url('') }}"><div>{{ trans('nearby-platform.home') }}</div></a></li>
                  <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><div>{{ trans('nearby-platform.dashboard') }}</div></a></li>
                  <li class="breadcrumb-item active"><a href="javascript:void(0);"><div>{{ trans('nearby-platform.business_cards') }}</div></a></li>
                </ol>

              </div>
              <div class="col-12 col-md-6 text-left text-md-right mt-2 mt-md-0">

                <a href="{{ url('dashboard/business-cards/add') }}" class="btn rounded-0 text-white btn-success"><i class="mi add"></i> {{ trans('nearby-platform.add_business_card') }}</a>

              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="container">

    <section>
      <div class="content mb-0" style="">
        <div class="content-overlay" style="background-color:rgba(255,255,255,1)">
          <div class="row">
            <div class="col-12">

              @if(session()->has('message'))
                <div class="alert alert-success mb-4 rounded-0">
                  {{ session()->get('message') }}
                </div>
              @endif

              <table class="table table-hover table-striped mdl-shadow--2dp mb-0">
                <thead class="thead-dark">
                  <tr>
                    <th>{{ trans('nearby-platform.business_card') }}</th>
                    <th class="d-none d-lg-table-cell"><a href="?sortby=created_at&order={{ $order }}" class="link text-white">{{ trans('nearby-platform.created') }}</a></th>
                    <th class="text-center" width="130">{{ trans('nearby-platform.last_30_days') }}</th>
                    <th class="text-center d-none d-lg-table-cell">{{ trans('nearby-platform.total_views') }}</th>
                    <th width="165" class="text-center">{{ trans('nearby-platform.actions') }}</th>
                  </tr>
                </thead>
                <tbody>
<?php
$i = 0;
foreach ($cards as $card) {
  $sl = \App\Http\Controllers\Core\Secure::array2string(['card_id' => $card->id]);

  $favicon = 'favicons/card-' . \App\Http\Controllers\Core\Secure::staticHash($card->id) . '.ico';
  $favicon = (\File::exists(public_path($favicon))) ? url($favicon) : null;

  $metrics = \DB::table('metrics')->select(['count as views', 'data->fired_at as dates'])->where('type', \App\Metrics\CardViewCountMetrics::class)->where('metricable_id', $card->id)->first();
  $views = (isset($metrics->views)) ? $metrics->views : 0;
  $dates = (isset($metrics->dates)) ? json_decode($metrics->dates) : [];

  $aDays = [];
  $dDay = new \Carbon\Carbon('29 days ago');

  for ($day = 0; $day < 30; $day++) {
    $aDays[$day] = 0;
    foreach ($dates as $date) {
      $dDate = new \Carbon\Carbon($date);
      if ($dDate->format('Y-m-d') == $dDay->format('Y-m-d')) {
        $aDays[$day]++;
      }
    }
    $dDay->addDay();
  }
?>
                  <tr>
                    <td class="align-middle">
                      <div class="row align-items-center">
<?php if ($favicon != null) { ?>
                      <div class="col d-none d-lg-block" style="max-width: 34px">
                        <img src="{{ $favicon }}?{{ $card->updated_at->timestamp }}" style="width: 24px; height: 24px">
                      </div>
<?php } ?>
                      <div class="col">
                        {{ $card->name . ' - ' . $card->title }}
                      </div>
                    </td>
                    <td class="align-middle d-none d-lg-table-cell">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $card->created_at, \Auth::user()->timezone)->diffForHumans() }}</td>
                    <td class="text-center align-middle"><span class="line"><span style="display: none">{{ implode(',', $aDays) }}</span></span></td>
                    <td class="text-center align-middle d-none d-lg-table-cell">{{ $views }}</td>
                    <td class="text-center align-middle">

                      <div class="btn-group btn-group-sm" role="group">
                        <a href="{{ url('dashboard/business-cards/edit/' . $sl) }}" class="btn btn-sm btn-primary rounded-0 mr-2" data-toggle="tooltip" title="{{ trans('nearby-platform.edit') }}"><i class="mi mode_edit"></i></a> 

                        <a href="javascript:void(0);" data-sl="{{ $sl }}" class="btn btn-sm btn-danger rounded-0 btn-delete-card mr-2" data-toggle="tooltip" title="{{ trans('nearby-platform.delete') }}"><i class="mi delete"></i></a>

                        <a href="{{ url('card/' . \App\Http\Controllers\Core\Secure::staticHash($card->id)) }}" class="btn btn-sm btn-info rounded-0 mr-2" target="_blank" data-toggle="tooltip" title="{{ trans('nearby-platform.view') }}"><i class="mi search"></i></a>

                        <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.13/clipboard.min.js"></script>
                        <script type='text/javascript'>
                         var clipboard = new Clipboard('.btn');
                        </script>
                        <button class="btn btn-sm btn-info rounded-0 mr-2" data-toggle="tooltip" title="{{ trans('nearby-platform.copy_to_clipboard') }}" data-clipboard-text="{{ url('card/' . \App\Http\Controllers\Core\Secure::staticHash($card->id)) }}"><i class="fas fa-external-link-alt"></i></button> 



                        <span data-toggle="modal" data-target="#modalViewQR{{ $i }}"><a href="javascript:void(0);" data-toggle="tooltip" class="btn btn-sm btn-info rounded-0" title="{{ trans('nearby-platform.qr') }}"><i class="fas fa-qrcode" aria-hidden="true"></i></a>
                      </span>
                      </div>
                    </td>
                  </tr>
<?php
  $i++;
}
?>
                </tbody>
              </table>

              {!! $links !!}

            </div>
          </div>
        </div>
      </div>
    </section>

<?php
$i = 0;
foreach ($cards as $card) {
  $sl = \App\Http\Controllers\Core\Secure::array2string(['card_id' => $card->id]);
?>
    <div class="modal" id="modalViewQR{{ $i }}" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content rounded-0 mdl-shadow--8dp border border-white">
            <div class="modal-header">
              <h5 class="modal-title">{{ $card->name . ' - ' . $card->title }}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="{{ trans('nearby-platform.close') }}">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <img src="<?php echo \Cache::rememberForever('qr-' . md5($card->getUrl()), function() use($card) { return DNS2D::getBarcodePNGPath($card->getUrl(), 'QRCODE', 10, 10, [0,0,0]); }); ?>" alt="barcode" style="width:100%;">
              <div class="m-0 mt-3 form-group"><input type="text" class="form-control rounded-0" value="{{ $card->getUrl() }}"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn rounded-0 btn-secondary" data-dismiss="modal">{{ trans('nearby-platform.close') }}</button>
            </div>
        </div>
      </div>
    </div>
<?php
  $i++;
}
?>

</div>
@endsection

@section('page_bottom')

<script>
  $(function() {
    $('.line').peity('line', { fill: '#99caff', stroke: '#007bff', width: '100%', height: 24 });

    $('.btn-delete-card').on('click', function() {
      var sl = $(this).attr('data-sl');

      swal({
        title: "{{ trans('nearby-platform.are_you_sure') }}",
        type: "warning",
        showCancelButton: true,
        cancelButtonText: "{{ trans('nearby-platform.cancel') }}",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "{{ trans('nearby-platform.yes_delete') }}"
      }).then(function(result) {
        if (result.value) {
          blockUI();

          var jqxhr = $.ajax({
            url: "{{ url('dashboard/business-cards/delete') }}",
            data: {sl: sl,  _token: '<?= csrf_token() ?>'},
            method: 'POST'
          })
          .done(function(data) {
            if(data.success === true) {
              document.location.reload();
            } else {
              swal(data.msg);
            }
          })
          .fail(function() {
            console.log('error');
          })
          .always(function() {
            unblockUI();
          });
        }
      }, function (dismiss) {});
    });

  });
</script>
@stop