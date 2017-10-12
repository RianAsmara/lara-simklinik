@extends('layouts.app')

@section('content')

		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }} ">Home</a></li>
					<li><a href="{{ url('/kas_mutasi') }}">kas mutasi</a></li>
					<li class="active">Edit kas mutasi</li>
				</ul>

		 <div class="card">
			   	   <div class="card-header card-header-icon" data-background-color="purple">
                       <i class="material-icons">account_circle</i>
                                </div>
                      <div class="card-content">
                         <h4 class="card-title"> kas mutasi </h4>
                      
						{!! Form::model($kas_mutasi, ['url' => route('kas_mutasi.update', $kas_mutasi->id), 'method' => 'put', 'files'=>'true','class'=>'form-horizontal']) !!}
							@include('kas_mutasi._form')
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
@endsection
	