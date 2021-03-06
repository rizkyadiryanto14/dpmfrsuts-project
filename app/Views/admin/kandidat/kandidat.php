<?= $this->extend('layouts/master_admin') ?>

<?= $this->section('title') ?>
<?= $title; ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- datatables -->
<div class="card">
  <div class="card-header">
    <h4>Tabel Kandidat</h4>
  </div>
  <div class="card-body">
    <a href="<?= base_url('admin/kandidat/add') ?>" class="btn btn-primary mb-4">Tambah</a>
    <div class="table-responsive">
      <table class="table table-striped" id="datatables">
        <thead>
          <tr>
            <th class="text-center">
              #
            </th>
            <th>Nama</th>
            <th>Visi</th>
            <th>Misi</th>
            <th>Avatar</th>
            <th>Date Created</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!-- modal delete -->
<div class="modal fade" tabindex="-1" role="dialog" id="deleteModal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Konfirmasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Yakin ingin menghapus data ini.</p>
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <form action="<?= base_url('admin/kandidat/delete') ?>" method="POST">
          <?= csrf_field(); ?>
          <input type="hidden" id="delete-input-id" name="id" value="">
          <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    var table = $('#datatables').DataTable({
      "processing": true,
      "serverSide": true,
      "order": [],
      "ajax": {
        "url": "<?= base_url('ajax/get_kandidat') ?>",
        "type": "POST",
        data: function(data) {
          data._csrf = getCsrf();
        },
        complete: function(data) {
          setCsrf(JSON.parse(data.responseText).csrf);
        }
      },

      //optional
      "lengthMenu": [
        [5, 10, 25, 100],
        [5, 10, 25, 100]
      ],
      "columnDefs": [{
        "targets": [],
        "orderable": false,
      }, ],

    });

    $('#datatables tbody').on('click', '.btn-delete', function(e) {
      const id = e.target.dataset.id;
      $('#deleteModal #delete-input-id').val(id);
      $('#deleteModal').modal();
    });
  });
</script>
<?= $this->endSection() ?>