<form action="{{ $destroyRoute }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('Are you sure you want to delete?');"
        class="mr-1 mb-3 btn-sm btn btn-icon btn-outline facebook btn-rounded-circle">
        <i class="fas fa-trash" style="color: red"></i>
    </button>
</form>