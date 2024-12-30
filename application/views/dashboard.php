<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIPS</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <title>Dashboard</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f4ff;
        }

        .container {
            padding: 20px;
        }

        .dashboard-header {
            display: flex;
            align-items: center;
            padding: 10px;
            background-color: #90CAF9;
        }

        .dashboard-header h1 {
            margin-left: 10px;
            font-size: 24px;
        }

        .cards {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }

        .card {
            flex: 1;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #fff;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .buttons {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }

        .button {
            flex: 1;
            padding: 15px;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #d9eaff;
        }

        .table-container {
            margin-top: 30px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .table-container .warning {
            color: red;
            font-weight: bold;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .pagination {
            margin-top: 10px;
            text-align: right;
        }

        .pagination select {
            padding: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <section class="content-header">
            <h1>Dashboard
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <section class="content">

<div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-bi bi-box-seam"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Items</span>
              <span class="info-box-number"><?=$this->fungsi->count_item()?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-truck"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Suppliers</span>
              <span class="info-box-number"><?=$this->fungsi->count_supplier()?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Customer</span>
              <span class="info-box-number"><?=$this->fungsi->count_customer()?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-user-plus"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Users</span>
              <span class="info-box-number"><?=$this->fungsi->count_user()?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
</section>

        <div class="table-container">
            <p class="warning">&#9888; Stok barang telah mencapai batas minimum</p>

            <div class="pagination">
                <label for="rows">Tampilkan </label>
                <select id="rows">
                    <option>10</option>
                    <option>20</option>
                    <option>30</option>
                </select>
                <span>Data</span>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>ID Barang</th>
                        <th>Nama Barang</th>
                        <th>Jenis Barang</th>
                        <th>Stok</th>
                        <th>Satuan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6" style="text-align: center;">Data kosong</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>