<div class="btn-group d-flex flex-row justify-content-between " role="group" aria-label="Basic example"
    style="width: 50px">
   {{-- Edit Route --}}
   <button>
     <a href="{{ url($editRoute, $id) }}" class="mr-1 mb-3 btn-sm btn btn-icon btn-outline facebook btn-rounded-circle ">
        
        <i class=" fa fa-edit"></i>
    </a>
   </button>
   
       {{-- Destroy Route --}}
                    <form action="{{ url($destroyRoute, $id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                       <button type="submit" onclick="DeleteFunction();" class="btn-sm btn btn-icon btn-outline facebook btn-rounded-circle"><i class=" fa fa-trash" style="color: red"></i></button>
                        
                    </form>
 <script>
    function DeleteFunction() {
        return confirm("Are you sure you want to delete?");

    }
</script>

</div>



 {{-- Delete With Modal  --}}

   {{-- <div class="modal fade" id="exampleModal{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                    <form action="{{ url($destroyRoute, $id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}



















































{{-- 
<div class="btn-group d-flex flex-row justify-content-between" role="group" aria-label="Basic example"
    style="width: 50px">

    <a href="{{ url($editRoute, $id) }}">
        
        <i class=" fa fa-edit"></i>
    </a>
   
    <a data-toggle="modal" data-target="#exampleModal" style="color: red">
        <i class=" fa fa-trash"></i>
    </a>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" class="text-danger" id="exampleModalLabel" class="alert-danger text-black">
                        Alert!
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete?

                </div>
                <div class="modal-footer" class="btn-group d-flex flex-row justify-content-between" role="group"
                    aria-label="Basic example">
                    <form action="{{ url($destroyRoute, $id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger ">Ok</button></a>
                        <button type="submit" class="btn btn-primary " data-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function DeleteFunction() {
        return confirm("Are you sure you want to delete?");

    }
</script> --}}