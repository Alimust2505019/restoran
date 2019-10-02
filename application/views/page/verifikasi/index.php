<?php if (!$data_pembayaran): ?>
	<center>
		<h5>Data tidak ditemukan</h5>
	</center>
	<?php else: ?>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default card-view">
				<table class="table">					
					<tr>
						<th>No</th><th>Tanggal Bayar</th><th>Nama Pelanggan</th><th>Bukti Pembayaran</th><th>Total Bayar</th><th>Status</th><th>Aksi</th>
					</tr>
					<?php $i=0; foreach ($data_pembayaran as $data): $i++; ?>
					<tr>
						<td hidden name="id_pelanggan" id="<?=$data->id_pelanggan?>"></td>
						<td><?=$i?></td>
						<td><?=$data->tanggal_bayar?></td>
						<td><?=$data->nama?></td>
						<td>
							<?=$data->bukti_pembayaran?>
							<a class="btn btn-xs btn-success" href="#" onclick="detail('<?=$data->bukti_pembayaran?>')" data-toggle="modal" data-target=".bs-example-modal-sm">
								<span class="fa fa-eye"></span>
							</a>
						</td>
						<td><?=$data->total_bayar?></td>
						<td><?=$data->status?></td>						
						<td>
							<?php if ($data->status=='Pending' || $data->status=='Ditolak'): ?>
								<span data-toggle="modal" data-target="#responsive-modal">
									<a href="#" onclick="edit('<?=$data->id_tagihan?>','<?=$data->status?>')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ubah Status" class="btn btn-primary">
										<span class="fa fa-edit"></span>
									</a>
								</span>
							<?php endif ?>
						</td>
					</tr>					
					<?php endforeach ?>
				</table>
			</div>
		</div>
	</div>
<?php endif ?>
<div id="responsive-modal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; padding-right: 17px;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h5 class="modal-title">Edit</h5>
			</div>
			<div class="modal-body">
				<form action="<?=base_url('verifikasi/ubah')?>" method="POST" id="form-edit">					
					<div class="form-group">
						<label class="control-label mb-10 text-left">Status</label>
						<select class="form-control" name="status" id="edit-status">
							<option value="Pending">Pending</option>
							<option value="Ditolak">Ditolak</option>
							<option value="Lunas">Lunas</option>
						</select>
						<div class="help-block with-errors" id="error">
						</div>
					</div>
					<input type="hidden" name="id_tagihan" id="edit-id_tagihan">
					<button type="submit" class="btn cur-p btn-primary">Edit</button>
					<button type="button" onclick="closeModal()" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>			
			</form>
		</div>
	</div>
</div>
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h5 class="modal-title" id="mySmallModalLabel"></h5>
			</div>
			<div class="modal-body">
				<center>
					<img id="gambar" width="100%" height="100%">
				</center>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<script type="text/javascript">
	function edit(id_tagihan,status) {
		$('#edit-status').val(status);
		$('#edit-id_tagihan').val(id_tagihan);
	}
	function detail(bukti_pembayaran) {
		$('#gambar').attr("src","<?=base_url('assets/bukti_pembayaran/')?>" + bukti_pembayaran);		
	}
</script>