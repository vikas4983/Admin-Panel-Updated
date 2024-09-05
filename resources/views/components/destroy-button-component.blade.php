
<div class="menu-line">
    <form action="{{ $destroyRoute }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="DeleteFunction()">
            <i class="fa fa-trash" aria-hidden="true" style="color: red; display: inline-block; margin-right: 5px;"></i>
            {{ $name }}
        </button>
    </form>
    <script>
        function DeleteFunction() {
            return confirm("Are you sure you want to delete?");
        }
    </script>
</div>