<form method='POST' action='/list/{{ $parking->slug }}/destroy'>
    {{ csrf_field() }}
    {{ method_field('delete') }}

    <button type='submit' class='button-link' test='{{ $parking->slug }}-remove-from-list-button'>
        <i class='fa fa-minus-circle'></i> Remove from the Parking list
    </button>
</form>
