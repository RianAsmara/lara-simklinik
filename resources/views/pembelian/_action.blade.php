{!! Form::model($model, ['url' => $form_url, 'method' => 'delete', 'class' => 'form-inline js-confirm', 'data-confirm' => $confirm_message]) !!}

<button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#myModal{{$id_pemeblian}}">Detail</button>

|<a href="{{ $edit_url }}" class="btn btn-sm btn-success">Ubah</a> |


{!! Form::submit('Hapus',['class'=>'btn btn-sm btn-danger js-confirm']) !!}
{!! Form::close() !!}

<!-- MODAL PILIH PRODUK -->
  <div class="modal " id="myModal{{$id_pemeblian}}" role="dialog" data-backdrop="">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Detail Produk</h4>
        </div>
        <div class="modal-body"> 
        <div class="responsive">
           <table class="table table-bordered"> 
            <thead>
                <tr>
                  <th>No Faktur</th>
                  <th>Produk</th>
                  <th>Jumlah Produk</th>
                </tr>
            </thead>
            <tbody> 
                  @foreach($data_detail_pemeblian as $data_detail_pemeblians)
                <tr>
                  <td>{{  $data_detail_pemeblians->no_faktur }}</td>
                  <td>{{  $data_detail_pemeblians->produk->nama_produk }}</td>
                  <td>{{  $data_detail_pemeblians->jumlah_produk }}</td>  
                </tr>
                  @endforeach
            </tbody>
          </table>
        </div>  
        </div>  
        </div>
      </div>
      
    </div>
  </div>
<!-- / MODAL PILIH PRODUK -->
