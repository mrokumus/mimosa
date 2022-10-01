<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
				<?php echo $data->title; ?>
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                    <i class="fas fa-expand"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <table id="datatable-1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Gönderen</th>
                    <th>Konu</th>
                    <th>Gönderilme Tarihi</th>
                    <th>Durum</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
				<?php foreach ($data->content as $row): ?>
                    <tr>
                        <td>
							<?php
							$send_user_name = $row->name . " " . $row->surname . " (" . $row->email . ")";
							echo $functions->textModal($send_user_name, 25);
							?>
                        </td>
                        <td>
							<?php echo $functions->textModal($row->subject, 25); ?>
                        </td>
                        <td><?php echo $functions->dateShort($row->created_at); ?></td>
                        <td>
                            <span class="badge badge-<?php echo (int)$row->read_user === 1 ? "success" : "danger"; ?>">
                                <?php echo (int)$row->read_user === 1 ? "Okundu" : "Okunmadı"; ?>
                            </span>
							<?php if (!empty($row->reply_send_user_id)): ?>
                                <span class="badge badge-info">Cevaplandı</span>
							<?php endif; ?>
                        </td>
                        <td>
							<?php if ($session->sessionRoleControl($data->pageRoleKey, $constants::editPermissionKey) === true): ?>
                                <a  onclick="post_edit('<?php echo $system->adminUrl("contact-settings?id=" . $row->id); ?>')"
                                    href="javascript:void()"
                                    class="btn btn-outline-success m-1">
                                    <i class="fas fa-pencil-alt px-1"></i>
                                    Düzenle
                                </a>
							<?php endif; ?>
							<?php if ($session->sessionRoleControl($data->pageRoleKey, $constants::deletePermissionKey) === true): ?>
                                <button type="button" class="btn btn-outline-danger m-1"
                                        onclick="post_delete('<?php echo $system->adminUrl("contact?delete=" . $row->id); ?>')">
                                    <i class="fas fa-trash px-1"></i>
                                    Sil
                                </button>
							<?php endif; ?>
                        </td>
                    </tr>
				<?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {
        $("#datatable-1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#datatable-1_wrapper .col-md-6:eq(0)');
    });
</script>