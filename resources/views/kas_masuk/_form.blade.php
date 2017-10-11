<div class="form-group{{ $errors->has('kas') ? ' has-error' : '' }}">
	{!! Form::label('kas', 'Kas', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::select('kas', [''=>'']+App\Kas::pluck('nama_kas','id')->all(),null, ['class'=>'form-control js-selectize-reguler', 'placeholder' => ' Kas']) !!}
		{!! $errors->first('kas', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group{{ $errors->has('kategori') ? ' has-error' : '' }}">
	{!! Form::label('kategori', 'Kategori Transaksi', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::select('kategori', [''=>'']+App\KategoriTransaksi::pluck('nama_kategori_transaksi','id')->all(),null, ['class'=>'form-control js-selectize-reguler', 'placeholder' => ' Kategori Transaksi']) !!}
		{!! $errors->first('kategori', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group{{ $errors->has('jumlah') ? ' has-error' : '' }}">
	{!! Form::label('jumlah', 'Jumlah', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('jumlah', null, ['class'=>'form-control','required','autocomplete'=>'off', 'placeholder' => 'Jumlah ']) !!}
		{!! $errors->first('jumlah', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group{{ $errors->has('keterangan') ? ' has-error' : '' }}">
	{!! Form::label('keterangan', 'Keterangan', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('keterangan', null, ['class'=>'form-control','required','autocomplete'=>'off', 'placeholder' => 'Keterangan ']) !!}
		{!! $errors->first('keterangan', '<p class="help-block">:message</p>') !!}
	</div>
</div>

{!! Form::hidden('no_faktur', null, null) !!}


<div class="form-group">
	<div class="col-md-4 col-md-offset-2">
		{!! Form::button('<i class="material-icons">save</i>Simpan', ['class'=>'btn btn-primary','type'=>'submit']) !!}

	</div>
</div>
