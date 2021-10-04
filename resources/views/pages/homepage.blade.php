@extends('layouts.default')

@section('introduction_text')
    <p class="introduction-text"><strong>{{ __('introduction_texts.homepage_line_1') }}</strong></p>
    <p class="introduction-text"><strong>{{ __('introduction_texts.homepage_line_2') }}</strong></p>
    <p class="introduction-text"><strong>{{ __('introduction_texts.homepage_line_3') }}</strong></p>
@endsection

@section('popular')
<?php
use App\Models\Manual;
$visible_limit = 10;
$columns = 2;
$chunk_size = ceil($visible_limit / $columns);
$pop_manuals = Manual::orderBy('clicks', 'desc')->limit($visible_limit)->get();
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
                        <li><a class="pop-manual-link d-inline-block" href="/{{ $manual->brand->id }}/{{ $manual->brand->name_url_encoded }}/{{ $manual->type->id }}/{{ $manual->type->name_url_encoded }}/{{ $manual->id }}" target="new">{{ $manual->brand->name }} : {{ $manual->type->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</div>
@endsection

@section('content')
    <div class="container-brands">
        <h1 class="all-brands-title">
            @section('title')
                {{ __('misc.all_brands') }}
            @show
        </h1>


        <?php
        $size = count($brands);
        $columns = 3;
        $chunk_size = ceil($size / $columns);
        ?>

        <div class="container">
            <!-- Example row of columns -->
            <div class="row">

                @foreach($brands->chunk($chunk_size) as $chunk)
                    <div class="col-md-4">

                        <ul>
                            @foreach($chunk as $brand)

                                <?php
                                $current_first_letter = strtoupper(substr($brand->name, 0, 1));

                                if (!isset($header_first_letter) || (isset($header_first_letter) && $current_first_letter != $header_first_letter)) {
                                    echo '</ul>
	    					<h2>' . $current_first_letter . '</h2>
	    					<ul>';
                                }
                                $header_first_letter = $current_first_letter
                                ?>

                                <li>
                                    <a class="brand-link" href="/{{ $brand->id }}/{{ $brand->name_url_encoded }}/">{{ $brand->name }}</a>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                    <?php
                    unset($header_first_letter);
                    ?>
                @endforeach

            </div>

        </div>
    </div>                            
@endsection
