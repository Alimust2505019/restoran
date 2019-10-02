<h4>Nama : <?=$nama?>, Daya : <?=$daya?> kwh</h4><br>
	<a href="<?=base_url('penggunaan')?>" class="btn btn-primary mb-20">Kembali</a>
<?php if (!$detail): ?>
	<center>
		<h5>Data tidak ditemukan</h5>
	</center>
	<?php else: ?>
	<div class="row">
		<div class="col-md-10">
			<div class="panel panel-default card-view">
				<table class="table">					
					<tr>
						<th>No</th><th>Bulan</th><th>Tahun</th><th>Meter Awal, Meter Akhir</th><th>Penggunaan</th><th>Jumlah Tagihan</th><th>Status</th><th>Aksi</th>
					</tr>
					<?php $i=0; foreach ($detail as $data): $i++; ?>
					<tr>
						<td hidden name="id_pelanggan" id="<?=$data->id_pelanggan?>"></td>
						<td><?=$i?></td>
						<td><?=$bulan[$data->bulan]?></td>
						<td><?=$data->tahun?></td>
						<td><?=$data->meteran_awal?>, <?=$data->meteran_akhir?></td>
						<td><?=$data->meteran_akhir-$data->meteran_awal?></td>
						<td><?=$data->jumlah_tagihan?></td>
						<td><?=$data->status?></td>
						<td>
							<?php if ($data->status=='Belum Bayar'): ?>
								<form style="margin:0;padding:0;display: inline;" action="<?=base_url('penggunaan/delete')?>" method="POST">
									<input type="hidden" name="id_pelanggan" value="<?=$data->id_pelanggan?>">
									<input type="hidden" name="id_tagihan" value="<?=$data->id_tagihan?>">
									<input type="hidden" name="id_penggunaan" value="<?=$data->id_penggunaan?>">
									<button data-toggle="tooltip" data-placement="top" title="" data-original-title="Hapus Data" type="submit" class="btn btn-danger"><span class="fa fa-trash"></span></button>
								</form>
							<?php endif ?>
						</td>
					</tr>					
					<?php endforeach ?>
				</table>
			</div>
		</div>
	</div>
<?php endif ?>