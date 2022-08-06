<form id="{{$form_id}}" action="{{$action}}" method="POST" onsubmit="return confirm('Do You Want to Delete?')">
    @csrf
    {{ method_field('DELETE') }}
</form>
