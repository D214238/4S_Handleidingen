@extends('layouts.default')

@section('breadcrumb')
	<li><a href="/{{ $brand->id }}/{{ $brand->name_url_encoded }}/" alt="Manuals for '{{$brand->name}}'" title="Manuals for '{{$brand->name}}'">{{ $brand->name }}</a></li>
@stop

@section('popular')
<?php
$visible_limit = 5;
$columns = 2;
$chunk_size = ceil($visible_limit / $columns);
// $pop_manuals = $manuals->orderBy('clicks', 'desc')->limit($visible_limit)->get();
$pop_manuals = $manuals->sortByDesc('clicks')->slice(0, $visible_limit);
?>
<div class="container container-popular">
    <h1 class="popular-manuals-title">
        @section('title_popular')
            {{ __('misc.title_popular') }}
        @show
    </h1>

    <div class="row">
        @foreach($pop_manuals->chunk($chunk_size) as $chunk)
            <div class="col-md-6">
                <ul>
                    @foreach($chunk as $manual)
                        <li><a class="pop-manual-link d-inline-block" href="/{{ $manual->brand->id }}/{{ $manual->brand->name_url_encoded }}/{{ $manual->type->id }}/{{ $manual->type->name_url_encoded }}/{{ $manual->id }}" target="new">{{ $manual->type->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</div>
@endsection

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