@extends('admin.layouts.app')
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap pl-0">
			<div class="col-md-12 pr-5 mr-2">
				<ul class="nav nav-light-primary nav-pills tabs-unlimited" id="menu_tab" role="tablist"></ul>
			</div>
		</div>
	</div>
	<div class="d-flex flex-column-fluid">
		<div class="container-fluid">
			<div class="tab-content" id="page_content"></div>
		</div>
	</div>
</div>
@endsection
@push('js')
	<script>
		$(function () {

      $('#menu_tab').scrollingTabs({
        bootstrapVersion: 4,
        enableSwiping: true,
        cssClassLeftArrow: 'fa fa-chevron-left',
        cssClassRightArrow: 'fa fa-chevron-right',
        scrollToTabEdge: true,
        handleDelayedScrollbar: true,
        scrollToActiveTab: true
      });
      //add_page('dashboard','dashboard','Dashboard');
    })
	</script>
@endpush
