<div class="row">
	<div class="col-md-4">
		<div class="panel panel-default card-view">
			<h4><u>Form Tambah Data</u></h4><br>
			<form action="<?=base_url('admin/add')?>" method="post" id="form-add">
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
					<label class="control-label mb-10 text-left">Nama Admin</label>
					<input type="text" class="form-control" id="input-nama_admin" placeholder="Nama Admin"  name="nama_admin">
					<div class="help-block with-errors" id="error">
					</div>
				</div>				
				<div class="form-group">
					<label class="control-label mb-10" for="exampleInputuname_1">Level</label>					
					<select name="id_level" id="input-id_level" class="form-control">
						<option value="" style="display:none;">Pilih Level</option>
						<?php foreach ($data_level as $level): ?>
							<option value="<?=$level->id_level?>"><?=$level->nama_level?></option>
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
					<th>No</th><th>Username</th><th>Nama Admin</th><th>Level</th>
				</tr>
				<?php $i=0; foreach ($dataAll as $data): $i++; ?>
				<tr>
					<td hidden name="id_admin" id="<?=$data->id_admin?>"></td>
					<td><?=$i?></td>
					<td><?=$data->username?></td>
					<td><?=$data->nama_admin?></td>
					<td><?=$data->nama_level?></td>					
					<td>
						<?php if ($this->session->userdata('user_id_admin')!==$data->id_admin): ?>
							<a href="#" onclick="edit('<?=$data->id_admin?>')" data-toggle="modal" data-target="#responsive-modal" class="btn btn-primary"><span class="fa fa-pencil"></span></a>
							<a href="<?=base_url('admin/delete/'.$data->id_admin)?>" class="btn btn-danger remove"><span class="fa fa-trash"></span></a>
						<?php endif ?>
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
				<form action="<?=base_url('admin/ubah')?>" method="POST" id="form-edit">					
					<div class="form-group">
						<label class="control-label mb-10 text-left">Username</label>
						<input type="text" class="form-control" id="edit-username" placeholder="Username"  name="username">
						<div class="help-block with-errors" id="error">
						</div>
					</div>					
					<div class="form-group">
						<label class="control-label mb-10 text-left">Nama Admin</label>
						<input type="text" class="form-control" id="edit-nama_admin" placeholder="Nama Admin"  name="nama_admin">
						<div class="help-block with-errors" id="error">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label mb-10" for="exampleInputuname_1">Level</label>					
						<select name="id_level" id="edit-id_level" class="form-control" readonly>
							<option value="" style="display:none;">Pilih Level</option>
							<?php foreach ($data_level as $level): ?>
								<option value="<?=$level->id_level?>"><?=$level->nama_level?></option>
							<?php endforeach ?>
						</select>
						<div class="help-block with-errors" id="error">
						</div>
					</div>
					<input type="hidden" name="id_admin" id="edit-id_admin">
					<button type="submit" class="btn cur-p btn-danger">Simpan</button>
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
			url:"<?=base_url()?>admin/edit_data/"+id,
			dataType:"json",
			success:function (detail) {		
				console.log(detail);
				$("#edit-id_admin").val(id);				
				$("#edit-username").val(detail.username);	
				$("#edit-nama_admin").val(detail.nama_admin);							
				$("#edit-id_level").val(detail.id_level);
			}
		});
	}

	function closeModal() {
		$('#form-edit input').parents('.form-group').removeClass('has-error has-danger').addClass('has-success');		
		$('#form-edit input').parents('.form-group').find('#error').html(" ");		
	}
</script>