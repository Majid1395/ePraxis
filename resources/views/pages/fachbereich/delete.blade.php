<!-- Modal -->
<div class="modal fade" id="exampleModal{{$fachbereich->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title fs-5" id="exampleModalLabel"><i data-feather="trash"></i>Löschen Bestätigen</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
      </div>
      <div class="modal-body">

        <h2>{{$fachbereich->name}}</h2>
      </div>
        <form class="forms-sample" action="{{route('fachbereich.destroy',[$fachbereich->id])}}" method="post">@csrf
            @method('DELETE')
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger mr-2">Bestätigen</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Abbrechen</button>
            </div>
        </form>
    </div>
  </div>
</div>
