<div class="modal fade" id="delete" aria-hidden="true" aria-labelledby="" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure want to delete the user?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>  
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="document.getElementById('delete_form').submit();">Delete</button>
                        </div>
                        {{-- <form id="delete_form" action="{{ route('user.destroy', ['user' => $user->id]) }}" method="post" style="display:none;">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{ $user->id }}">
                        </form> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>