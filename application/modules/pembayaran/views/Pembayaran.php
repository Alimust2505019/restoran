<div class="row">
	<div class="col-md-4">
		<div class="panel panel-default card-view">
			<h4><u>Form Tambah Data</u></h4><br>
			<form action="<?=base_url('pesanan/add')?>" method="post" id="form-add">
				<div class="form-group">
					
					<input type="hidden" class="form-control" id="input-kode_pesanan" placeholder="Ayam goreng"  name="kode_pesanan"  value="<?php echo $kode_pesanan; ?>">
					<div class="help-block with-errors" id="error">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label mb-10 text-left">nama</label>
					<input type="text" class="form-control" id="input-nama" placeholder="Ayam goreng"  name="nama">
					<div class="help-block with-errors" id="error">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label mb-10 text-left">meja</label>
					<input type="text" class="form-control" id="input-meja" placeholder="A12"  name="meja">
					<div class="help-block with-errors" id="error">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label mb-10 text-left">jumlah</label>
					<input type="text" class="form-control" id="input-jumlah" placeholder="676"  name="jumlah">
					<div class="help-block with-errors" id="error">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label mb-10" for="exampleInputuname_1">Menu</label>					
					<select name="id_menu" id="input-id_menu" class="form-control">
						<option value="" style="display:none;">Pilih Menu</option>
						<?php foreach ($data_menu as $menu): ?>
							<option value="<?=$menu->id_menu?>"><?=$menu->nama_menu?></option>
						<?php endforeach ?>
					</select>
				</div>

				<div class="form-group">
					
					<input type="hidden" class="form-control" id="input-date"   name="date" value="<?php  echo date('d-m-Y / H:i'); ?>">
					<div class="help-block with-errors" id="error">
					</div>
				</div>
				
				
				<div class="form-group">				
					<div class="input-group">
						<button type="submit" class="btn cur-p btn-primary">Tambah</button>
					</div>
				</div>
				
			</form>
			<br>
		</div>
	</div>	
	<div class="col-md-8">
		<div class="panel panel-default card-view">
			<table class="table">
				<tr>
					<th>No</th><th>Kode Pesanan</th><th>Nama</th><th>Meja</th><th>Jumlah</th><th>Menu</th><th>Tanggal Pesan</th><th>Aksi</th>
				</tr>
				<?php $i=0; foreach ($dataAll as $data): $i++; ?>
				<tr>
					<td hidden name="id_pesanan" id="<?=$data->id_pesanan?>"></td>
					
					<td><?=$i?></td>
					<td><?=$data->kode_pesanan?></td>
					<td><?=$data->nama?></td>
                    <td> <?=$data->meja?></td>
					<td> <?=$data->jumlah?></td>
                    <td><?=$data->nama_menu?></td>
					<td><?=$data->date?></td>
                    
				
					<td>
						<a href="#" onclick="edit('<?=$data->id_pesanan?>')" data-toggle="modal" data-target="#responsive-modal" class="btn btn-primary"><span class="fa fa-pencil"></span></a>						
						<a href="<?=base_url('pesanan/delete/'.$data->id_pesanan)?>" class="btn btn-danger remove"><span class="fa fa-trash"></span></a>
					</td>
				</tr>
			<?php endforeach ?>
		</table>
	</div>
</div>
</div>
<div id="responsive-modal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; padding-right: 17px;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h5 class="modal-title">Edit</h5>
			</div>
			<div class="modal-body">
				<form action="<?=base_url('pesanan/ubah')?>" method="POST" id="form-edit">					
				
				<div class="form-group">
					<label class="control-label mb-10 text-left">Nama</label>
					<input type="text" class="form-control" id="edit-nama" placeholder="Ayam goreng"  name="nama">
					<div class="help-block with-errors" id="error">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label mb-10 text-left">Meja</label>
					<input type="text" class="form-control" id="edit-meja" placeholder="A12"  name="meja">
					<div class="help-block with-errors" id="error">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label mb-10 text-left">Jumlah</label>
					<input type="text" class="form-control" id="edit-jumlah" placeholder="676"  name="jumlah">
					<div class="help-block with-errors" id="error">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label mb-10" for="exampleInputuname_1">Menu</label>					
					<select name="id_menu" id="edit-id_menu" class="form-control">
						
						<?php foreach ($data_menu as $menu): ?>
							<option value="<?=$menu->id_menu?>"><?=$menu->nama_menu?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="form-group">
					
					<input type="hidden" class="form-control" id="edit-date"   name="date" value="<?php  echo date('d-m-Y'); ?>">
					<div class="help-block with-errors" id="error">
					</div>
				</div>
				<input type="hidden" name="id_pesanan" id="edit-id_pesanan">

					<button type="submit" class="btn cur-p btn-primary">Edit</button>
					<button type="button" onclick="closeModal()" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				<div class="modal-footer">
				</div>
			</div>			
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
  function edit(id) {
    $.ajax({
      type:"post",
      url:"<?=base_url()?>pesanan/edit_data/"+id,
      dataType:"json",
      success:function (detail) {
		console.log(detail);		
      	
		$("#edit-id_pesanan").val(id);
        $("#edit-nama").val(detail.nama);
        $("#edit-meja").val(detail.meja);
		$("#edit-jumlah").val(detail.jumlah);

        $("#edit-id_menu").val(detail.id_menu);
		$("#edit-date").val(detail.date);
        
    }
});
}
	function closeModal() {
		$('#form-edit input').parents('.form-group').removeClass('has-error has-danger').addClass('has-success');		
		$('#form-edit input').parents('.form-group').find('#error').html(" ");		
  	}
</script>