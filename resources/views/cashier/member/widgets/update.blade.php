<div class="modal fade" id="editMemberModal" tabindex="-1" aria-labelledby="editMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMemberModalLabel">Edit Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editMemberForm" method="POST">
                    @csrf
                    @method('PUT') <!-- Method untuk update -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="nameEdit" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nameEdit" name="name">
                    </div>

                    <div class="mb-3">
                        <label for="emailEdit" class="form-label">Email</label>
                        <input type="email" class="form-control" id="emailEdit" name="email">
                    </div>

                    <div class="mb-3">
                        <label for="addressEdit" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="addressEdit" name="address">
                    </div>

                    <div class="mb-3">
                        <label for="telpEdit" class="form-label">Telp</label>
                        <input type="text" class="form-control" id="telpEdit" name="telp">
                    </div>

                    <div class="mb-3 text-end">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
