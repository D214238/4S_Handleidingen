@extends('layouts.default')

@section('breadcrumb')
	<li><a href="/{{ $brand->id }}/{{ $brand->name_url_encoded }}/" alt="Manuals for '{{$brand->name}}'" title="Manuals for '{{$brand->name}}'">{{ $brand->name }}</a></li>
@stop

@section('content')
<div class="container-type-list">
	<h1 class="brand-name-title">{{ $brand->name }}</h1>

	<p class="brand-manual-discription">{{ __('introduction_texts.type_list', ['brand'=>$brand->name]) }}</p>

	<?php
        $size = count($types);
        $columns = 3;
        $chunk_size = ceil($size / $columns);
    ?>

    <div class="container">
		<div class="row">
			@foreach($types->chunk($chunk_size) as $chunk)
			<div class="col-md-4">
				<ul>
					@foreach($chunk as $type)
					<li>
						<a href="/{{ $brand->id }}/{{ $brand->name_url_encoded }}/{{ $type->id }}/{{ $type->name_url_encoded }}/">{{ $type->name }}</a>
					</li>
					@endforeach
				</ul>
			</div>
			@endforeach
		</div>
	</div>
</div>
@stop