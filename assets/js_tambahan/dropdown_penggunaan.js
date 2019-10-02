// $(document).ready(function() {
// 	$('#input-meteran_awal').prop('disabled',true);
// 	$('#input-meteran_akhir').prop('disabled',true);
// 	$('#input-bulan').prop('disabled',true);
// 	$('#input-tahun').prop('disabled',true);

// 	$('#input-pelanggan').change(function() {		
// 		$('#input-meteran_awal').val('');
// 		$('#input-meteran_akhir').val('');
// 		$('#input-meteran_awal').prop('disabled',false);
// 		$('#input-meteran_akhir').prop('disabled',false);		
// 		$('#input-tahun').prop('disabled',false);

// 		var id_pelanggan = $('#input-pelanggan').find(':selected').val();
// 		$.ajax({
// 			type: "POST",
// 			url: base_url+'penggunaan/getDataTahun/'+id_pelanggan,
// 			dataType:"html",
// 			success:function (data) {				
// 				if (data) {
// 					$("#input-tahun").html(data).show();
// 					$('#input-bulan').prop('disabled',false);
// 					var tahun = $('#input-tahun').find(':selected').val();
// 					var id_pelanggan = $('#input-pelanggan').find(':selected').val();
// 					$.ajax({
// 						type: "POST",
// 						url: base_url+'penggunaan/getDataBulan/',
// 						data:{"tahun":tahun,"id_pelanggan":id_pelanggan},
// 						dataType:"html",
// 						success:function (respone) {				
// 							if (respone) {
// 								$("#input-bulan").html(respone).show();
// 							}else{
// 								alert('Tagihan Sudah Lunas Tahun Ini');
// 								$('#input-tahun').find(':selected').remove();
// 								$('#input-bulan').prop('disabled',true);
// 								$('#input-meteran_awal').prop('disabled',true);
// 								$('#input-meteran_akhir').prop('disabled',true);
// 							}
// 						}
// 					});		
// 				}else{
// 					alert('')
// 				}	
// 			}
// 		});		
// 	});
// 	$('#input-tahun').change(function() {
// 		$('#input-meteran_awal').val('');
// 		$('#input-meteran_akhir').val('');
// 		$('#input-meteran_awal').prop('disabled',false);
// 		$('#input-meteran_akhir').prop('disabled',false);
// 		$('#input-bulan').prop('disabled',false);
// 		var tahun = $('#input-tahun').find(':selected').val();
// 		var id_pelanggan = $('#input-pelanggan').find(':selected').val();
// 		$.ajax({
// 			type: "POST",
// 			url: base_url+'penggunaan/getDataBulan/',
// 			data:{"tahun":tahun,"id_pelanggan":id_pelanggan},
// 			dataType:"html",
// 			success:function (respone) {				
// 				if (respone) {
// 					$("#input-bulan").html(respone).show();
// 				}else{
// 					alert('Tagihan Sudah Lunas Tahun Ini');
// 					$('#input-tahun').find(':selected').remove();
// 					$('#input-bulan').prop('disabled',true);
// 					$('#input-meteran_awal').prop('disabled',true);
// 					$('#input-meteran_akhir').prop('disabled',true);
// 				}
// 			}
// 		});	
// 	});
// });	