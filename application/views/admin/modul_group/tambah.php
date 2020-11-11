       <div class="row mb-2">
         <div class="col-sm-6">
           <h1 class="m-0 text-dark"><?php echo $title ?></h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="<?php echo base_url() ?>dashboard">Home</a></li>
             <li class="breadcrumb-item active"><?php echo $title ?></li>
           </ol>
         </div><!-- /.col -->
       </div><!-- /.row -->

       <section class="content">
         <div class="row">
           <div class="col-12">
             <div class="card">
               <div class="card-body">
                 <form action="<?php echo base_url('modul_group/simpan'); ?>" method="post">
                   <div class="form-group">
                     <label>Modul</label>
                     <input type="hidden" name="id_group" value="<?php echo $id_group ?>">
                     <select class="form-control" name="modul">
                       <?php foreach ($modul as $m) : ?>
                         <option value="<?php echo $m->mdl_id ?>"><?php echo $m->mdl_modul ?></option>
                       <?php endforeach ?>
                     </select>
                     <br>
                     <button type="submit" class="btn btn-primary">Tambah</button>
                     <a href="<?php echo base_url('usergroup') ?>" class="btn btn-danger">Kembali</a>
                   </div>
                 </form>
               </div>
             </div>
           </div>
         </div>
         <div class="row">
           <div class="col-12">
             <div class="card">
               <div class="card-body">
                 <table id="example1" class="table table-bordered table-striped">
                   <thead>
                     <tr>
                       <th>No</th>
                       <th>Nama Modul</th>
                       <th>Ikon</th>
                       <th>Aksi</th>
                     </tr>
                   </thead>
                   <tbody>
                     <?php
                      $no = 1;
                      foreach ($modul_group as $m) { ?>
                       <tr>
                         <td><?php echo $no++ ?></td>
                         <td><?php echo $m->mdl_modul ?></td>
                         <td><i class="<?php echo $m->mdl_icon ?>"></i> <?php echo $m->mdl_icon ?></td>
                         <td>
                           <a title="Hapus Modul" href="<?php echo base_url('modul_group/delete/' . $m->mg_id . '/' . $id_group) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" class="btn btn-danger mb-1"><i class="fas fa-trash"></i> Hapus</a>
                         </td>
                       </tr>
                     <?php } ?>
                   </tbody>
                 </table>
               </div>
               <!-- /.card-body -->
             </div>
             <!-- /.card -->
           </div>
           <!-- /.col -->
         </div>
         <!-- /.row -->
       </section>
       <!-- /.content -->