<script type="text/javascript">
	
	$(document).ready(function(){
		$(document).on('change', 'select#department_id', function(e){
			var department_id = $(this).val();
			$('select#code').val('').change();
			$('select#code option:not(:first)').hide();
			$('select#code option[department-id="'+ department_id +'"]').show();
		})

		$(document).on('change', 'select#customer_group_id', function(e){
			var customer_group_id = $(this).val();
			$('select#customer_id').val('').change();
			$('select#customer_id option:not(:first)').hide();
			$('select#customer_id option[customer-groups-id="'+ customer_group_id +'"]').show();
		})
	})

</script>