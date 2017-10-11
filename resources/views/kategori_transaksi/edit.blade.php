@extends('layouts.app')

@section('content')

		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }} ">Home</a></li>
					<li><a href="{{ url('/kategori_transaksi') }}">kategori transaksi</a></li>
					<li class="active">Edit kategori transaksi</li>
				</ul>

		 <div class="card">
			   	   <div class="card-header card-header-icon" data-background-color="purple">
                       <i class="material-icons">account_circle</i>
                                </div>
                      <div class="card-content">
                         <h4 class="card-title"> kategori transaksi </h4>
                      
						{!! Form::model($kategori_transaksi, ['url' => route('kategori_transaksi.update', $kategori_transaksi->id), 'method' => 'put', 'files'=>'true','class'=>'form-horizontal']) !!}
							@include('kategori_transaksi._form')
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
@endsection
	