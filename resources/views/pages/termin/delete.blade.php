<!-- Modal -->
<div class="modal fade" id="exampleModal{{$termin->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title fs-5" id="exampleModalLabel"><i data-feather="trash"></i>Löschen bestätigen</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
      </div>
      <div class="modal-body">
        <h2>{{$termin->datum}}</h2>
      </div>
        <form class="forms-sample" action="{{route('termin.destroy',[$termin->id])}}" method="post">@csrf
            @method('DELETE')
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger mr-2">Confirm</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
  </div>
</div>
