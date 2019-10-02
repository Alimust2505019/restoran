<div class="row">
	<div class="col-md-4">
		<div class="panel panel-default card-view">
			<h4><u>Form Tambah Data</u></h4><br>
			<form action="<?=base_url('menu/add')?>" method="post" id="form-add">
				<div class="form-group">
					<label class="control-label mb-10 text-left">Nama Menu</label>
					<input type="text" class="form-control" id="input-nama_menu" placeholder="Ayam goreng"  name="nama_menu">
					<div class="help-block with-errors" id="error">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label mb-10" for="exampleInputuname_1">Harga</label>
					<div class="input-group">
						<div class="input-group-addon">Rp.</div>
						<input type="text" class="form-control" id="input-harga"  placeholder="1500" name="harga">
					</div>
					<div class="help-block with-errors" id="error">
					</div>
				</div>
                <div class="form-group">
                    
                   
                    <input type="radio" id="input-status" name="status" value="ready"> Ready
                    <input type="radio"  id="input-status" name="status" value="kosong"> Kosong
								
						
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
					<th>No</th><th>Nama Menu</th><th>Harga</th><th>Status</th><th>Aksi</th>
				</tr>
				<?php $i=0; foreach ($dataAll as $data): $i++; ?>
				<tr>
					<td hidden name="id_menu" id="<?=$data->id_menu?>"></td>
					<td><?=$i?></td>
					<td><?=$data->nama_menu?></td>
                    <td>Rp <?=$data->harga?></td>
                    <td><?=$data->status?></td>
                    
				
					<td>
						<a href="#" onclick="edit('<?=$data->id_menu?>')" data-toggle="modal" data-target="#responsive-modal" class="btn btn-primary"><span class="fa fa-pencil"></span></a>						
						<a href="<?=base_url('menu/delete/'.$data->id_menu)?>" class="btn btn-danger remove"><span class="fa fa-trash"></span></a>
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
				<form action="<?=base_url('menu/ubah')?>" method="POST" id="form-edit">					
					<div class="form-group">
						<label class="control-label mb-10 text-left">Nama Menu</label>
						<input type="text" class="form-control" id="edit-nama_menu" placeholder="Ayam Bakar"  name="nama_menu">
						<div class="help-block with-errors" id="error">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label mb-10" for="exampleInputuname_1">Harga</label>
						<div class="input-group">
							<div class="input-group-addon">Rp.</div>
							<input type="text" class="form-control" id="edit-harga"  placeholder="1500" name="harga">
						</div>
					    <div class="help-block with-errors" id="error">
					</div>
                    <div class="form-group">
					
                        <input type="radio" id="input-status" name="status" value="ready"> Ready
                        <input type="radio"  id="input-status" name="status" value="kosong"> Kosong<br>
                        
                        <div class="help-block with-errors" id="error">
                        </div>
                    </div>

						<input type="hidden" name="id_menu" class="form-control" id="edit-id_menu">
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
      url:"<?=base_url()?>menu/edit_data/"+id,
      dataType:"json",
      success:function (detail) {		
      	$("#edit-id_menu").val(id);
        $("#edit-nama_menu").val(detail.nama_menu);
        $("#edit-harga").val(detail.harga);
        $("#edit-status").val(detail.status);
        
    }
});
}
	function closeModal() {
		$('#form-edit input').parents('.form-group').removeClass('has-error has-danger').addClass('has-success');		
		$('#form-edit input').parents('.form-group').find('#error').html(" ");		
  	}
</script>