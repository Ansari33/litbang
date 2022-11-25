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
			<div class="tab-content" id="page_content">
{{--               <div class="row">--}}
{{--                   <div class="col-4">--}}
{{--                       <!--begin::Card-->--}}
{{--                       <div class="card card-bordered">--}}
{{--                           <div class="card-header ribbon ribbon-top ribbon-vertical">--}}
{{--                               <div class="ribbon-label bg-danger">--}}
{{--                                   OK!--}}
{{--                               </div>--}}
{{--                               <div class="card-title">Ribbon Example</div>--}}
{{--                           </div>--}}
{{--                           <div class="card-body">--}}
{{--                               ...--}}
{{--                           </div>--}}
{{--                       </div>--}}
{{--                       <!--end::Card-->--}}
{{--                   </div>--}}
{{--                   <div class="col-4">--}}
{{--                       <!--begin::Card-->--}}
{{--                       <div class="card borcard-borderedder">--}}
{{--                           <div class="card-header ribbon ribbon-top ribbon-vertical">--}}
{{--                               <div class="ribbon-label bg-success">--}}
{{--                                   <i class="bi bi-heart-fill fs-2 text-white"></i>--}}
{{--                               </div>--}}
{{--                               <div class="card-title">Ribbon Example</div>--}}
{{--                           </div>--}}
{{--                           <div class="card-body">--}}
{{--                               ...--}}
{{--                           </div>--}}
{{--                       </div>--}}
{{--                       <!--end::Card-->--}}
{{--                   </div>--}}
{{--                   <div class="col-4">--}}
{{--                       <div class="card card-bordered">--}}
{{--                           <div class="card-header">--}}
{{--                               <h3 class="card-title">Title</h3>--}}
{{--                               <div class="card-toolbar">--}}
{{--                                   <button type="button" class="btn btn-sm btn-light">--}}
{{--                                       Action--}}
{{--                                   </button>--}}
{{--                               </div>--}}
{{--                           </div>--}}
{{--                           <div class="card-body">--}}
{{--                               Lorem Ipsum is simply dummy text...--}}
{{--                           </div>--}}
{{--                           <div class="card-footer">--}}
{{--                               Footer--}}
{{--                           </div>--}}
{{--                       </div>--}}
{{--                   </div>--}}

{{--               </div>--}}

            </div>
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
