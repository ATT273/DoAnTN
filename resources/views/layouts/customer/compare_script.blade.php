<script type="text/javascript">
	$(document).ready(function(){
		// delete compare item
			@if(Session::has('compare_list'))
				@foreach($list->items as $item)
					$('#del-item-{{$item['item']['id']}}').click(function(){
						$('#modal-body').load('del-compare/{{$item['item']['id']}}');
					});
				@endforeach
			@endif
		});
</script>