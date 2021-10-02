@extends('layouts.default')

@section('head')
<meta name="robots" content="index, nofollow">
@stop

@section('breadcrumb')
	<li><a href="/{{ $brand->id }}/{{ $brand->name_url_encoded }}/" alt="Manuals for '{{$brand->name}}'" title="Manuals for '{{$brand->name}}'">{{ $brand->name }}</a></li>
	<li><a href="/{{ $brand->id }}/{{ $brand->name_url_encoded }}/{{ $type->id }}/{{ $type->name_url_encoded }}/" alt="Manuals for '{{$brand->name}} {{ $type->name }}'" title="Manuals for '{{$brand->name}} {{ $type->name }}'">{{ $type->name }}</a></li>
@stop

@section('content')

<div class="container-manuals">
	<h1 class="brand-type-name-title">{{ $brand->name }} - {{ $type->name }}</h1>

	<p class="type-discription">{{ __('introduction_texts.type_list', ['brand'=>$brand->name, 'type'=>$type->name]) }}</p>

	<div class="container-manual-buttons d-flex flex-wrap">
		@foreach ($manuals as $manual)

			@if ($manual->locally_available)
				<a class="manual-link btn" href="/{{ $brand->id }}/{{ $brand->name_url_encoded }}/{{ $type->id }}/{{ $type->name_url_encoded }}/{{ $manual->id }}/" alt="{{ __('misc.view_manual_alt') }}" title="{{ __('misc.view_manual_alt') }}"><div class="filename">{{ $manual->filename }}</div><div class="view-manual"><i class="fas fa-book-open"></i>{{ __('misc.view_manual') }}</div></a> 
				({{$manual->filesize_human_readable}})
			@else
				<a class="manual-link btn" href="/{{ $brand->id }}/{{ $brand->name_url_encoded }}/{{ $type->id }}/{{ $type->name_url_encoded }}/{{ $manual->id }}" target="new" alt="{{ __('misc.download_manual_alt') }}" title="{{ __('misc.download_manual_alt') }}"><div class="filename">{{ $manual->filename }}</div><div class="view-manual"><i class="fas fa-download"></i>{{ __('misc.download_manual') }}</div></a>
			@endif

			<br />
		@endforeach
	</div>
</div>
@stop