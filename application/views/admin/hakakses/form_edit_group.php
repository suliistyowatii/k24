<div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">
                <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.css'?>">

              <?php echo form_open_multipart('admin/simpanedit','class="form-horizontal form-label-left"') ?>

                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>Profile </h3>
                  </div>
                </div>
          <center><img class="img-thumbnail" width="100"src='<?php echo base_url() ?>foto/<?php echo $ambilgroup[0]->foto ?>'></center>
      <br>
                <div class="item form-group">

          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nama <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="nama" pattern=".{5,15}" value="<?php echo $ambilgroup[0]->nama; ?>"required title="7 to 15 characters" class="form-control col-md-7 col-xs-12" data-validate-length-range="5" data-validate-words="2" name="nama" placeholder="Fill Your Name here" required="required" type="text">
          </div>
        </div>

        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">NIK <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="nik" value="<?php echo $ambilgroup[0]->nik; ?>" pattern=".{15,15}" required title="7 to 15 characters" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="nik" placeholder="Fill Your NIK here" required="required" type="number">
          </div>
        </div>

        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tanggal Lahir <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="date" value="<?php echo $ambilgroup[0]->born_date; ?>"pattern=".{7,15}" required title="7 to 15 characters" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="date" placeholder="Fill Your Password here" required="required" type="date">
          </div>
        </div>

        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Jenis Kelamin <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <select class="form-control  col-md-7 col-xs-12" id="jenis_k" name="jenis_k">
            <option <?php if($ambilgroup[0]->jenis_k == 'L') {echo 'selected'; } ?> value="L">Laki-laki</option>
            <option <?php if($ambilgroup[0]->jenis_k == 'P') {echo 'selected'; } ?> value="P">Perempuan</option>
            
            
            </select>
          </div>
        </div>

        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nomor HP<span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="no" value="<?php echo $ambilgroup[0]->no_hp; ?>"pattern=".{7,15}" required title="7 to 15 characters" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="no" placeholder="Fill Your Password here" required="required" type="number">
          </div>
        </div>

        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Username <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="username" value="<?php echo $ambilgroup[0]->username; ?>" pattern=".{7,50}" required title="7 to 50 characters" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="username" placeholder="Fill Your Username here" type="email" readonly>
          </div>
        </div>
   
        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Password <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="password" value="<?php echo $ambilgroup[0]->password; ?>" pattern=".{7,15}" required title="7 to 15 characters" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="password" placeholder="Fill Your Password here" required="required" type="password">
          </div>
        </div>

        <div class="item form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Foto Diri <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
          

          <input id="gambar"  name="gambar"  class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" type="file">
            <input type="hidden" id="gambarlama" value="<?php echo $ambilgroup[0]->foto; ?>" name="gambarlama"  class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2">
          </div>
		    </div>  

        </div>

       

                      <button id="send" type="submit" class="btn btn-success" style="margin-top: 20px">Save</button>
                </form>
                </div>

                <div class="clearfix"></div>
              </div>
            </div>
