<div class="row">
	<div class="col-md-4">
		<div class="panel panel-default card-view">
			<h4><u>Form Tambah Data</u></h4><br>
			<form action="<?=base_url('tarif/add')?>" method="post" id="form-add">
				<div class="form-group">
					<label class="control-label mb-10 text-left">Daya</label>
					<input type="text" class="form-control" id="input-daya" placeholder="450"  name="daya">
					<div class="help-block with-errors" id="error">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label mb-10" for="exampleInputuname_1">Per/KWH</label>
					<div class="input-group">
						<div class="input-group-addon">Rp.</div>
						<input type="text" class="form-control" id="input-perkwh"  placeholder="1500" name="perkwh">
					</div>
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
					<th>No</th><th>Daya</th><th>Per/KWH</th><th>Aksi</th>
				</tr>
				<?php $i=0; foreach ($dataAll as $data): $i++; ?>
				<tr>
					<td hidden name="id_tarif" id="<?=$data->id_tarif?>"></td>
					<td><?=$i?></td>
					<td><?=$data->daya?></td>
					<td>Rp <?=$data->perkwh?></td>
					<td>
						<a href="#" onclick="edit('<?=$data->id_tarif?>')" data-toggle="modal" data-target="#responsive-modal" class="btn btn-primary"><span class="fa fa-pencil"></span></a>						
						<a href="<?=base_url('tarif/delete/'.$data->id_tarif)?>" class="btn btn-danger remove"><span class="fa fa-trash"></span></a>
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
				<form action="<?=base_url('tarif/ubah')?>" method="POST" id="form-edit">					
					<div class="form-group">
						<label class="control-label mb-10 text-left">Daya</label>
						<input type="text" class="form-control" id="edit-daya" placeholder="450"  name="daya">
						<div class="help-block with-errors" id="error">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label mb-10" for="exampleInputuname_1">Per/KWH</label>
						<div class="input-group">
							<div class="input-group-addon">Rp.</div>
							<input type="text" class="form-control" id="edit-perkwh"  placeholder="1500" name="perkwh">
						</div>
						<div class="help-block with-errors" id="error">
						</div>
						<input type="hidden" name="id_tarif" class="form-control" id="edit-id_tarif">
					</div>
					<button type="submit" class="btn cur-p btn-primary">Edit</button>
					<button type="button" onclick="closeModal()" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>			
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
  function edit(id) {
    $.ajax({
      type:"post",
      url:"<?=base_url()?>tarif/edit_data/"+id,
      dataType:"json",
      success:function (detail) {		
      	$("#edit-id_tarif").val(id);
        $("#edit-daya").val(detail.daya);
        $("#edit-perkwh").val(detail.perkwh);
    }
});
}
	function closeModal() {
		$('#form-edit input').parents('.form-group').removeClass('has-error has-danger').addClass('has-success');		
		$('#form-edit input').parents('.form-group').find('#error').html(" ");		
  	}
</script>