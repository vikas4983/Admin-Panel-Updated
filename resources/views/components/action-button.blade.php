<div class="d-flex flex-row">
    <button>
        <a href="{{ url($editRoute, $id) }}" class="mr-1 mb-3 btn-lg btn btn-icon btn-outline facebook btn-rounded-circle ">
            <i class=" fa fa-edit"></i>
        </a>
    </button>
    
    <form action="{{ url($destroyRoute, $id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="DeleteFunction();"
            class="mr-1 mb-3 btn-sm btn btn-icon btn-outline facebook btn-rounded-circle"><i class=" fa fa-trash"
                style="color: red"></i></button>
    </form>
    <script>
        function DeleteFunction() {
            return confirm("Are you sure you want to delete?");
        }
    </script>
</div>
