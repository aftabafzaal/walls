@extends('front')

@section('content')



<div class="col-lg-9 col-md-9 main text-left">
            <div class="row">
              <div class="title">{{ $content->title }}</div>  
              <div class="col-lg-12 col-md-12 col-sm-12"> 
              {{ @strip_tags($content->body) }}
              </div>
            </div>
            
          </div>
						
				
@endsection