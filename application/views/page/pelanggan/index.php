<div class="row">
	<div class="col-md-4">
		<div class="panel panel-default card-view">
			<h4><u>Form Tambah Data</u></h4><br>
			<form action="<?=base_url('pelanggan/add')?>" method="post" id="form-add">
				<div class="form-group">
					<label class="control-label mb-10 text-left">No Meter</label>
					<input type="text" class="form-control" id="input-no_meter" placeholder="12312321"  name="no_meter">
					<div class="help-block with-errors" id="error">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label mb-10 text-left">Nama</label>
					<input type="text" class="form-control" id="input-nama" placeholder="Irfan Hakim"  name="nama">
					<div class="help-block with-errors" id="error">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label mb-10 text-left">Username</label>
					<input type="text" class="form-control" id="input-username" placeholder="Username"  name="username">
					<div class="help-block with-errors" id="error">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label mb-10 text-left">Password</label>
					<input type="password" class="form-control" id="input-password" placeholder="Password"  name="password">
					<div class="help-block with-errors" id="error">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label mb-10" for="exampleInputuname_1">Alamat</label>					
					<textarea cols="2" rows="3" class="form-control" id="input-alamat" placeholder="Perum Springhill Garden Jl.Seroja 11 A Malang"  name="alamat"></textarea>
					<div class="help-block with-errors" id="error">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label mb-10" for="exampleInputuname_1">Daya</label>					
					<select name="id_tarif" id="input-id_tarif" class="form-control">
						<option value="" style="display:none;">Pilih Daya</option>
						<?php foreach ($data_tarif as $tarif): ?>
							<option value="<?=$tarif->id_tarif?>"><?=$tarif->daya?></option>
						<?php endforeach ?>
					</select>
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
					<th>No</th><th>Daya</th><th>No Meter</th><th>Nama</th><th>Username</th><th>Alamat</th><th>Aksi</th>
				</tr>
				<?php $i=0; foreach ($dataAll as $data): $i++; ?>
				<tr>
					<td hidden name="id_pelanggan" id="<?=$data->id_pelanggan?>"></td>
					<td><?=$i?></td>
					<td><?=$data->daya?></td>
					<td><?=$data->no_meter?></td>
					<td><?=$data->nama?></td>
					<td><?=$data->username?></td>
					<td><?=mb_strimwidth($data->alamat,0,20, '...')?></td>
					<td>
						<a href="#" onclick="edit('<?=$data->id_pelanggan?>')" data-toggle="modal" data-target="#responsive-modal" class="btn btn-primary"><span class="fa fa-pencil"></span></a>						
						<a href="<?=base_url('pelanggan/delete/'.$data->id_pelanggan)?>" class="btn btn-danger remove"><span class="fa fa-trash"></span></a>
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
				<form action="<?=base_url('pelanggan/ubah')?>" method="POST" id="form-edit">					
					
					<div class="form-group">
						<label class="control-label mb-10 text-left">No Meter</label>
						<input type="text" class="form-control" id="edit-no_meter" placeholder="12312321"  name="no_meter">
						<div class="help-block with-errors" id="error">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label mb-10 text-left">Nama</label>
						<input type="text" class="form-control" id="edit-nama" placeholder="Irfan Hakim"  name="nama">
						<div class="help-block with-errors" id="error">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label mb-10 text-left">Username</label>
						<input type="text" class="form-control" id="edit-username" placeholder="Username"  name="username">
						<div class="help-block with-errors" id="error">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label mb-10" for="exampleInputuname_1">Alamat</label>					
						<textarea cols="2" rows="3" class="form-control" id="edit-alamat" placeholder="Perum Springhill Garden Jl.Seroja 11 A Malang"  name="alamat"></textarea>
						<div class="help-block with-errors" id="error">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label mb-10" for="exampleInputuname_1">Daya</label>					
						<select name="id_tarif" id="edit-id_tarif" class="form-control">							
							<?php foreach ($data_tarif as $tarif): ?>
								<option value="<?=$tarif->id_tarif?>"><?=$tarif->daya?></option>
							<?php endforeach ?>
						</select>
						<div class="help-block with-errors" id="error">
						</div>
					</div>
					<input type="hidden" name="id_pelanggan" id="edit-id_pelanggan">
					<button type="submit"  class="btn cur-p btn-danger">Simpan</button>
					<button type="button" onclick="closeModal()" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
				<div class="modal-footer">
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	function edit(id) {
		$.ajax({
			type:"post",
			url:"<?=base_url()?>pelanggan/edit_data/"+id,
			dataType:"json",
			success:function (detail) {		
				console.log(detail);
				$("#edit-id_pelanggan").val(id);
				$("#edit-no_meter").val(detail.no_meter);
				$("#edit-nama").val(detail.nama);
				$("#edit-username").val(detail.username);				
				$("#edit-alamat").val(detail.alamat);
				$("#edit-id_tarif").val(detail.id_tarif);
			}
		});
	}

	function closeModal() {
		$('#form-edit input').parents('.form-group').removeClass('has-error has-danger').addClass('has-success');		
		$('#form-edit input').parents('.form-group').find('#error').html(" ");		
	}
</script>