<script type="text/javascript">
	$(document).ready(function () {

		url = '{{ url("admin/widget/widgetgalleries") }}';
		
		widgetImageMediaLibrary.init(function(checkedValues)
		{
			$.ajax({
				url         : url,
				type        : 'GET',
				data        : {'ids': checkedValues},
				success     : function(data)
				{
					if(data[0].type === 'photo')
						img = '<img alt="' + data[0].caption + '" src="' + data[0].path + '"/>';

					$('#widget_image').attr('src', data[0].path);
					$('input[name=image]').attr('value', data[0].id);
				}
			});
		});
	});
</script>
