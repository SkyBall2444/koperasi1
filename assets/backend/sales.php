<?php
// db.php
include 'db.php';

// Ambil data sales
$query = "SELECT * FROM sales";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Sales</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <?php include 'includes/sidebar.php'; ?>

    <!-- Main Content -->
    <div id="page-content-wrapper" class="p-4 w-100">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold">DATA INVOICE</h4>
                <a href="sales_add.php" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Add Data</a>
            </div>
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Sales No</th>
                        <th>DO No</th>
                        <th>Tgl Sales</th>
                        <th>Customer</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; while($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><a href="#"><?= $row['sales_no']; ?></a></td>
                        <td><?= $row['do_no']; ?></td>
                        <td><?= $row['tgl_sales']; ?></td>
                        <td><?= $row['customer']; ?></td>
                        <td>
                            <?php if($row['status'] == "Belum Lunas") { ?>
                                <span class="badge bg-danger"><?= $row['status']; ?></span>
                            <?php } else { ?>
                                <span class="badge bg-success"><?= $row['status']; ?></span>
                            <?php } ?>
                        </td>
                        <td>
                            <a href="sales_edit.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                            <a href="sales_delete.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
