<div class="row">
	<div class="col-md-10">
		<div class="panel panel-default card-view">
			<table class="table">
				<tr>
					<th>No</th><th>No Meter</th><th>Nama</th><th>Daya</th><th>Aksi</th>
				</tr>
				<?php $i=0; foreach ($data_pelanggan as $data): $i++; ?>
				<tr>
					<td hidden name="id_pelanggan" id="<?=$data->id_pelanggan?>"></td>
					<td><?=$i?></td>
					<td><?=$data->no_meter?></td>
					<td><?=$data->nama?></td>
					<td><?=$data->daya?></td>
					<td>
						<span data-toggle="modal" data-target="#responsive-modal">
							<a data-toggle="tooltip" data-placement="top" title="" data-original-title="Tambah Penggunaan"  href="#" onclick="create('<?=$data->id_pelanggan?>','<?=$data->nama?>')" class="btn btn-success"><span class="fa fa-plus"></span></a>
						</span>
						<form style="margin:0;padding:0;display: inline;" action="<?=base_url('penggunaan/detail')?>" method="POST">
							<input type="hidden" name="id_pelanggan" value="<?=$data->id_pelanggan?>">
							<button data-toggle="tooltip" data-placement="top" title="" data-original-title="Detail Penggunaan" type="submit" class="btn btn-primary"><span class="fa fa-eye"></span></button>
						</form>						
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
				<button onclick="closeModalSpecial()" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h5 class="modal-title">Tambah</h5>
			</div>
			<div class="modal-body">
				<form action="<?=base_url('penggunaan/add')?>" method="POST" id="form-add">					
					<div class="form-group">
						<label class="control-label mb-10 text-left">Nama</label>
						<input type="text" class="form-control" id="input-nama" placeholder="Irfan Hakim"  name="nama" readonly>
						<div class="help-block with-errors" id="error">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label mb-10 text-left">Bulan</label>						
						<select class="form-control" id="input-bulan" name="bulan">
						<option value="" style="display: none">Pilih Bulan</option>			
							<?php foreach ($bulan as $keys): ?>
								<option value="<?=$keys['id']?>"><?=$keys['bulan']?></option>
							<?php endforeach ?>
						</select>
						<div class="help-block with-errors" id="error">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label mb-10 text-left">Tahun</label>
						<select class="form-control" id="input-tahun" name="tahun">
						<option value="" style="display: none">Pilih Tahun</option>			
							<?php foreach ($tahun as $key): ?>
								<option value="<?=$key?>"><?=$key?></option>
							<?php endforeach ?>
						</select>
						<div class="help-block with-errors" id="error">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label mb-10 text-left">Meteran Awal - Meteran Akhir</label>						
						<div class="row">
							<div class="col-md-6">
								<input type="text" name="meteran_awal" id="input-meteran_awal" class="form-control" placeholder="Meteran Awal">
								<div class="help-block with-errors" id="error"></div>
							</div>
							<div class="col-md-6">
								<input type="text" name="meteran_akhir" id="input-meteran_akhir" class="form-control" placeholder="Meteran Akhir">
								<div class="help-block with-errors" id="error"></div>
							</div>
						</div>						
						<input type="hidden" name="id_pelanggan" id="input-id_pelanggan">
						<div class="help-block with-errors" id="false" style="color: red"></div>
						<button type="submit" class="btn btn-success">Simpan</button>
						<button type="button" onclick="closeModalSpecial()" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
			</div>
				</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	function create(id,nama) {
		$("#input-id_pelanggan").val(id);	
		$("#input-nama").val(nama);		
	}
	function closeModalSpecial() {		
		$('#form-add input').parents('.form-group').removeClass('has-error has-danger').addClass('');	
		$('#form-add select').parents('.form-group').removeClass('has-error has-danger').addClass('');	
		$('#form-add input').parents('.form-group').find('#error').html(" ");
		$('#form-add select').parents('.form-group').find('#error').html(" ");
		$('#false').html(" ");
	}
</script>

