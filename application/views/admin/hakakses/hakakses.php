<div class="x_content">
  <?php 
  $tambah = '<button class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Member</button>';
  echo anchor('/admin/tambah_group',$tambah) 
  ?> 

<?php 
  $json = '<button class="btn btn-success"><i class="fa fa-plus"></i> LIST JSON</button>';
  echo anchor('/admin/json_list',$json) 
  ?> 
  <!-- start project list -->
  <table class="table table-striped projects">
    <thead>
      <tr>
        <th>No</th>
        <th>Username</th>
        <th>Created at</th>
        <th>Updated at</th>
        <th>Aksi</th>
      </tr>
    </thead>

    <tbody>
      <?php 
          $no = 1;
          $edit = '<button class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </button>';
          $hapus = '<button class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </button>';
          foreach ($ambilgroup as $data) {
                if( $data->username == 'Administrator') {
                    continue;
                }
                echo '<tr>';
                echo '<td>'.$no++.'</td>';
                echo '<td>'.$data->username.'</td>';
                echo '<td>'.$data->created_at.'</td>';
                echo '<td>'.$data->updated_at.'</td>';
                echo '<td>'.anchor('admin/editgroup/'.$data->username,$edit).'&nbsp'.anchor('admin/hapusgroup/'.$data->username,$hapus).'</td>';
                echo '</tr>';

                }
      ?>
    </tbody>
  </table>
  <!-- end project list -->

</div>