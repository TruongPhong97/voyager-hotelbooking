<ul class="navbar-nav m-auto">

	@php
		$items = $items->load('translations');
	@endphp

	@foreach( $items as $menu_item )

		<li class="nav-item">			

			<a class="nav-link
					  @if(count($menu_item->children)){{'dropdown-toggle'}}@endif
					  @if( Request::is($menu_item->link()) ){{'active'}}@endif
					 "
			   href="{{ $menu_item->link() }}">

				{{ $menu_item->getTranslatedAttribute('title', $options->locale) }}

				@if(count($menu_item->children))
					<i class="bx bx-chevron-down"></i>
				@endif

			</a>

			@if(count($menu_item->children))

				<ul class="dropdown-menu">

					@foreach($menu_item->children as $child)

						<li class="nav-item">
							<a href="{{ $child->link() }}">
								{{ $child->title }}
							</a>
						</li>

					@endforeach

				</ul>

			@endif
			
		</li>
		
	@endforeach
		
	<li class="nav-item language-nav">
		<a class="nav-link">Languege <i class="bx bx-chevron-down"></i></a>
		<ul class="dropdown-menu">

			@php
				$langCodeDefault = config('voyager.multilingual.default');
				$langCodeList = config('voyager.multilingual.locales');
				$langCodeList = array_diff( $langCodeList, array($langCodeDefault) );
			@endphp

			@if(app()->getLocale() == $langCodeDefault)					
				
				<li>
					<a>{{$langCodeDefault}}</a>
				</li>

				@foreach ($langCodeList as $locale)
					<li>
						<a href="{{ url( '/' . $locale . '/' . Request::path() ) }}">
							{{$locale}}
						</a>
					</li>
				@endforeach
				
			@else				

				<li>
					<a href="{{ url(str_replace(Request::segment(1), '', Request::path())) }}">
						{{$langCodeDefault}}
					</a>
				</li>

				@foreach ($langCodeList as $locale)
					<li>
						<a @if( app()->getLocale() != $locale ) href="{{ url(str_replace(Request::segment(1), $locale, Request::path())) }}" @endif>
							{{$locale}}
						</a>
					</li>
				@endforeach

			@endif

		</ul>
	</li>

</ul>