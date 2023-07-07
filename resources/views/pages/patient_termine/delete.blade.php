<!-- Modal -->
<div class="modal fade" id="exampleModal{{$buchung->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fs-5" id="exampleModalLabel"><i data-feather="trash"></i>Löschen Bestätigen</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <p>Datum: {{$buchung->datum}}</p>
                <p>Termin: {{$buchung->zeit}}</p>
            </div>
            <form action="{{route('buchung.loeschen')}}" method="post">@csrf
            @method('DELETE')

            <div class="modal-footer">
                <button type="submit" class="btn btn-danger mr-2">Bestätigen</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Schließen</button>
            </div>
            </form>
        </div>
    </div>
</div>
