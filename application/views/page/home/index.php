<h2>Selamat Datang <?=ucfirst($this->session->userdata('user_nama'))?></h2>
<br>
<h4>Dashboard</h4>
<br>
<!-- Row -->
<div class="row">
	<div class="col-lg-8 col-md-6 col-xs-12">
		<div class="panel panel-default card-view panel-refresh">
			<div class="refresh-container">
				<div class="la-anim-1"></div>
			</div>
			<div class="panel-heading">
				<div class="pull-left">
					<h6 class="panel-title txt-dark">Daftar Tagihan</h6>
				</div>
				<div class="pull-right">					
					</a>
					<a href="#" class="pull-left inline-block full-screen mr-15">
						<i class="zmdi zmdi-fullscreen"></i>
					</a>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-wrapper collapse in">
				<div class="panel-body row pa-0">
					<div class="table-wrap">
						<div class="table-responsive">
							<table id="datable_1" class="table  display table-hover border-none">
								<thead>
									<tr>
										<th>#Invoice</th>
										<th>Deksripsi</th>
										<th>Jumlah Tagihan</th>
										<th>Status</th>
										<th>Tanggal Bayar</th>										
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($data_tagihan as $data): ?>
									<?php @$penggunaan=$this->db->select('tanggal_bayar')->where('id_tagihan',$data->id_tagihan)->get('pembayaran')->row();;?>
									<tr>
										<td>#<?=$data->id_pelanggan?><?=$data->id_tagihan?><?=$data->id_penggunaan?></td>
										<td>Tagihan Bulan <?=$bulan[$data->bulan]?> <?=$data->tahun?></td>
										<td>Rp <?=number_format($data->jumlah_tagihan + 1500)?></td>
										<td>
											<?php if ($data->status == 'Belum Bayar'): ?>
												<span class="label label-danger">Belum Bayar</span>
											<?php endif ?>
											<?php if ($data->status == 'Lunas'): ?>
												<span class="label label-success">Lunas</span>
											<?php endif ?>
											<?php if ($data->status == 'Ditolak'): ?>
												<span class="label label-warning">Ditolak</span>
											<?php endif ?>											
											<?php if ($data->status == 'Pending'): ?>
												<span class="label label-primary">Pending</span>
											<?php endif ?>											
										</td>
										<td>											
											<?php if (@$penggunaan->tanggal_bayar): ?>
												<?=@$penggunaan->tanggal_bayar?>
											<?php else: ?>-<?php endif ?>
										</td>										
										<td>
											<?php if ($data->status == 'Belum Bayar'): ?>
												<a href="#" onclick="upload('<?=$data->id_tagihan?>')"  data-toggle="modal" data-target="#modalUpload">
													<i class="fa fa-file" data-toggle="tooltip" data-placement="top" title="" data-original-title="Upload Bukti" aria-hidden="true"></i>
												</a>
											<?php endif ?>
											<?php if ($data->status == 'Lunas'): ?>
												<a href="#" onclick="detail('<?=$data->id_tagihan?>')">
													<i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="" data-original-title="Detail" aria-hidden="true"></i>
												</a>
											<?php endif ?>
											<?php if ($data->status == 'Ditolak'): ?>
												<a href="#" onclick="upload('<?=$data->id_tagihan?>')"  data-toggle="modal" data-target="#modalUpload">
													<i class="fa fa-file" data-toggle="tooltip" data-placement="top" title="" data-original-title="Upload Bukti" aria-hidden="true"></i>
												</a>
											<?php endif ?>			
										</td>
									</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>	
				</div>	
			</div>
		</div>
	</div>
	<div class="col-lg-4 col-md-6 col-xs-12">
		<div class="panel panel-default border-panel card-view">
			<div class="panel-heading">
				<div class="pull-left">
					<h6 class="panel-title txt-dark">recent activity</h6>
				</div>
				<a class="txt-danger pull-right right-float-sub-text inline-block" href="javascript:void(0)"> clear all </a>
				<div class="clearfix"></div>
			</div>
			<div class="panel-wrapper task-panel collapse in">
				<div class="panel-body row pa-0">
					<div class="list-group mb-0">
						<a href="#" class="list-group-item">
							<span class="badge transparent-badge badge-info capitalize-font">just now</span>
							<i class="zmdi zmdi-calendar-check pull-left"></i><p class="pull-left">Calendar updated</p>
							<div class="clearfix"></div>
						</a>
						<a href="#" class="list-group-item">
							<span class="badge transparent-badge badge-success capitalize-font">4 min</span>
							<i class="zmdi zmdi-comment-alert pull-left"></i><p class=" pull-left">Commented on a post</p>
							<div class="clearfix"></div>
						</a>
						<a href="#" class="list-group-item">
							<span class="badge transparent-badge badge-warning capitalize-font">23 min </span>
							<i class="zmdi zmdi-truck pull-left"></i><p class=" pull-left">Order 392 shipped</p>
							<div class="clearfix"></div>
						</a>
						<a href="#" class="list-group-item">
							<span class="badge transparent-badge badge-success capitalize-font">46 min</span>
							<i class="zmdi zmdi-money pull-left"></i><p class=" pull-left">Invoice 653 has been paid</p>
							<div class="clearfix"></div>
						</a>
						<a href="#" class="list-group-item">
							<span class="badge transparent-badge badge-danger capitalize-font">1 hr</span>
							<i class="zmdi zmdi-account pull-left"></i><p class="pull-left">A new user has been added</p>
							<div class="clearfix"></div>
						</a>
						<a href="#" class="list-group-item">
							<span class="badge transparent-badge badge-warning capitalize-font">just now</span>
							<i class="zmdi zmdi-picture-in-picture pull-left"></i><p class=" pull-left">Finance report has been released</p>
							<div class="clearfix"></div>
						</a>
						<a href="#" class="list-group-item">
							<span class="badge transparent-badge badge-success capitalize-font">1 hr</span>
							<i class="zmdi zmdi-device-hub pull-left"></i><p class="pull-left">Web server hardware updated</p>
							<div class="clearfix"></div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="modalUpload" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; padding-right: 17px;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h5 class="modal-title">Edit</h5>
			</div>
			<div class="modal-body">
				<form action="<?=base_url('home/add')?>" enctype="multipart/form-data" method="POST" id="form-upload" >
					<div class="form-group">
						<label class="control-label mb-10" for="exampleInputuname_1">Upload Bukti Pembayaran</label><br>
						<input type="file" name="file" id="input-file" class="form-control" accept="image/x-png,image/jpeg,image/jpg"">
						<label>.jpg | .png maks 2mb</label>
						<div class="help-block with-errors" id="error">
						<span id="false"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label mb-10" for="exampleInputuname_1">Tanggal Bayar</label><br>
						<input type="date" name="tanggal_bayar" id="input-tanggal_bayar" class="form-control">
						<div class="help-block with-errors" id="error">
						<span id="false"></span>
						</div>
					</div>
					<input type="hidden" name="id_tagihan" id="input-id_tagihan">
					<button type="submit" class="btn cur-p btn-danger">Simpan</button>
					<button type="button" onclick="closeModal()" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
				<div class="modal-footer">
				</div>
			</form>
		</div>
	</div>
</div>
<!-- /Row -->
<script type="text/javascript">
	function upload(id_tagihan) {
		$('#input-id_tagihan').val(id_tagihan);
	}
</script>