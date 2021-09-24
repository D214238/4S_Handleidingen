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


		@foreach ($manuals as $manual)

			@if ($manual->locally_available)
				<a class="manual-link" href="/{{ $brand->id }}/{{ $brand->name_url_encoded }}/{{ $type->id }}/{{ $type->name_url_encoded }}/{{ $manual->id }}/" alt="{{ __('misc.view_manual_alt') }}" title="{{ __('misc.view_manual_alt') }}">{{ __('misc.view_manual') }}</a> 
				({{$manual->filesize_human_readable}})
			@else
				<a class="manual-link" href="{{ $manual->url }}" target="new" alt="{{ __('misc.download_manual_alt') }}" title="{{ __('misc.download_manual_alt') }}">{{ __('misc.download_manual') }}</a>
			@endif

			<br />
		@endforeach
</div>
@stop