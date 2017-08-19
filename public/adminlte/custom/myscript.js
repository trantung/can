$(document).ready(function(){
	console.log('MyScript added by TanTan');

//////////////////////////////////////////////////////////////////////////////
//// Them moi thanh phan nguyen lieu /////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
	var origin_option = [];
	$('.add-material .add-new-btn').one('click', function(){
		$('.add-multi-collapse .form-collapse select').each(function(){
			origin_option.push($(this).html());
		})
	})

	$('.add-material .add-new-btn').on('click', function(){
		/// Check empty input
		if(!$('.add-material-form')[0].checkValidity()){
			$('.add-material-form').find('[type=submit]').click();
			return false;
		}

		var html = $('.add-multi-collapse .form-collapse:last').clone(),
		num = parseInt(html.attr('id')),
		clone = html.attr('id', num+1).hide();
		clone.find('input').val('');
		$(clone).find('select').empty().append(origin_option);

		/// kiem tra cac gia tri select da duoc nhap truoc do
		var selected = [];
		$('.add-multi-collapse .form-collapse select').each(function(){
			selected.push($(this).val());
		})

		if(selected.length){
			$.each(selected, function(key,value){
				$(clone).find('select option[value='+value+']').remove();
			})
		}
		if($(clone).find('select option').length <= 1) return false;

		$('.add-multi-collapse').append(clone);
		$(clone).slideToggle('fast');
	})
	
	$('.add-material').on('click', 'button.remove', function(){
		if($('.add-material .form-collapse').length == 1) return;
		var parents = $(this).parents('.form-collapse');
		parents.slideToggle('fast', function(){
			parents.remove();
		});
	})
/////////////////////////////////////////////////////////////////////////////

})