  <!-- table -->
  <div class="card mb-3">
    <div class="card-header">
      <i class="fas fa-table"></i> View Data CCTV
    </div>

    <div class="card-body">
      <div class="col-md-12">          
        <table class="table table-bordered">
          <tr class="info">
            <th>Nomor
              <td colspan="2"><?php echo $model['nomor'];?></td>
            </th>
          </tr>
          <tr>
            <th>Merk
              <td colspan="2"><?php echo $model['merk'];?></td>
            </th>
          </tr>
          <tr>
            <th>Jenis
              <td colspan="2"><?php echo $model['jenis'];?></td>
            </th>
          </tr>
          <tr>
            <th>Nomor Seri
              <td colspan="2"><?php echo $model['seri'];?></td>
            </th>
          </tr>
          <tr>
            <th>Kontrak
              <td colspan="2"><?php echo $model['kontrak'];?></td>
            </th>
          </tr>

          <tr>
            <th width="200px">Aksi
              <td colspan="2">

              <?php if(isLoggedIn()):?>
                <a href="<?php echo site_url('datacentercctv/edit/'.$model['id']);?>" class="btn btn-success btn-sm">
                <i class="fas fa-edit"></i></a>

                <a href="<?php echo site_url('datacentercctv/delete/'.$model['id']);?>" class="btn btn-danger btn-sm">
                <i class="fas fa-trash-alt"></i></a>
              <?php endif; ?>
              
            </td>
            </th>
          </tr>
        </table>

  				<a href="<?php echo site_url('datacentercctv/index');?>" class="btn btn-danger btn-sm">
  				<span class="glyphicon glyphicon-chevron-left"></span> kembali</a>

      </div>

    </div>

  </div>