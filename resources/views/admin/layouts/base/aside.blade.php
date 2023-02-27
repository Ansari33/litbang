@php
$menu = [
    [
      'name_id' => 1,
      'icon'    => 'fa fa-home',
      'label'   => 'Kelitbangan',
      'link'    => '/admin-kelitbangan',
      'children' => [],
    ],
    [
      'name_id' => 2,
      'icon'    => 'fa fa-star',
      'label'   => 'Inovasi',
      'link'    => '/admin-inovasi',
      'children' => [],
    ],
    [
      'name_id' => 3,
      'icon'    => 'fa fa-calendar',
      'label'   => 'Agenda',
      'link'    => '/admin-agenda',
      'children' => [],
    ],
    [
      'name_id' => 4,
      'icon'    => 'fa fa-info',
      'label'   => 'Berita',
      'link'    => '/admin-berita',
      'children' => [],
    ],
    [
      'name_id' => 4,
      'icon'    => 'fa fa-filter',
      'label'   => 'Kategori Informasi Publik',
      'link'    => '/admin-kategori-informasi-publik',
      'children' => [],
    ],
    [
      'name_id' => 4,
      'icon'    => 'fa fa-file-alt',
      'label'   => 'Informasi Publik',
      'link'    => '/admin-informasi-publik',
      'children' => [],
    ],
    [
      'name_id' => 5,
      'icon'    => 'fa fa-search-plus',
      'label'   => 'Usulan Penelitian',
      'link'    => '/admin-usulan-penelitian',
      'children' => [],
    ],
    [
      'name_id' => 6,
      'icon'    => 'fa fa-lightbulb',
      'label'   => 'Usulan Inovasi',
      'link'    => '/admin-usulan-inovasi',
      'children' => [],
    ],
    [
      'name_id' => 6,
      'icon'    => 'fa fa-th-large',
      'label'   => 'Jenis Layanan Incubator',
      'link'    => '/admin-jenis-layanan-incubator',
      'children' => [],
    ],
    [
      'name_id' => 6,
      'icon'    => 'fa fa-list-alt',
      'label'   => 'Layanan Incubator',
      'link'    => '/admin-layanan-incubator',
      'children' => [],
    ],
    [
      'name_id' => 7,
      'icon'    => 'fa fa-newspaper',
      'label'   => 'Survey',
      'link'    => '/redirect',
      'children' => [],
    ],
    [
      'name_id' => 8,
      'icon'    => 'far fa-envelope',
      'label'   => 'Arsip Surat',
      'link'    => '/admin-surat',
      'children' => [],
    ],
    [
      'name_id' => 9,
      'icon'    => 'fa fa-cog',
      'label'   => 'Regulasi',
      'link'    => '/admin-regulasi',
      'children' => [],
    ],
    [
      'name_id' => 10,
      'icon'    => 'fa fa-edit',
      'label'   => 'Surat Rekomendasi',
      'link'    => '/admin-surat-rekomendasi',
      'children' => [],
    ],
    [
      'name_id' => 10,
      'icon'    => 'fa fas fa-id-badge',
      'label'   => 'Profil',
      'link'    => '/admin-profil',
      'children' => [],
    ],
];
@endphp
<div class="aside aside-left  aside-fixed  d-flex flex-column flex-row-auto"  id="kt_aside">
	<div class="brand flex-column-auto " id="kt_brand">
		<div class="brand-logo">
            <a href="/"><img alt="Logo" src="{{ asset('images/litbang-min.ico') }}"/></a>

{{--            <h3 class="ml-2 mt-1" > E-litbang </h3>--}}
		</div>
		<button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
{{--			<i class="menu-icon fa fas fa-laptop"></i>--}}
			<span class="svg-icon svg-icon svg-icon-xl">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						<polygon points="0 0 24 0 24 24 0 24"/>
						<path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999) "/>
						<path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999) "/>
					</g>
				</svg>
			</span>
		</button>
	</div>
	<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
		<div id="kt_aside_menu" class="aside-menu my-4 " data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
			<ul class="menu-nav ">
				@foreach($menu as $key => $item)
					@if (count($item['children']))
						<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
							<a href="javascript:;" class="menu-link menu-toggle">
								<i class="menu-icon {{ $item['icon'] }}"></i>
								<span class="menu-text">{{ $item['label'] }}</span>
								<i class="menu-arrow"></i>
							</a>
							<div class="menu-submenu" kt-hidden-height="200" style="display: none; overflow: hidden;">
								<i class="menu-arrow"></i>
								<ul class="menu-subnav">
									@foreach($item['children'] as $children)
										<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
											<a href="javascript:;" class="menu-link" onclick="add_page('{{ $children['name_id'] }}','{{ $children['link'] }}','{{ $children['label'] }}')">
												<i class="menu-bullet menu-bullet-dot"><span></span></i>
												<span class="menu-text">{{ $children['label'] }}</span>
											</a>
										</li>
									@endforeach
								</ul>
							</div>
						</li>
					@else
						<li class="menu-item " aria-haspopup="true" >
							<a  href="{{ $item['link'] }}" class="menu-link" onclick="">
								<i class="menu-icon {{ $item['icon'] }}"></i>
								<span class="menu-text">{{ $item['label'] }}</span>
							</a>
						</li>
					@endif
				@endforeach

			</ul>
		</div>
	</div>
</div>
