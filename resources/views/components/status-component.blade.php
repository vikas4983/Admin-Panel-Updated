@if ($status === 'Active')
    <i class="mdi mdi-check-decagram" style="color: green"></i>
@elseif ($status === 'Inactive')
    <i class="mdi mdi-close-octagon" style="color:rgb(206, 104, 64)"></i>
@endif
